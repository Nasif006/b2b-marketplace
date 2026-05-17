<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ModuleSetting;

class ModuleSettingSeeder extends Seeder
{
    public function run(): void
    {
        $modules = [
            ['key' => 'crm',         'label' => 'CRM Module'],
            ['key' => 'automation',  'label' => 'Workflow Automation'],
            ['key' => 'marketing',   'label' => 'Marketing Campaigns'],
            ['key' => 'social',      'label' => 'Social Media'],
            ['key' => 'tickets',     'label' => 'Support Tickets'],
        ];

        foreach ($modules as $module) {
            ModuleSetting::firstOrCreate(
                ['key' => $module['key']],
                ['label' => $module['label'], 'is_enabled' => true]
            );
        }

        $this->command->info('Module settings seeded.');
    }
}
