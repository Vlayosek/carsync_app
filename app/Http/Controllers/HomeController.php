<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use SebastianBergmann\Environment\Console;

class HomeController extends Controller
{


    private $tokenglobal = '';
    private $clientId = '';
    private $userId = '';
    private $deviceId = '';

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('home');
    }

    public function AuthToken(Request $request){

        $baseUrl = env('API_ENDPOINT');

        $username = $request->input('username');
        $password = $request->input('password');
        $realm = $request->input('realm');

        $response = Http::post($baseUrl.'/auth/token',
        [
            'username' => $username,
            'password' => $password,
            'realm' => $realm
        ]);

        $this->tokenglobal = $response['accessToken'];

        session([ 'app.token' => $this->tokenglobal ]);

        return back()->with('success', 'Token Generado Correctamente!');

    }

    public function getClientUserID(Request $request){

        //dd($request);
        $token = session('app.token');

        if($token == null){
            return back()->with('errors', 'Debe Generar Token!');
        }


        $baseUrl = env('API_ENDPOINT');

        $username = $request->input('username');
        $password = $request->input('password');
        $realm = $request->input('subdomain');

        $query['username'] = $username;
        $query['password'] = $password;
        $query['realm'] =  $realm;

        $response = Http::withHeaders([
            'domain' =>  'fleet',
        ])->withToken($token)
        ->post($baseUrl.'/sessions',
        [
            'username' => $username,
            'password' => $password,
            'subdomain' => $realm
        ]);

        //return $response->body();

        $this->clientId = $response['clientId'];
        $this->userId = $response['userId'];

        session([ 'app.userId' => $this->userId ]);
        session([ 'app.clientId' => $this->clientId ]);

        return redirect('home')->with('success', 'ID Generado Correctamente!');
    }

    public function DeviceXUser(){

        $user_id = session('app.userId');
        $token = session('app.token');

        //dd($user_id);

        $baseUrl = env('API_ENDPOINT');


        if(is_null($token)){
            //dd('token');
            return back()->with('errors', 'Debe Generar Token');
        }

        if(is_null($user_id)){
            //dd('user_id');
            return back()->with('errors', 'Debe Generar la sesion PLS!');
        }

        $devices = Device::all();

        // dd($devices);

        if($devices->count() > 0){
            return back()->with('info', 'Ya se encuentran cargados los Dispositivos!');
        }

        /* $headers = [
            'domain' => 'fleet',
            'Authorization' => 'Bearer '. $token.'',
        ]; */

        $response = Http::withHeaders([
            'domain' => 'fleet',
            'Authorization' => 'Bearer '. $token.''
        ])->get($baseUrl.'/users/'.$user_id.'/devices');


        session([ 'app.deviceId' => $this->deviceId ]);

        $data = json_decode($response);

        //dd($data);
        $array = [];
        $arrayIds = [];
        $item = collect();

        $i = 0;

        foreach ($data->items as $mydata) {

                // $item->push($mydata->id);
                array_push($arrayIds, $mydata->id);

                array_push($array, $mydata);

                $device = new Device();
                $device->id_device = $array[$i]->id;
                $device->deviceTypeCode = $array[$i]->deviceTypeCode;
                $device->imei = $array[$i]->imei;
                $device->notes = $array[$i]->notes;
                $device->externalId = $array[$i]->externalId;
                $device->isShareDevice = $array[$i]->isShareDevice;
                $device->createdOn = $array[$i]->createdOn;
                $device->installedOn = $array[$i]->installedOn;
                $device->save();

                $i++;
        }

        //dd($data);

        //Obtener todos los id devices y guardarlos en un array
        /* $arrayIds = [];

        foreach ($data->items as $mydata) {
                array_push($arrayIds, $mydata->id);
        }

        $collection = collect($arrayIds); */
        $items = Device::all();
        $cantDevices = $items->count();

        // dd($arrayIds);
        return back()->with('info', 'Los dispositivos cargaron correctamente!!');
        //return view('devicesXUser',compact('items','cantDevices'))->with('success', 'Los dispositivos se encuentran cargados!');
    }

}
