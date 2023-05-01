<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HistoricalDataController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/historical-data', [HistoricalDataController::class, 'historicalDataForm'])->name("historicaldata");
Route::post('/get-historical-data', [HistoricalDataController::class, 'getHisotricalData'])->name('gethistoricaldata');
