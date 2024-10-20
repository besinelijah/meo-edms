<?php

use App\Http\Controllers\api\{
    BuildingPermitFormController,
    BusinessPermitFormController,
    MainController
};
use Illuminate\Support\Facades\Route;

Route::post('/register', [MainController::class, 'register']);
Route::post('/login', [MainController::class, 'login']);
Route::prefix('businesspermit')->group(function () {
    Route::get('/', [BusinessPermitFormController::class, 'index']);
    Route::get('/{businessPermitForm}', [BusinessPermitFormController::class, 'show']);
    Route::post('/', [BusinessPermitFormController::class, 'store']);
    Route::post('/changeStatus', [BusinessPermitFormController::class, 'changeStatus']);

});
Route::prefix('buildingpermit')->group(function () {
    Route::get('/', [BuildingPermitFormController::class, 'index']);
    Route::get('/{buildingPermitForm}', [BuildingPermitFormController::class, 'show']);
    Route::post('/', [BuildingPermitFormController::class, 'store']);
    Route::post('/changeStatus', [BuildingPermitFormController::class, 'changeStatus']);
});
