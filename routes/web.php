<?php

use App\Http\Controllers\AlertController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {

    if(Auth::check()){
        return view('home');
    }else{
        return view('auth.login');
    }

});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/DeviceXUser',[HomeController::class,'DeviceXUser'])->name('home.devices');
Route::post('/AuthToken',[HomeController::class,'AuthToken'])->name('home.auth');
Route::post('/SesionPls',[HomeController::class,'getClientUserID'])->name('home.sessionpls');


Route::get('devices', [DeviceController::class,'index'])->name('devices.index');

Route::get('/alerts/get',[AlertController::class,'AlertDevices'])->name('alerts.get');
Route::post('/getAlerts',[AlertController::class,'getAlerts'])->name('alerts.getAlerts');
Route::resource('alerts', AlertController::class);

