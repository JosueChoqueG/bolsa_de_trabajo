<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\User;
use App\Model\Role;
use App\Http\Requests\Admin\UserCreateRequest; 
use App\Http\Requests\Admin\UserUpdateRequest; 

class UserController extends Controller
{
    public function index(Request $request)
    {   
        if ($request->ajax()) 
        {
            $users = User::all();
            return response()->json([
                'data' => $users
            ]);
        }
    
        $roles     = Role::all();
        return view('admin.user.index',compact('roles'));
    }

    public function create(UserCreateRequest $request)
    {
        if ($request->ajax())
        {
            $user = User::create(array_merge($request->all(), ['password' => $request->email]));

            return response()->json([
                'action'   => 'insert',
                'message'  => 'Datos registrados correctamente',
                'data'     => $user
            ]);  
        }
    }

    public function update(UserUpdateRequest $request, $id)
    {
        if ($request->ajax())
        {
            
            $user = User::findOrFail($id);
            $user->fill($request->all());
            $user->save();

            return response()->json([
                'action'   => 'update',
                'message'  => 'Datos actualizados correctamente',
                'data'     => $user
            ]);
        }
    }

    public function delete(Request $request,$id)
    {
        if ($request->ajax())
        {
            $user = User::findOrFail($id);
            if($user->status == '0')
            {
                $user->delete();

                return response()->json([
                    'message' => 'Registro eliminado correctamente',
                    'action'  => 'delete'
                ]);
            }
            else
            {
                return response()->json([
                    'message'  => 'No se puede eliminar a un usuario activo',
                    'action'   => 'not_delete'
                ]);

            }
                    
        }
    }

    public function show(Request $request,$id)
    {
        if ($request->ajax()) 
        {
            $user = User::findOrFail($id);
            
            return response()->json([
                'status' => 200,
                'data' => $user
            ]);
        }
    }
}
