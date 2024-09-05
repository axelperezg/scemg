<?php

namespace App\Http\Controllers;

use App\Models\Register;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PdfController extends Controller
{
    public ?array $data = [];

    public Register $register;
    
    public function showpdf()
    {
        return view('createpdf');
    }

    public function pdfinbrowser(Register $register)
    {
        $pdf = Pdf::loadView('createpdf', compact('register'));
        return $pdf->stream('view_oficio_autorizacion.pdf');
    }
    
    public function downloadpdf(Register $register)
    {
        $pdf = Pdf::loadView('createpdf', compact('register'));
        return $pdf->download('download_oficio_autorizacion.pdf');
        //return view('createpdf');
    }
}