<?php

namespace App\Http\Controllers;

use App\DocumentType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DocumentTypeController extends Controller
{
    public function index()
    {
        $documentsTypes = DocumentType::all();

        return view('DocuemntType.index',[
            'documentsTypes' => $documentsTypes
        ]);
    }
    
    public function read()
    {
        $documentsTypes = DocumentType::all();

        $returnHTML =view('DocuemntType.table',[
            'documentsTypes' => $documentsTypes
        ])->render();

        return response()->json(['success' => true, 'html'=>$returnHTML]);
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
            'name'      => 'required|alpha|min:5|unique:DocumentsTypes',
        ], $messages);
        
        $documentType = new DocumentType();
        $data = $request->only($documentType->getFillable());
        $guardo = $documentType->fill($data)->save();

        if($guardo){
            $mensaje =[
                'icon'=>'success', 
                'html'=>'se creo el registro',
                'title'=>'!Bien Hecho!'
            ];
        }else{
            $mensaje =[
                'icon'=>'error', 
                'html'=>'No pudimos guardar el registro',
                'title'=>'!Algo salio mal!'
            ];
        }

        return response()->json($mensaje);
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
            'name'      => 'required|alpha|min:5|unique:DocumentsTypes',
        ], $messages);
        
        $documentType = DocumentType::find($request->id);
        $data = $request->only($documentType->getFillable());
        $guardo = $documentType->fill($data)->save();

        if($guardo){
            $mensaje =[
                'icon'=>'success', 
                'html'=>'se actualizo el registro',
                'title'=>'!Bien Hecho!'
            ];
        }else{
            $mensaje =[
                'icon'=>'error', 
                'html'=>'No pudimos guardar el registro',
                'title'=>'!Algo salio mal!'
            ];
        }

        return response()->json($mensaje);
    }

    public function destroy(Request $request, $id)
    {
        $documentType = DocumentType::find($id);

        if ($documentType) {
            $documentType->delete();
            if ($request->ajax()) {
                return response()->json([
                    'title' => '¡Eliminación exitosa!',
                    'html' => 'El tipo de documento ha sido eliminado exitosamente',
                    'icon' => 'success'
                ]);
            } else {
                return response()->json([
                    'success' => true,
                    'message' => 'El tipo de documento ha sido eliminado exitosamente',
                    'html' => view('documentType.table')->render(),
                ]);
                
            }
        } else {
            if ($request->ajax()) {
                return response()->json([
                    'title' => '¡Error!',
                    'html' => 'El tipo de documento no existe',
                    'icon' => 'error'
                ]);
            } else {
                return redirect()->route('documentType.index')->with('error', 'El tipo de documento no existe');
            }
        }
    }


    public function edit($id)
    {
        
        
        $pepe = DocumentType::find($id);
       
        $returnHTML = view('DocuemntType.form',[
                'documentType' => $pepe
            ])->render();
 
        return response()->json(['success' => true, 'html'=>$returnHTML]);
    }
    
}
