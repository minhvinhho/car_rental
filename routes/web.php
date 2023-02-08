<?php

use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\hq\MainController;
use App\Http\Controllers\site\HomeController;
use Illuminate\Support\Facades\Route;

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




Route::get('/', [HomeController::class, 'index']);
Route::get('/contact', [HomeController::class, 'contactPage']);
Route::get('/about', [HomeController::class, 'aboutPage']);
Route::get('/vehicle', [HomeController::class, 'vehiclePage']);
Route::get('/vehicle/{vehicle_id}', [HomeController::class, 'singelvehicle']);

Route::get('/booking', [HomeController::class, 'bookingPage']);
Route::get('/booking/new', [HomeController::class, 'bookingPageOne']);
Route::get('/booking/new/vehicle/{vehicle_id}', [HomeController::class, 'bookingPageTwo']);
Route::get('/booking/new/vehicle/{vehicle_id}/driver/{driver_id}', [HomeController::class, 'bookingContactPage']);
Route::post('/booking/add', [HomeController::class, 'bookingAdd']);

Route::get('/feedbacks', [HomeController::class, 'feedbackPage']);
Route::post('/feedback/add', [HomeController::class, 'feedbackAdd'])->middleware(['auth']);

Route::get('/faq', [HomeController::class, 'faqPage']);
// Route::middleware(['auth', 'checkifclient'])->group(function () {

// }]);



/*
|--------------------------------------------------------------------------
| AUTH Routes
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'loginIndex']);

Route::post('/login', ['as' => 'login', AuthController::class, 'login']);

Route::get('/logout', [AuthController::class, 'logout'])->middleware(['auth']);

Route::post('/register', [AuthController::class, 'registerClient']);

Route::get('/verify-your-email', [AuthController::class, 'verifyEmailView']);

Route::get('/verify-email', [AuthController::class, 'verifyEmail']);



/*
|--------------------------------------------------------------------------
| HQ Routes
|--------------------------------------------------------------------------
*/
Route::get('/register-admin', [AuthController::class, 'registerAdmin']);


Route::middleware(['auth', 'checkifadmin'])->group(function () {
    Route::get('/admin', [MainController::class, 'index']);

    Route::get('/admin/vehicle', [MainController::class, 'vehicleIndex']);
    Route::post('/admin/vehicle/add', [MainController::class, 'vehicleAdd']);
    Route::get('/admin/vehicle/view/{vehicle_id}', [MainController::class, 'vehicleView']);
    Route::get('/admin/vehicle/delete/{vehicle_id}', [MainController::class, 'vehicleDelete']);
    Route::post('/admin/vehicle/edit/{vehicle_id}', [MainController::class, 'vehicleEdit']);

    Route::get('/admin/driver', [MainController::class, 'driverIndex']);
    Route::post('/admin/driver/add', [MainController::class, 'driverAdd']);
    Route::post('/admin/driver/edit/{driver_id}', [MainController::class, 'driverEdit']);
    Route::get('/admin/driver/delete/{driver_id}', [MainController::class, 'driverdelete']);
 

    Route::get('/admin/vehicle/{vehicle_id}/add-driver/{driver_id}', [MainController::class, 'vehicleDriverAdd']);
    Route::get('/admin/vehicle/{vehicle_id}/remove-driver/{driver_id}', [MainController::class, 'vehicleDriverRemove']);

    Route::get('/admin/booking', [MainController::class, 'BookingIndex']);
    Route::get('/admin/booking/cancel/{booking_id}', [MainController::class, 'bookingCancel']); 
    Route::get('/admin/booking/payment/completed/{booking_id}', [MainController::class, 'bookingPaymentCompleted']);
    Route::get('/admin/booking/payment/uncomplete/{booking_id}', [MainController::class, 'bookingPaymentUncompleted']);

    Route::get('/admin/clients', [MainController::class, 'clientsIndex']);
});
