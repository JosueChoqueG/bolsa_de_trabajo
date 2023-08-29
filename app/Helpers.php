<?php

use App\Model\Route;
use App\Model\RouteRole;
use GuzzleHttp\Client;
use App\Model\Geolocation;
use App\Model\JobOffer;
use App\Model\Countrie;
use App\Model\SystemParameter;
use Illuminate\Support\Str;

//funcion que evalua si el usuario tiene permiso para una acción
function permission($ruta)
{
    $rol_id = Session::get('role_id');
    $route  = Route::where('value', $ruta)->first();

    if ($rol_id && $route) {
        $routeRole = RouteRole::where('route_id', $route->id)
            ->where('role_id', $rol_id)->first();
        if ($routeRole)
            return true;
    }
    return false;
}
function queryRuc($ruc)
{
    try {
        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'http://dniruc.apisperu.com',
            // You can set any number of default request options.
            'timeout'  => 15.0,
        ]);
        // Send a request to https://foo.com/api/test
        $response = $client->request('GET', '/api/v1/ruc/'.$ruc.'?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6ImRhbmllbGJxMTExMTQ0QGdtYWlsLmNvbSJ9.CEv92-KrYbg7z0n34j_V9DIMcvv-ndoixGxo2UHC7Xs');

        $data['status'] = $response->getStatusCode();
        $data['getBody'] =    json_decode($response->getBody()->getContents());
          
        return $data;
    }
    catch (\Exception $e) {

        $data['status'] = $e->getCode();
        $data['message'] = $e->getMessage();
        
        return $data;
       
    } 
}

function put_session_sunat($data)
{
    Session::put('temp_ruc',$data['ruc']);
    Session::put('temp_razon_social',$data['razonSocial']);
    Session::put('temp_domicilio_fiscal',$data['direccion']);
    Session::put('temp_nombre_comercial',$data['nombreComercial']);
    Session::put('temp_act_economicas',$data['actEconomicas']);
}
function forget_session_sunat()
{
    Session::forget('temp_ruc');
    Session::forget('temp_razon_social');
    Session::forget('temp_domicilio_fiscal');
    Session::forget('temp_nombre_comercial');
    Session::forget('temp_act_economicas');
}


function getWorkplace($geolocation_id)
{
   
    $location = "";
    if(! is_null($geolocation_id))
    {
        $department = "";
        $province = "";
        $district = "";

        $department_code    = substr($geolocation_id, 0, -4);
        
        $query_department   = Geolocation::where('id',$department_code.'0000')->select('name')->first();
        $department = $query_department->name;

        $province_code      = substr($geolocation_id, -4, 2); 
        $district_code      = substr($geolocation_id, -2);
        
       // dd($department_code,$province_code,$district_code);
        if($province_code != '00'){
            $query_province           = Geolocation::where('id',$department_code.''.$province_code.'00')->select('name')->first();
            $province = $query_province->name;

            if($district_code != '00'){
                $query_district           = Geolocation::where('id',$geolocation_id)->select('name')->first();
                $district = $query_district->name;
            }
        }
    
        if($district)
            $location   = $department.'-'.$province.'-'.$district;

        if(!$district && $province)
            $location   = $department.'-'.$province;

        if(!$district && !$province && $department)
            $location   = $department;
    }
    return $location;

}

function getVisitsCounter(){
    $counter = 0;
    $data = SystemParameter::find('visits_counter');

    if($data){
        $counter = $data->parameter_value;
    }
  
    return $counter;
}
function addVisitsCounter(){
    $counter = 0;
    $data = SystemParameter::find('visits_counter');

    if($data){
        $counter               = intval($data->parameter_value)+1+0;
        $data->parameter_value = $counter;
        $data->save();
    }
}

function getStartSessionCounter(){
    $counter = 0;
    $data = SystemParameter::find('start_session');

    if($data){
        $counter = $data->parameter_value;
    }
  
    return $counter;
}
function addStartSessionCounter(){
    $counter = 0;
    $data = SystemParameter::find('start_session');

    if($data){
        $counter               = intval($data->parameter_value)+1+0;
        $data->parameter_value = $counter;
        $data->save();
    }
}


function generateSlug($text)
{
    $date_now = date('YmdHis');
    $slug = Str::slug(Str::limit($text, 110,''), '-').'-'.uniqid();

    return $slug;
}