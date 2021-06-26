<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NotificationController;
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

Route::post('/publish/{topic}', [NotificationController::class, 'publish_topic']);
Route::post('/subscribe/{topic}', [NotificationController::class, 'subscribe_to_topic']);