<?php

use App\Http\Controllers\Admin\Auth\ResetPasswordController;
use App\Http\Controllers\Admin\Auth\SendResetLinkController;
use App\Http\Controllers\Admin\Cashes\DeleteController as CashesDeleteController;
use App\Http\Controllers\Admin\Cashes\StoreController as CashesStoreController;
use App\Http\Controllers\Admin\Cashes\UpdateController as CashesUpdateController;
use App\Http\Controllers\Admin\Categories\BulkDeleteController as CategoriesBulkDeleteController;
use App\Http\Controllers\Admin\Categories\DeleteController as CategoriesDeleteController;
use App\Http\Controllers\Admin\Categories\GetAllController;
use App\Http\Controllers\Admin\Categories\IndexController as CategoriesIndexController;
use App\Http\Controllers\Admin\Categories\StoreController as CategoriesStoreController;
use App\Http\Controllers\Admin\Categories\UpdateController as CategoriesUpdateController;
use App\Http\Controllers\Admin\Couriers\BulkDeleteController as CouriersBulkDeleteController;
use App\Http\Controllers\Admin\Couriers\DeleteController as CouriersDeleteController;
use App\Http\Controllers\Admin\Couriers\IndexController as CouriersIndexController;
use App\Http\Controllers\Admin\Couriers\StoreController as CouriersStoreController;
use App\Http\Controllers\Admin\Couriers\UpdateController as CouriersUpdateController;
use App\Http\Controllers\Admin\Images\UploadController;
use App\Http\Controllers\Admin\Products\BulkDeleteController as ProductsBulkDeleteController;
use App\Http\Controllers\Admin\Products\DeleteController as ProductsDeleteController;
use App\Http\Controllers\Admin\Products\IndexController as ProductsIndexController;
use App\Http\Controllers\Admin\Products\StoreController as ProductsStoreController;
use App\Http\Controllers\Admin\Products\UpdateController as ProductsUpdateController;
use App\Http\Controllers\Admin\Users\BulkDeleteController;
use App\Http\Controllers\Admin\Users\DeleteController;
use App\Http\Controllers\Admin\Users\IndexController;
use App\Http\Controllers\Admin\Users\StoreController;
use App\Http\Controllers\Admin\Users\UpdateController;
use Illuminate\Support\Facades\Route;

Route::domain(config('app.admin_domain'))->group(function () {
    Route::name('password.')->group(function () {
        Route::post('/send-reset-link', SendResetLinkController::class)
            ->name('send-reset-link');
        Route::post('/reset-password', ResetPasswordController::class)
            ->name('reset');
    });

    Route::middleware(['auth:sanctum',])->group(function () {
        Route::prefix('/users')->name('users.')->group(function () {
            Route::get('/', IndexController::class)
                ->name('index');
            Route::post('/', StoreController::class)
                ->name('store');
            Route::put('/{user}', UpdateController::class)
                ->name('update');
            Route::delete('/bulk', BulkDeleteController::class)
                ->name('bulk-delete');
            Route::delete('/{user}', DeleteController::class)
                ->name('delete');
        });

        Route::prefix('/couriers')->name('couriers.')->group(function () {
            Route::get('/', CouriersIndexController::class)
                ->name('index');
            Route::post('/', CouriersStoreController::class)
                ->name('store');
            Route::put('/{courier}', CouriersUpdateController::class)
                ->name('update');
            Route::delete('/bulk', CouriersBulkDeleteController::class)
                ->name('bulk-delete');
            Route::delete('/{courier}', CouriersDeleteController::class)
                ->name('delete');
        });

        Route::prefix('/cashes')->name('cashes.')->group(function () {
            Route::post('/', CashesStoreController::class)
                ->name('store');
            Route::put('/{cash}', CashesUpdateController::class)
                ->name('update');
            Route::delete('/{cash}', CashesDeleteController::class)
                ->name('delete');
        });

        Route::prefix('/products')->name('products.')->group(function () {
            Route::get('/', ProductsIndexController::class)
                ->name('index');
            Route::post('/', ProductsStoreController::class)
                ->name('store');
            Route::put('/{product}', ProductsUpdateController::class)
                ->name('update');
            Route::delete('/bulk', ProductsBulkDeleteController::class)
                ->name('bulk-delete');
            Route::delete('/{product}', ProductsDeleteController::class)
                ->name('delete');
        });

        Route::prefix('/categories')->name('categories.')->group(function () {
            Route::get('/', CategoriesIndexController::class)
                ->name('index');
            Route::get('/all', GetAllController::class)
                ->name('all');
            Route::post('/', CategoriesStoreController::class)
                ->name('store');
            Route::put('/{category}', CategoriesUpdateController::class)
                ->name('update');
            Route::delete('/bulk', CategoriesBulkDeleteController::class)
                ->name('bulk-delete');
            Route::delete('/{category}', CategoriesDeleteController::class)
                ->name('delete');
        });

        Route::prefix('/images')->name('images.')->group(function () {
            Route::post('/upload', UploadController::class)
                ->name('upload');
        });
    });
});