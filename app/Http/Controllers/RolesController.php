<?php

namespace App\Http\Controllers;

use App\Rol;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    public function index()
    {
        $rols = Rol::all();
        
        return view('rols.index', [
            'rols' => $rols
        ]);
    }

    public function read()
    {
        $rols = Rol::all();

        $returnHTML = view('rols.table', [
            'rols' =>  $rols 
        ])->render();

        return response()->json(['success' => true, 'html' => $returnHTML]);
    }

    public function store(Request $request)
    {
        $messages = [
            'name.required' => 'El campo :attribute es requerido.',
            'name.alpha' => 'El campo :attribute debe tener solo letras',
            'name.min' => 'El campo :attribute debe tener como minimo 5 caracteres',
            'name.unique' => 'El campo :attribute debe ser unico'
        ];
        $request->validate([
            'name'      => 'required|alpha|min:5|unique:Rols',
        ], $messages);

        $rols = new Rol();
        $data = $request->only($rols->getFillable());
        $guardo = $rols->fill($data)->save();


        if ($guardo) {
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
        $rols = Rol::find($id);

        $returnHTML = view('rols.form', [
            'rol' => $rols,
            'action' => route('rols.update')
        ])->render();

        return response()->json(['success' => true, 'html' => $returnHTML]);
    }

    public function update(Request $request)
    {
        $messages = [
            'name.required' => 'El campo :attribute es requerido.',
            'name.alpha' => 'El campo :attribute debe tener solo letras',
            'name.min' => 'El campo :attribute debe tener como minimo 5 caracteres',
            'name.unique' => 'El campo :attribute debe ser unico'
        ];
        $request->validate([
            'name'      => 'required|alpha|min:5|unique:Rols',
        ], $messages);

        $rols = Rol::find($request->id);
        $data = $request->only($rols->getFillable());
        $guardo = $rols->fill($data)->save();

        if ($guardo) {
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
        $rols = Rol::find($id);

        if ($rols) {
            $rols->delete();
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
                    'html' => view('rols.table')->render(),
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
                return redirect()->route('rols.index')->with('error', 'El usuario no existe');
            }
        }
    }
}                

