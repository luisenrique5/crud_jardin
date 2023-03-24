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
    
    public function store(Request $request)
    {
        $messages = [
            'name.required' => 'El campo nombre es requerido.',
            'name.alpha' => 'El campo debe tener solo letras',
            'name.min' => 'El campo debe tener como minimo 5 caracteres',
            'name.unique' => 'El campo debe ser unico'
        ];
        $request->validate([
            'name'      => 'required|alpha|min:5|unique:DocumentsTypes',
        ], $messages);

        DocumentType::create([
            'name'=> $request->name,
        ]);

        return back();
    }

    public function destroy(DocumentType $documentType)
    {
        $documentType->delete();

        Session::flash('message', "usted a eliminado un usuario");
        return back();
    } 

    public function edit($id){
        $documentsType = DocumentType::find($id);

        $returnHTML = view('DocuemntType.form',[
                'documentType' => $documentsType
            ])->render();

        return response()->json(['success' => true, 'html'=>$returnHTML]);
    }
    
}
