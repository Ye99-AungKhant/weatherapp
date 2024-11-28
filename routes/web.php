<?php

use App\Http\Controllers\WeatherController;
use Illuminate\Support\Facades\Route;


Route::get('/', [WeatherController::class, 'index'])->name('weather.form');
Route::post('/weather', [WeatherController::class, 'getWeather'])->name('weather.get');
