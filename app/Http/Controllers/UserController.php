<?php

namespace App\Http\Controllers;

use App\User;
use App\DocumentType;
use App\Rol;
use App\UserRol;
use Illuminate\Hashing\BcryptHasher;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        
        $users = User::all();
        
       
        return view('users.index', [
            'users' => $users
        ]);
    }

    public function read()
    {
        $users = User::all();

        $returnHTML = view('users.table', [
            'users' => $users
        ])->render();

        return response()->json(['success' => true, 'html' => $returnHTML]);
    }

    public function store(Request $request)
    {
        $messages = [
            'document.required' => 'El campo :attribute es requerido.',
            'document.unique' => 'El campo :attribute ya ha sido registrado.',
            'nickname.required' => 'El campo :attribute es requerido.',
            'email.required' => 'El campo :attribute es requerido.',
            'email.unique' => 'El campo :attribute ya ha sido registrado.',
            'email.email' => 'El campo :attribute debe ser un correo.',
            'password.required' => 'El campo :attribute es requerido.',
        ];
        $request->validate([
            'document' => 'required|unique:users',
            'nickname' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ], $messages);

        $user = new User();
        $data = $request->only($user->getFillable());
        $data ['password'] = bcrypt($request->password);
        $guardo = $user->fill($data)->save();

        
        if ($guardo) {
            $roles = $request->idRol;
            $user->rols()->sync($roles);
            
            $mensaje = [
                'icon' => 'success',
                'html' => 'Se creó el usuario',
                'title' => '!Bien Hecho!'
            ];
        } else {
            $mensaje = [
                'icon' => 'error',
                'html' => 'No pudimos guardar el usuario',
                'title' => '!Algo salió mal!'
            ];
        }
        return response()->json($mensaje);
    }

    public function edit($id)
    {
        $user = User::find($id);
        $documentsTypes = DocumentType::all()->pluck('name','id')->toArray();
        $rols = Rol::all()->pluck('name', 'id')->toArray();

        $returnHTML = view('users.form', [
            'documentsTypes' => $documentsTypes,
            'rols' => $rols,
            'user' => $user,
            'action' => route('users.update')
        ])->render();

        return response()->json(['success' => true, 'html' => $returnHTML]);
    }

    public function update(Request $request)
    {
        $messages = [
            'document.required' => 'El campo :attribute es requerido',
            'nickname.required' => 'El campo :attribute es requerido.',
            'email.required' => 'El campo :attribute es requerido.',
            'email.email' => 'El campo :attribute debe ser un correo.',
            'password.required' => 'El campo :attribute es requerido.',
        ];
        $request->validate([
            'document' => 'required',
            'nickname' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ], $messages);

        $user = User::find($request->id);
        $data = $request->only($user->getFillable());
        $guardo = $user->fill($data)->save();
        
        if ($guardo) {
            $roles = $request->idRol;
            $user->rols()->sync($roles);
            
            $mensaje = [
                'icon' => 'success',
                'html' => 'Se actualizó el usuario',
                'title' => '!Bien Hecho!'
            ];
        } else {
            $mensaje = [
                'icon' => 'error',
                'html' => 'No pudimos actualizar el usuario',
                'title' => '!Algo salió mal!'
            ];
        }
        return response()->json($mensaje);
    }

    public function destroy(Request $request, $id)
    {
        $user = User::find($id);

        if ($user) {
            $user->delete();
            if ($request->ajax()) {
                return response()->json([
                    'title' => '¡Eliminación exitosa!',
                    'html' => 'El usuario ha sido eliminado exitosamente',
                    'icon' => 'success'
                ]);
            } else {
                return response()->json([
                    'success' => true,
                    'message' => 'El usuario ha sido eliminado exitosamente',
                    'html' => view('users.table')->render(),
                ]);
                
            }
        } else {
            if ($request->ajax()) {
                return response()->json([
                    'title' => '¡Error!',
                    'html' => 'El usuario no existe',
                    'icon' => 'error'
                ]);
            } else {
                return redirect()->route('users.index')->with('error', 'El usuario no existe');
            }
        }
    }
}                
