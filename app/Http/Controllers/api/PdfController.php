<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ImagesToPdfRequest;

use Barryvdh\Snappy\Facades\SnappyPdf;


class PdfController extends Controller
{
    public function imagesToPdf(ImagesToPdfRequest $request)
    {
        try {

            $file = $request->file('file');
            $name = time().$file->getClientOriginalName();
            $fileStore = $file->storeAs('images_uploads', $name);
            $pdf = SnappyPdf::loadView('pdf.image-to-pdf', ['image' => 'images_uploads/1680332656t3qWG.png']);
            return $pdf->download('invoice.pdf');

        }catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'something went wrong !',
                'error' =>$th->getMessage()
            ]);
        }
    }

    public function loadPdf(Request $request)
    {
        $pdf = SnappyPdf::loadView('pdf.image-to-pdf', ['image' => 'images_uploads/'.$request->name]);
        return $pdf->download();
    }

}
