<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Imports\CandidateImport;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    public function importCandidates(Request $request)
    {
        if($request->isMethod('get')){
            return view('admin.import.candidates');
        }

        set_time_limit(380);//380  segundos
        
        $file = $request->file('file');
        try {
            
            \DB::beginTransaction();
            
            Excel::import( new CandidateImport,$file);

            \DB::commit();
            dd('todo bien');
            return redirect()->back()->with('msg-success','Datos cargados correctamente');

        } catch (\Exception $e) {
            
            \DB::rollback();
            dd($e);
            return redirect()->back()->with('msg-exception','No se pudieron cargar los datos: '.$e->getmessage());
        }
    }
}
