<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\FoodController;
use App\Http\Controllers\Api\ComponentController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\CategoryController;
use Inertia\Inertia;

// Route::get('students', [StudentController::class, 'index']);
Route::get('test', function () {
    return 'API is working';
});

// Route::post('students/store', [StudentController::class, 'store']);
// Route::get('students/{id}', [StudentController::class, 'show']);
// Route::put('students/{id}', [StudentController::class, 'update']);
// Route::delete('students/{id}', [StudentController::class, 'destroy']);

// Route::post('courses', [CourseController::class, 'store']);
// Route::get('courses', [CourseController::class, 'index']);
// Route::put('courses/{id}', [CourseController::class, 'enrollStudent']);



Route::get('foods', [FoodController::class, 'index']);
Route::get('foods/{id}', [FoodController::class, 'show']);
Route::post('foods', [FoodController::class, 'store']);
Route::put('foods/{id}', [FoodController::class, 'update']);
Route::delete('foods/{id}', [FoodController::class, 'destroy']);

// Route::apiResource('components', ComponentController::class);
// Route::apiResource('orders', OrderController::class);
// Route::apiResource('categories', CategoryController::class);