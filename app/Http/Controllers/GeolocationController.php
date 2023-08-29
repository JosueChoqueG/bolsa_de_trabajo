<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Geolocation;

class GeolocationController extends Controller
{
    public function getProvinces(Request $request,$id)
    {
        
        if($request->ajax())
        {
            $department_code = substr($id, 0, -4);  
            
            $provinces = Geolocation::where('department_code',$department_code)
                                    ->where('district_code','00')
                                    ->where('province_code','<>','00')->get();

            return response()->json([
                'data' => $provinces
            ]);
        }
    }

    public function getDistricts(Request $request,$id)
    {
        if($request->ajax())
        {
            $department_code = substr($id, 0, -4);
            $province_code   = substr($id, 2, -2); 
            
            $districts       = Geolocation::where('department_code',$department_code)
                                          ->where('province_code',$province_code)
                                          ->where('district_code','<>','00')->get();
    
            return response()->json([
                'data' => $districts
            ]);        
        }
    }
}
