<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplierDashboardController;
use App\Http\Controllers\Buyer\ProductBrowseController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\Buyer\CartController;
use App\Http\Controllers\Buyer\CheckoutController;
use App\Http\Controllers\Supplier\SupplierOrderController;

Route::get('/', [WelcomeController::class, 'index']);

Route::get('/products', [ProductBrowseController::class, 'index']);
Route::get('/products/{id}', [ProductBrowseController::class, 'show']);
Route::get('/features', fn() => view('features'));

Route::middleware('auth')->group(function () {

    // ── ADMIN ──
    Route::middleware(['role:admin'])->group(function () {

        Route::get('/admin/dashboard', fn () => view('admin.dashboard'));

        // Users
        Route::get('/admin/users', [App\Http\Controllers\Admin\UserManagementController::class, 'index']);
        Route::put('/admin/users/{id}/role', [App\Http\Controllers\Admin\UserManagementController::class, 'updateRole']);
        Route::delete('/admin/users/{id}', [App\Http\Controllers\Admin\UserManagementController::class, 'destroy']);

        // CRM
        Route::get('/admin/crm/customers', [App\Http\Controllers\Admin\CrmController::class, 'customers']);
        Route::get('/admin/crm/customers/{id}', [App\Http\Controllers\Admin\CrmController::class, 'customerShow']);
        Route::post('/admin/crm/customers/{id}/interactions', [App\Http\Controllers\Admin\CrmController::class, 'interactionStore']);
        Route::get('/admin/crm/leads', [App\Http\Controllers\Admin\CrmController::class, 'leads']);
        Route::get('/admin/crm/leads/create', [App\Http\Controllers\Admin\CrmController::class, 'leadCreate']);
        Route::post('/admin/crm/leads', [App\Http\Controllers\Admin\CrmController::class, 'leadStore']);
        Route::get('/admin/crm/leads/{id}/edit', [App\Http\Controllers\Admin\CrmController::class, 'leadEdit']);
        Route::put('/admin/crm/leads/{id}', [App\Http\Controllers\Admin\CrmController::class, 'leadUpdate']);
        Route::delete('/admin/crm/leads/{id}', [App\Http\Controllers\Admin\CrmController::class, 'leadDestroy']);

        // Automation
        Route::get('/admin/automation/rules', [App\Http\Controllers\Admin\AutomationController::class, 'rules']);
        Route::get('/admin/automation/rules/create', [App\Http\Controllers\Admin\AutomationController::class, 'ruleCreate']);
        Route::post('/admin/automation/rules', [App\Http\Controllers\Admin\AutomationController::class, 'ruleStore']);
        Route::post('/admin/automation/rules/{id}/toggle', [App\Http\Controllers\Admin\AutomationController::class, 'ruleToggle']);
        Route::delete('/admin/automation/rules/{id}', [App\Http\Controllers\Admin\AutomationController::class, 'ruleDestroy']);
        Route::get('/admin/automation/logs', [App\Http\Controllers\Admin\AutomationController::class, 'logs']);

        // Campaigns
        Route::get('/admin/campaigns', [App\Http\Controllers\Admin\CampaignController::class, 'index']);
        Route::get('/admin/campaigns/create', [App\Http\Controllers\Admin\CampaignController::class, 'create']);
        Route::post('/admin/campaigns', [App\Http\Controllers\Admin\CampaignController::class, 'store']);
        Route::get('/admin/campaigns/{id}/edit', [App\Http\Controllers\Admin\CampaignController::class, 'edit']);
        Route::put('/admin/campaigns/{id}', [App\Http\Controllers\Admin\CampaignController::class, 'update']);
        Route::post('/admin/campaigns/{id}/send', [App\Http\Controllers\Admin\CampaignController::class, 'markSent']);
        Route::delete('/admin/campaigns/{id}', [App\Http\Controllers\Admin\CampaignController::class, 'destroy']);

        // Social Media
        Route::get('/admin/social', [App\Http\Controllers\Admin\SocialController::class, 'index']);
        Route::get('/admin/social/calendar', [App\Http\Controllers\Admin\SocialController::class, 'calendar']);
        Route::get('/admin/social/create', [App\Http\Controllers\Admin\SocialController::class, 'create']);
        Route::post('/admin/social', [App\Http\Controllers\Admin\SocialController::class, 'store']);
        Route::post('/admin/social/{id}/post', [App\Http\Controllers\Admin\SocialController::class, 'markPosted']);
        Route::delete('/admin/social/{id}', [App\Http\Controllers\Admin\SocialController::class, 'destroy']);

        // Tickets (admin)
        Route::get('/admin/tickets', [App\Http\Controllers\Admin\TicketController::class, 'index']);
        Route::get('/admin/tickets/{id}', [App\Http\Controllers\Admin\TicketController::class, 'show']);
        Route::post('/admin/tickets/{id}/respond', [App\Http\Controllers\Admin\TicketController::class, 'respond']);

        // Modules
        Route::get('/admin/modules', [App\Http\Controllers\Admin\ModuleController::class, 'index']);
        Route::post('/admin/modules/{id}/toggle', [App\Http\Controllers\Admin\ModuleController::class, 'toggle']);

        // Orders & Products (admin view)
        Route::get('/admin/orders', fn() => view('admin.orders'));
        Route::get('/admin/products', fn() => view('admin.products'));

        // Admin orders product views pass data via view directly
    });

    // ── SUPPLIER ──
    Route::middleware(['role:supplier'])->group(function () {
        Route::get('/supplier/dashboard', [SupplierDashboardController::class, 'index']);
        Route::get('/supplier/products', [ProductController::class, 'index']);
        Route::get('/supplier/products/create', [ProductController::class, 'create']);
        Route::post('/supplier/products', [ProductController::class, 'store']);
        Route::get('/supplier/products/{id}/edit', [ProductController::class, 'edit']);
        Route::put('/supplier/products/{id}', [ProductController::class, 'update']);
        Route::delete('/supplier/products/{id}', [ProductController::class, 'destroy']);
        Route::get('/supplier/orders', [SupplierOrderController::class, 'index']);
        Route::get('/supplier/orders/{id}/accept', [SupplierOrderController::class, 'accept']);
        Route::get('/supplier/orders/{id}/reject', [SupplierOrderController::class, 'reject']);
    });

    // ── BUYER ──
    Route::middleware(['role:buyer'])->group(function () {
        Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');
        Route::get('/orders', [App\Http\Controllers\Buyer\OrderController::class, 'index']);
        Route::get('/orders/{id}', [App\Http\Controllers\Buyer\OrderController::class, 'show']);
        Route::get('/orders/{id}/invoice', [App\Http\Controllers\Buyer\OrderController::class, 'invoice']);
        Route::get('/tickets', [App\Http\Controllers\Buyer\TicketController::class, 'index']);
        Route::get('/tickets/create', [App\Http\Controllers\Buyer\TicketController::class, 'create']);
        Route::post('/tickets', [App\Http\Controllers\Buyer\TicketController::class, 'store']);
    });

    // ── SHARED AUTH ──
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::get('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
    Route::get('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::get('/cart/decrease/{id}', [CartController::class, 'decrease']);
    Route::get('/checkout', [CheckoutController::class, 'index']);
    Route::post('/checkout', [CheckoutController::class, 'store']);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
