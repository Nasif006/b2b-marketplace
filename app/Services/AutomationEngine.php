<?php

namespace App\Services;

use App\Models\AutomationRule;
use App\Models\WorkflowLog;
use Illuminate\Support\Facades\Log;

class AutomationEngine
{
    /**
     * Fire all active rules matching the given trigger.
     * Call this from anywhere: events, controllers, jobs.
     *
     * @param string $trigger   e.g. 'order_placed'
     * @param mixed  $model     the Eloquent model that caused the trigger
     * @param array  $context   extra data passed to the action
     */
    public static function fire(string $trigger, $model = null, array $context = []): void
    {
        $rules = AutomationRule::where('trigger', $trigger)
            ->where('is_active', true)
            ->get();

        foreach ($rules as $rule) {
            try {
                self::executeAction($rule, $model, $context);

                WorkflowLog::create([
                    'automation_rule_id' => $rule->id,
                    'trigger'            => $trigger,
                    'action'             => $rule->action,
                    'status'             => 'success',
                    'details'            => self::buildDetails($rule, $model, $context),
                    'triggerable_id'     => $model?->id,
                    'triggerable_type'   => $model ? get_class($model) : null,
                ]);

            } catch (\Throwable $e) {
                WorkflowLog::create([
                    'automation_rule_id' => $rule->id,
                    'trigger'            => $trigger,
                    'action'             => $rule->action,
                    'status'             => 'failed',
                    'details'            => 'Error: ' . $e->getMessage(),
                    'triggerable_id'     => $model?->id,
                    'triggerable_type'   => $model ? get_class($model) : null,
                ]);

                Log::error("Automation rule [{$rule->id}] failed: " . $e->getMessage());
            }
        }
    }

    private static function executeAction(AutomationRule $rule, $model, array $context): void
    {
        match ($rule->action) {
            'send_email'      => self::actionSendEmail($rule, $model, $context),
            'send_sms'        => self::actionSendSms($rule, $model, $context),
            'notify_supplier' => self::actionNotifySupplier($rule, $model, $context),
            'log_interaction' => self::actionLogInteraction($rule, $model, $context),
            default           => null,
        };
    }

    private static function actionSendEmail(AutomationRule $rule, $model, array $context): void
    {
        // Logs to Laravel log driver (works without real SMTP for demo)
        $payload  = $rule->payload ?? [];
        $to       = $context['email'] ?? ($model->email ?? ($model->user->email ?? 'unknown'));
        $subject  = $payload['subject'] ?? 'Notification from B2B Platform';
        $message  = $payload['message'] ?? 'You have a new notification.';

        Log::info("📧 AutomationEngine [send_email] → To: {$to} | Subject: {$subject} | Message: {$message}");
    }

    private static function actionSendSms(AutomationRule $rule, $model, array $context): void
    {
        $payload = $rule->payload ?? [];
        $phone   = $context['phone'] ?? 'unknown';
        $message = $payload['message'] ?? 'SMS notification from B2B Platform';

        Log::info("📱 AutomationEngine [send_sms] → Phone: {$phone} | Message: {$message}");
    }

    private static function actionNotifySupplier(AutomationRule $rule, $model, array $context): void
    {
        $supplierId = $context['supplier_id'] ?? null;
        Log::info("🔔 AutomationEngine [notify_supplier] → Supplier ID: {$supplierId} | Rule: {$rule->name}");
    }

    private static function actionLogInteraction(AutomationRule $rule, $model, array $context): void
    {
        // If a customer profile exists for this user, auto-log an interaction
        if (isset($context['user_id'])) {
            $customer = \App\Models\Customer::where('user_id', $context['user_id'])->first();
            if ($customer) {
                \App\Models\Interaction::create([
                    'customer_id' => $customer->id,
                    'user_id'     => 1, // system/admin
                    'type'        => 'note',
                    'body'        => 'Auto-logged by automation rule: ' . $rule->name,
                ]);
            }
        }
    }

    private static function buildDetails(AutomationRule $rule, $model, array $context): string
    {
        $modelInfo = $model ? class_basename($model) . ' #' . $model->id : 'no model';
        return "Rule: [{$rule->name}] | Action: {$rule->action} | Triggered by: {$modelInfo}";
    }
}
