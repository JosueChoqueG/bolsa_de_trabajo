<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Resource;
use Session;
use Illuminate\Support\Facades\Validator;

class ResourceController extends Controller
{
    public function index()
    {
        return view('admin.resource.index');
    }

    public function searchImage(Request $request)
    {
        if ($request->ajax()) 
        {
            $resources    = Resource::where('type','image')->orderBy('created_at','desc')->parametro($request)->paginate(6);
            return response()->json([
                'resources' => view('admin.resource.partial',compact('resources'))->render(),
                'type'      => 'image',
                ]);
        }
    }

    public function searchPdf(Request $request)
    {
        if ($request->ajax()) 
        {
            $resources    = Resource::where('type','pdf')->orderBy('created_at','desc')->parametro($request)->paginate(10);
                //}dd($resources);
            return response()->json([
                'resources' => view('admin.resource.partial',compact('resources'))->render(),
                'type'      =>  'pdf',
                ]);
        }
    }

    public function searchDoc(Request $request)
    {
        if ($request->ajax()) 
        {
            $resources    = Resource::where('type','doc')->orderBy('created_at','desc')->parametro($request)->paginate(10);
                //}dd($resources);
            return response()->json([
                'resources' => view('admin.resource.partial',compact('resources'))->render(),
                'type'      => 'doc',
                ]);
            }
    }
    

    public function create(Request $request)
    {
    
        $validator = Validator::make($request->all(),[
            'archivo'  => 'bail|required|unique:resource,name|image|mimes:jpeg,png,jpg|max:10000'
        ]);

        if ($validator->fails()) 
        {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput()
                        ->with('msg-warning','Se encontraron errores de validacion');
        }
       
        $name              = $request->file('archivo')->getClientOriginalName();
        $extension_path    = $request->file('archivo')->getClientOriginalExtension();
        // $name_path         = Session::get('user_id').'_'.date('Ymdhis').'.'.$extension_path;
        $res               = Resource::where('path',$name)->first();
        if($res)
        {
            return \redirect()->back()->with('msg-warning','Ya existe un archivo con el mismo nombre');   
        }

        try
        {
               
            
                $data = ['path'=>$name];

                if($extension_path == 'jpg' || $extension_path == 'JPG' || $extension_path == 'jpeg'|| $extension_path == 'JPEG' || $extension_path == 'jpe' || $extension_path == 'png' || $extension_path == 'PNG')
                $disk = 'image';


                \Storage::disk('resource_'.$disk)->put($name,\File::get($request->File('archivo')));

                $resource                   = new Resource();
                $resource->name             = $name;

                if($extension_path == 'jpg' || $extension_path == 'JPG' || $extension_path == 'jpeg'|| $extension_path == 'JPEG' || $extension_path == 'jpe' || $extension_path == 'png' || $extension_path == 'PNG')
                $resource->type             = 'image';


                $resource->path             = $data['path'];
                $resource->save();

                return \redirect()->back()->with('msg-success','Recurso creado correctamente');
                    
                
        }

        catch (\Exception $e)
        {
           
            return \redirect()->back();
        }
    }

    public function delete(Request $request, $id)
    {
        try
        {
            $res            = Resource::where('id',$id)->first();
            $resource       = Resource::where('id', $id)->delete();

            return response()->json([
                'message'   => 'El recurso se eliminó correctamente!!',
                'action'    => 'delete',
                'type'      => $res->type
                ]);
        }

        catch (\Exception $e)
        {
           abort(500);
        }
    }
}
