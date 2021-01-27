<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MealResourceController;

Route::resource('/meals', MealResourceController::class);
