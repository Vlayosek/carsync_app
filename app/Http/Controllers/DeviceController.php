<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DeviceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $items = Device::all();
        $cantDevices = $items->count();

        $user_id = session('app.userId');
        $token = session('app.token');
        $deviceId = session('app.deviceId');

        if($items->count() == 0){
            return back()->with('info', 'No se encuentran cargados los Dispositivos!');
        }

         return view('devicesXUser',compact('items','cantDevices'));
    }

}
