<?php

namespace App\Http\Controllers;

use App\Models\Alert;
use App\Models\Device;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class AlertController extends Controller
{

    private $tokenFresh = null;
    private $clientId = null;
    private $userId = null;
    private $deviceId = null;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $clientId=session('app.clientId');
        $from = '';
        $to ='';
        $page = '';
        $pageSize= '';
        $subdomain='';
        $deviceID='';
        $token = session('app.token');
        $domain='';


        if(is_null($token)){
            //dd('token');
            return back()->with('errors', 'Debe Generar Token de Autenticacion');
        }

        if(is_null($clientId)){
            //dd('token');
            return back()->with('errors', 'Debe Generar Sesion PLS');
        }

        $devices = Device::all();

        if($devices->count() == 0){
            return back()->with('info', 'No se encuentran cargados los Dispositivos!');
        }

        //dd($devices);

        return view('devices.index',compact('devices'));

    }

    public function AlertDevices(){


       /*  $clientId=session('app.clientId');
        $token = session('app.token');
        $userId = session('app.userId'); */

        $from= '2021-12-01T00:00:00.00Z';
        $to= '2021-12-07T23:59:59.59Z';
        $page = '0';
        $perPage ='50';

        $subdomain='fleet';
        $domain='fleet';

        $baseUrl = env('API_ENDPOINT');

        if(is_null($this->tokenFresh)){

            //Generar Token automaticamente
            $username ='freddy.pincay@tpg.com.ec';
            $password = 'cjlg>42rE*37mn:1qoCAQ=+f';
            $realm = 'partners';

            $responseAuth = Http::post($baseUrl.'/auth/token',
            [
                'username' => $username,
                'password' => $password,
                'realm' => $realm
            ]);

            $this->tokenFresh = $responseAuth['accessToken'];

            session([ 'app.tokenF' => $this->tokenFresh ]);
            //Fin Token automaticamente
            //return redirect('home');
        }

        //SESION PLS INICIO
        $username = 'oscar.roditi@tpg.com.ec';
        $password = 'Gps@1234';
        $realm = 'fleet';

        $tokenPLS = session('app.tokenF');

        $responseSesion = Http::withHeaders([
            'domain' =>  'fleet',
        ])->withToken($tokenPLS)
        ->post($baseUrl.'/sessions',
        [
            'username' => $username,
            'password' => $password,
            'subdomain' => $realm
        ]);

        $this->clientId = $responseSesion['clientId'];
        $this->userId = $responseSesion['userId'];

        session([ 'app.userId' => $this->userId ]);
        session([ 'app.clientId' => $this->clientId ]);

        //SESION PLS FIN

        $devices = Device::all();

        /* if(is_null($token)){
            return back()->with('errors', 'Debe Generar Token de Autenticacion');
        }

        if(is_null($clientId)){
            return back()->with('errors', 'Debe Generar Sesion PLS');
        } */

        if($devices->count() == 0){
            return back()->with('info', 'No se encuentran cargados los Dispositivos!');
        }

        $array = [];

        //dd($devices);

        foreach($devices as $mydata){

            $device = $mydata->id_device;
            //return $device;
            //$v_device = 'CfDJ8BkoQ5vKuLJBvoUKFH2syytliieI10WsTJvhEUoyKh7uK63l1TlLUk4tr6f3Lj6O7cdYtqHfkEGU-oVuVga4HfLfeCTTbrNjUiTk6L856BxLrOiDVyAxHk68AR2jpRL8Sw';

            $page = '0';

            do{
                $response = Http::withHeaders([
                    'domain' => $domain,
                    'Authorization' => 'Bearer '. $tokenPLS.''
                ])->get($baseUrl.'/'.$subdomain.'/devices/'.$device.'/alerts?clientId='.$this->clientId.'&from='.$from.'&to='.$to.'&page='.$page.'&pageSize=50');


                $data = json_decode($response);

                //dd($data->items);

                /* Faltar filtrar por Ingreso a Muelle Norte
                    Muelle
                    Zona RTG
                    Stacker
                */


                $total = $data->total;
                // dd($total);
                if($total != 0){
                    //array_push($array, $data->items);

                    $i = 0;

                    foreach($data->items as $mydata){

                        $myString = $mydata->body->es;

                        $contains = Str::contains($myString, ['Ingreso a Muelle Norte', 'Muelle', 'Zona RTG','Stacker']);


                        if($contains){

                            array_push($array, $mydata);

                            $alerts = new Alert();
                            $alerts->messageKey = $array[$i]->messageKey;
                            $alerts->tripNumber = $array[$i]->tripNumber;
                            $alerts->imei = $array[$i]->imei;
                            $alerts->address = $array[$i]->address;
                            $alerts->generateTime = $array[$i]->generateTime;
                            $alerts->messageTime = $array[$i]->messageTime;
                            $alerts->deviceIncrementalMessageCounter = $array[$i]->deviceIncrementalMessageCounter;
                            $alerts->addressStatus = $array[$i]->addressStatus;
                            $alerts->heading = $array[$i]->heading;
                            $alerts->lat = $array[$i]->lat;
                            $alerts->lng = $array[$i]->lng;
                            $alerts->speed = $array[$i]->speed;
                            $alerts->isBuffer = $array[$i]->isBuffer;
                            $alerts->alertId = $array[$i]->alertId;
                            $alerts->body = $array[$i]->body;
                            $alerts->alertDescription = $array[$i]->alertDescription;
                            $alerts->temperatureSensorsId = $array[$i]->temperatureSensorsId;
                            $alerts->temperatureSensors = $array[$i]->temperatureSensors;
                            $alerts->geofence = 'cualquier cosa';
                            $alerts->save();

                            $i++;
                        }

                    }

                    $page++;

                }

            }while($total!=0);

        }

    }

    /* public function getAlerts(Request $request){

        $clientId=session('app.clientId');
        $token = session('app.token');
        $userId = session('app.userId');

        $from= '2021-09-20';
        $to= '2021-09-21';
        $page = '0';
        $perPage ='50';

        $subdomain='fleet';
        $domain='fleet';

        $baseUrl = env('API_ENDPOINT');

        $devices = Device::all();

        $array = [];

        foreach($devices as $mydata){

            $device = $mydata->id_device;

            $page = '0';

            do{
                $response = Http::withHeaders([
                    'domain' => $domain,
                    'Authorization' => 'Bearer '. $token.''
                ])->get($baseUrl.'/'.$subdomain.'/devices/'.$device.'/alerts?clientId='.$clientId.'&from='.$from.'&to='.$to.'&page='.$page.'&pageSize=50');


                $data = json_decode($response);

                $total = $data->total;

                if($total != 0){
                    array_push($array, $data->items);
                    $page++;
                }
            }while($total!=0);

        }
        dd($array);

    } */

   /*  public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Alert $alert)
    {
        //
    }

    public function edit(Alert $alert)
    {
        //
    }

    public function update(Request $request, Alert $alert)
    {
        //
    }

    public function destroy(Alert $alert)
    {
        //
    } */
}
