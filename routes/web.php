<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\Admin\ApplicationController;
use App\Http\Controllers\Admin\AppointmentController as AdminAppointmentController;
use App\Http\Controllers\Admin\BusinessInquiryController as AdminBusinessInquiryController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\FaqController as AdminFaqController;
use App\Http\Controllers\Admin\JournalPromptController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\ProgramController;
use App\Http\Controllers\Admin\ProviderController;
use App\Http\Controllers\Admin\ResourceController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\SubscriptionPlanController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\WorkshopController as AdminWorkshopController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\BusinessInquiryController;
use App\Http\Controllers\Client\DashboardController as ClientDashboardController;
use App\Http\Controllers\Client\JournalController;
use App\Http\Controllers\Client\MoodController;
use App\Http\Controllers\Client\ProfileController;
use App\Http\Controllers\Client\ThoughtLogController;
use App\Http\Controllers\EarlyAccessController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InPersonController;
use App\Http\Controllers\JoinUsController;
use App\Http\Controllers\JournalPageController;
use App\Http\Controllers\ProgramsController;
use App\Http\Controllers\ProviderApplicationController;
use App\Http\Controllers\ProvidersController;
use App\Http\Controllers\ResourcesController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\WorkshopsController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/api/resources/by-category', [HomeController::class, 'getResourcesByCategory'])->name('api.resources.by-category');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/services', [ServicesController::class, 'index'])->name('services.index');
Route::get('/services/{service:slug}', [ServicesController::class, 'show'])->name('services.show');
Route::get('/providers', [ProvidersController::class, 'index'])->name('providers.index');
Route::get('/providers/{id}', [ProvidersController::class, 'show'])->name('providers.show');
Route::get('/programs', [ProgramsController::class, 'index'])->name('programs.index');
Route::get('/programs/{program:slug}', [ProgramsController::class, 'show'])->name('programs.show');
Route::get('/resources', [ResourcesController::class, 'index'])->name('resources.index');
Route::get('/resources/{resource:slug}', [ResourcesController::class, 'show'])->name('resources.show');
Route::get('/workshops', [WorkshopsController::class, 'index'])->name('workshops.index');
Route::get('/workshops/{workshop:slug}', [WorkshopsController::class, 'show'])->name('workshops.show');
Route::post('/workshops/{workshop:slug}/register', [WorkshopsController::class, 'registerInterest'])->name('workshops.register');
Route::get('/journal', [JournalPageController::class, 'index'])->name('journal.index');
Route::get('/for-business', [BusinessController::class, 'index'])->name('business.index');
Route::get('/in-person', [InPersonController::class, 'index'])->name('in-person.index');
Route::get('/join-us', [JoinUsController::class, 'index'])->name('join-us.index');
Route::get('/faqs', [FaqController::class, 'index'])->name('faqs.index');

Route::post('/appointments/request', [AppointmentController::class, 'store'])->name('appointments.store');
Route::post('/business/inquiry', [BusinessInquiryController::class, 'store'])->name('business.inquiry');
Route::post('/join-us/apply', [ProviderApplicationController::class, 'store'])->name('join-us.apply');
Route::post('/early-access', [EarlyAccessController::class, 'store'])->name('early-access.store');

Route::get('/language/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'ar'])) {
        session()->put('locale', $locale);
        if (auth()->check()) {
            $user = auth()->user();
            $user->locale = $locale;
            $user->save();
        }
    }

    return redirect()->back();
})->name('language.switch');
Route::middleware(['throttle:5,1'])->group(function () {
    Route::get('/register', [RegisterController::class, 'showForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
    Route::get('/login', [LoginController::class, 'showForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/forgot-password', [ForgotPasswordController::class, 'showForm'])->name('password.request');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'send'])->name('password.email');
    Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showForm'])->name('password.reset');
    Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

Route::middleware(['auth'])->prefix('dashboard')->group(function () {
    Route::get('/', [ClientDashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/my-journal', [JournalController::class, 'index'])->name('my-journal.index');
    Route::post('/my-journal', [JournalController::class, 'store'])->name('my-journal.store');
    Route::get('/my-journal/{id}', [JournalController::class, 'show'])->name('my-journal.show');
    Route::get('/my-journal/{id}/edit', [JournalController::class, 'edit'])->name('my-journal.edit');
    Route::post('/my-journal/{id}', [JournalController::class, 'update'])->name('my-journal.update');
    Route::delete('/my-journal/{id}', [JournalController::class, 'destroy'])->name('my-journal.destroy');

    Route::get('/mood-tracker', [MoodController::class, 'index'])->name('mood-tracker.index');
    Route::post('/mood-tracker', [MoodController::class, 'store'])->name('mood-tracker.store');

    Route::get('/thought-log', [ThoughtLogController::class, 'index'])->name('thought-log.index');
    Route::post('/thought-log', [ThoughtLogController::class, 'store'])->name('thought-log.store');
});

Route::middleware(['auth', 'role:admin|super_admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
    Route::post('/users/{user}/status', [UserController::class, 'toggleStatus'])->name('users.status');

    Route::get('/providers', [ProviderController::class, 'index'])->name('providers.index');
    Route::get('/providers/create', [ProviderController::class, 'create'])->name('providers.create');
    Route::post('/providers', [ProviderController::class, 'store'])->name('providers.store');
    Route::get('/providers/{provider}', [ProviderController::class, 'show'])->name('providers.show');
    Route::get('/providers/{provider}/edit', [ProviderController::class, 'edit'])->name('providers.edit');
    Route::put('/providers/{provider}', [ProviderController::class, 'update'])->name('providers.update');
    Route::post('/providers/{provider}/verify', [ProviderController::class, 'verify'])->name('providers.verify');
    Route::post('/providers/{provider}/feature', [ProviderController::class, 'toggleFeatured'])->name('providers.feature');

    Route::get('/applications', [ApplicationController::class, 'index'])->name('applications.index');
    Route::get('/applications/{application}', [ApplicationController::class, 'show'])->name('applications.show');
    Route::post('/applications/{application}/status', [ApplicationController::class, 'updateStatus'])->name('applications.status');
    Route::post('/applications/{application}/interview', [ApplicationController::class, 'scheduleInterview'])->name('applications.interview');

    Route::get('/appointments', [AdminAppointmentController::class, 'index'])->name('appointments.index');
    Route::get('/appointments/{appointment}', [AdminAppointmentController::class, 'show'])->name('appointments.show');
    Route::post('/appointments/{appointment}/status', [AdminAppointmentController::class, 'updateStatus'])->name('appointments.status');

    Route::get('/business-inquiries', [AdminBusinessInquiryController::class, 'index'])->name('business-inquiries.index');
    Route::get('/business-inquiries/{inquiry}', [AdminBusinessInquiryController::class, 'show'])->name('business-inquiries.show');
    Route::post('/business-inquiries/{inquiry}', [AdminBusinessInquiryController::class, 'update'])->name('business-inquiries.update');

    Route::resource('services', ServiceController::class)->except(['show']);
    Route::resource('programs', ProgramController::class)->except(['show']);
    Route::resource('resources', ResourceController::class)->except(['show']);
    Route::resource('workshops', AdminWorkshopController::class)->except(['show']);
    Route::resource('faqs', AdminFaqController::class)->except(['show']);

    Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews.index');
    Route::post('/reviews/{review}/approve', [ReviewController::class, 'approve'])->name('reviews.approve');
    Route::post('/reviews/{review}/feature', [ReviewController::class, 'toggleFeatured'])->name('reviews.feature');
    Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');

    Route::get('/journal-prompts', [JournalPromptController::class, 'index'])->name('journal-prompts.index');
    Route::post('/journal-prompts', [JournalPromptController::class, 'store'])->name('journal-prompts.store');
    Route::post('/journal-prompts/{prompt}', [JournalPromptController::class, 'update'])->name('journal-prompts.update');
    Route::delete('/journal-prompts/{prompt}', [JournalPromptController::class, 'destroy'])->name('journal-prompts.destroy');

    Route::get('/partners', [PartnerController::class, 'index'])->name('partners.index');
    Route::post('/partners', [PartnerController::class, 'store'])->name('partners.store');
    Route::put('/partners/{partner}', [PartnerController::class, 'update'])->name('partners.update');
    Route::delete('/partners/{partner}', [PartnerController::class, 'destroy'])->name('partners.destroy');

    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::post('/settings', [SettingsController::class, 'update'])->name('settings.update');

    Route::get('/subscription-plans', [SubscriptionPlanController::class, 'index'])->name('subscription-plans.index');
    Route::post('/subscription-plans', [SubscriptionPlanController::class, 'store'])->name('subscription-plans.store');
    Route::post('/subscription-plans/{plan}', [SubscriptionPlanController::class, 'update'])->name('subscription-plans.update');
});
