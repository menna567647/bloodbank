<?php

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\BloodtypeController;
use App\Http\Controllers\Admin\GovernrateController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\DonationController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\AdminReportController;
use App\Http\Controllers\Website\PageController;
use App\Http\Controllers\Website\ArticleController;
use App\Http\Controllers\Website\Auth\LoginController;
use App\Http\Controllers\Website\Auth\RegisterController;
use App\Http\Controllers\Website\ClientProfileController;
use App\Http\Controllers\Website\ClientDonationController;
use App\Http\Controllers\Website\NotificationController;
use App\Http\Controllers\Website\ReportController;


Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {

        Route::group(['as' => 'website.'], function () {
            Route::get('/', [PageController::class, 'index'])->name('page');
            Route::get('posts-bycategory/{id}', [ArticleController::class, 'postsByCategory'])->name('posts.byCategory');
            Route::resource('articles', ArticleController::class);
            Route::get('about-us', [PageController::class, 'aboutus'])->name('about.us');
            Route::get('donation-requests', [PageController::class, 'requests'])->name('requests');
            Route::get('donation-request-detail/{id}', [PageController::class, 'requestDetail'])->name('details');
            Route::get('contact', [PageController::class, 'contact'])->name('contact');
            Route::post('contact-store', [PageController::class, 'contactStore'])->name('contact.store');
            Route::get('login-view', [LoginController::class, 'loginView'])->name('login.view');
            Route::get('register-view', [RegisterController::class, 'registerView'])->name('register.view');
            Route::post('login', [LoginController::class, 'login'])->name('login.submit');
            Route::post('register', [RegisterController::class, 'register'])->name('register.submit');
            Route::get('/get-cities/{governrate_id}', [RegisterController::class, 'getCities']);

            Route::group(
                ['middleware' => 'auth:client'],
                function () {
                    Route::get('client-reports', [ReportController::class, 'index'])->name('reports.index');
                    Route::get('donation-request-report-create/{id}', [ReportController::class, 'create'])->name('report.create');
                    Route::post('donation-request-report-store', [ReportController::class, 'store'])->name('report.store');
                    Route::delete('donation-request-report-delete/{id}', [ReportController::class, 'destroy'])->name('report.delete');
                    Route::get('client-notifications', [NotificationController::class, 'index'])->name('client.notifications');
                    Route::put('notification-update/{id}', [NotificationController::class, 'update'])->name('notification.update');
                    Route::delete('notification-delete/{id}', [NotificationController::class, 'destroy'])->name('notification.delete');
                    Route::delete('notification-delete-all', [NotificationController::class, 'destroyAll'])->name('notification.delete.all');
                    Route::get('client-donation-requests', [ClientDonationController::class, 'index'])->name('donations.index');
                    Route::get('donation-create', [ClientDonationController::class, 'create'])->name('donation.create');
                    Route::post('donation-store', [ClientDonationController::class, 'store'])->name('donation.store');
                    Route::get('donation-edit/{id}', [ClientDonationController::class, 'edit'])->name('donation.edit');
                    Route::put('donation-update/{id}', [ClientDonationController::class, 'update'])->name('donation.update');
                    Route::delete('donation-delete/{id}', [ClientDonationController::class, 'destroy'])->name('donation.delete');
                    Route::get('password', [ClientProfileController::class, 'password'])->name('client.password');
                    Route::post('change-password', [ClientProfileController::class, 'changePassword'])->name('change.password');
                    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
                    Route::get('posts-favorites', [ClientProfileController::class, 'favoritePosts'])->name('posts.favorites');
                    Route::post('favorites-save/{id}/{redirectTo?}', [ClientProfileController::class, 'toggleFavoriteGeneric'])
                        ->name('favorites.save.generic');
                    Route::get('profile/edit', [ClientProfileController::class, 'edit'])->name('profile.edit');
                    Route::put('profile/update', [ClientProfileController::class, 'update'])->name('profile.update');
                    Route::delete('profile/delete', [ClientProfileController::class, 'destroy'])->name('profile.delete');
                }
            );
        });



        Route::get('/reset-password/{token}', function ($token) {
            return "Reset page for token: $token";
        })->name('password.reset');

        Route::group(['prefix' => 'admin'], function () {
            Auth::routes();
            Route::group(['middleware' => 'auth', 'as' => 'admin.'], function () {
                Route::get('/', [HomeController::class, 'index'])->name('home');
                Route::resource('bloodtypes', BloodtypeController::class);
                Route::resource('governorates', GovernrateController::class);
                Route::resource('cities', CityController::class);
                Route::resource('categories', CategoryController::class);
                Route::resource('posts', PostController::class);
                Route::get('post/{id}', [PostController::class, 'postsByCategory'])->name('byCategory');
                Route::resource('donations', DonationController::class);
                Route::get('donations-details/{id}', [DonationController::class, 'details'])->name('donationDetails');
                Route::resource('messages', ContactController::class);
                Route::resource('clients', ClientController::class);
                Route::resource('users', UserController::class);
                Route::resource('reports', AdminReportController::class);
                Route::resource('roles', RoleController::class);
                Route::get('password', [ProfileController::class, 'password'])->name('password');
                Route::post('changePassword', [ProfileController::class, 'changePassword'])->name('changePassword');
            });
        });
    }
);
