<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Role;
use App\Model\Route;
use App\Model\RouteRole;
use DB;

class RoleController extends Controller
{
    public function index(Request $request)
    {
        $roles = Role::all();
        return view('admin.role.index', compact('roles'));
    }

    public function create(Request $request)
    {
        if ($request->isMethod('get'))
        {
			$data['routes'] = Route::all();
			$data['url']    = 'admin/roles/create';

    		return view('admin.role.register',$data);	    		
    	}
		//si viene por metodo POST
    	$this->validate($request, [
            'name'        => 'required|unique:role|max:30',
            'description' => 'bail|sometimes|nullable|max:100'
		]);
    	//registramos el rol
    	try {
    		DB::beginTransaction(); //iniciamos la transaccion
    		$role =  Role::create($request->all());
	    	//registramos los permisos
	    	$role->routes()->sync($request->routes);
	    	 
	    	DB::commit(); //confirmamos la transaccion

			return redirect('admin/roles')->with('msg-success','Datos registrados correctamente');	
			
    	} catch (\Exception $e) {
    		  DB::rollback(); //si se produce algun error al insertar, restablecemos la bd a como estaba antes
                
            return redirect('admin/roles')->with('msg-error','Ocurrio un error al registrar el rol');	    
    	}
    	

    }
    public function update(Request $request,$id)
    {
		if ($request->isMethod('get'))
		{	
    		$routesRol= RouteRole::where('role_id',$id)->select('route_id')->get();
			$routesAsigned=[];

			for ($i=0; $i < count($routesRol) ; $i++) {
				$routesAsigned[$routesRol[$i]->route_id]=$routesRol[$i]->route_id; 
			}

			$data['routes']        = Route::all();
			$data['routesAsigned'] = $routesAsigned;
			$data['role']          = Role::find($id);
			$data['url']           = 'admin/roles/'.$id.'/update';
			
    		return view('admin/role.register',$data);	    		
    	}
		//si viene por metodo POST
		
    	$this->validate($request, [
			'name'        => 'required|max:30|unique:role,id,' . $id. ',id',
			'description' => 'bail|sometimes|nullable|max:100'
		]);

		try 
		{
			DB::beginTransaction();
			$role              = Role::findOrfail($id);
			$role->update($request->all());

			$role->routes()->sync($request->routes);
			DB::commit();

    		return redirect('admin/roles')->with('msg-success','Datos actualizados correctamente');
		
		} catch (\Exception $th) 
		{
			DB::rollback();
			return redirect('admin/roles')->with('msg-danger','No se pudo realizar los cambios');
		}
	}
	public function delete(Request $request,$id)
    {
		try
		{
			$routeRol = RouteRole::where('role_id',$id)->delete();
			$rol = Role::findOrFail($id);
			$rol->delete();
		
			return redirect('admin/roles')->with('msg-success','Rol eliminado correctamente');
		}
		catch (\Exception $e)
		{	
			return redirect('admin/roles')->with('msg-danger',' No se pudo eliminar el rol');
		}
    }
}
