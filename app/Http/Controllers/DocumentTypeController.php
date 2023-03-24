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
        $request->validate([
            'name'      =>['required'],
        ]);

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
    
}
