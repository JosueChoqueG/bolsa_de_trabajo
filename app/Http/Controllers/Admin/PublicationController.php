<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Publication;
use DB;
use Session;
use App\Http\Requests\Admin\PublicationCreateRequest; 
use App\Http\Requests\Admin\PublicationUpdateRequest;
use App\Model\Image;

class PublicationController extends Controller
{
    public function index(Request $request)
    {   
       $publications = Publication::with('user')->title($request->title)->orderBy('created_at', 'desc')->paginate(15);
       $parameter = $request->input('title');
        return view('admin.publication.index', compact('parameter','publications')); 
    }

    public function find($id)
    {
        try{

            $publication = Publication::with('user')->where('id',$id)->first();

            return response()->json([
                'data'   => $publication,
            ]);
        }
        catch (\Exception $e)
        {
            abort(500,'Ocurrio un error');
        }
    }

    public function create(PublicationCreateRequest $request)
    {
        if ($request->ajax())
        {
            try
            {  
                DB::beginTransaction();

                $array  = [
                    'user_id'=> Session::get('user_id'),
                    'slug'       => generateSlug($request->title)
                ];
                $publication = Publication::create(array_merge($request->all(), $array));
                DB::commit();    

                return response()->json([
                    'action'   => 'create',
                    'message'  => 'Datos registrados correctamente',
                ]);
            }
            
            catch (Exception $e)
            {
                DB::rollback();

                abort(500,'Se produjo un error al enviar los datos, intentalo otra vez');
            }
        }
        
    }

    public function update(PublicationUpdateRequest $request, $id)
    {
        if($request->ajax())
        {
            try
            {  
                DB::beginTransaction();

                $array  = [
                    'user_id'          => Session::get('user_id'),
                ];
                $publication = Publication::where('id',$id)->first();
                $publication->update(array_merge($request->all(),$array));
                DB::commit();//confirmamos la transaccion

                return response()->json([
                    'message'  => 'Datos actualizados correctamente',
                    'action'    => 'update',
                ]);
            
            }
            catch (\Exception $e)
            {
                DB::rollback();//si se produce algun error al insertar, restablecemos la bd a como estaba antes
                abort(500,'Ocurrio un error');
            }
        }
    }

    public function delete(Request $request, $id)
    {
        try
        {
            
            $publication = Publication::where('status',1)->where('id', $id)->first();
            if(isset($publication) == false)
            {
                $publication = Publication::where('id', $id)->delete();
                return response()->json([
                    'message'  => 'Su publicación se eliminó correctamente!!',
                    'action'   => 'delete', 
                ]);
            }
            else
            {
                return response()->json([
                    'message'  => 'No se puede eliminar una publicación que tiene estado publicado!!',
                    'action'   => 'not_delete' 
                ]);
            }
        }
        catch (\Exception $e)
        {
            abort(500,'Ocurrio un error');
        }
    }

    public function images(Request $request, $id)
    {
        $images         = Image::where('publication_id',$id)->paginate(6);
        $publication    = Publication::where('id',$id)->first(); 
        return view('admin.publication.gallery', compact('images','publication')); 
    }

    public function imagesCreate(Request $request, $id) 
    {
        if ($request->ajax())
        {
            $this->validate($request,[
                'publication_id'    => 'bail|required',
                'resource_id'       => 'bail|required',
                'path'              => 'bail|required|max:200',
            ]);
 
            $image = Image::create($request->all());
            return response()->json([
                'action'   => 'insert',
                'image'    => $image,
                'message'  => 'Datos registrados correctamente',
            ]);
        }
    }

    public function imagesDelete(Request $request, $id) 
    {
       
        if ($request->ajax())
        {
            $image = Image::where('id', $id)->delete();
            
            return response()->json([
                'message'  => 'Su imagen se eliminó correctamente!!',
                'action'   => 'delete', 
            ]);
        }
    }
}
