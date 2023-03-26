<?php

namespace App\Http\Controllers;

use App\DocumentType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DocumentTypeController extends Controller
{
    

    public function getAll(){
        return DocumentType::all();
    }

    public function index()
    {
        $documentsTypes = $this->getAll();

        return view('DocuemntType.index',[
            'documentsTypes' => $documentsTypes
        ]);
    }
    
    public function read()
    {
        $documentsTypes = $this->getAll();

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

    public function destroy(DocumentType $documentType)
    {
        $documentType->delete();

        Session::flash('message', "usted a eliminado un usuario");
        return back();
    } 

    public function edit($id){
        
        
        $pepe = DocumentType::find($id);
       
        $returnHTML = view('DocuemntType.form',[
                'documentType' => $pepe
            ])->render();
 
        return response()->json(['success' => true, 'html'=>$returnHTML]);
    }
    
}
