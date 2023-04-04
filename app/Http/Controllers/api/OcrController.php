<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UploadFileRequest;
use thiagoalessio\TesseractOCR\TesseractOCR;

class OcrController extends Controller
{
    public function main(UploadFileRequest $request)
    {
        try {
            $file = $request->file('file');
            $name = time().$file->getClientOriginalName();
            $fileStore = $file->storeAs('ocr_uploads',$name);
            $textData = (new TesseractOCR(storage_path().'/app/'.$fileStore))->run();
            if ($fileStore = $file->storeAs('ocr_uploads',$name)) {
                return response()->json([
                    'success' => true,
                    'message' => 'File uploaded successfully !',
                    'data' => [
                        'imageUrl' => env('APP_URL').$fileStore,
                        'textData' => $textData
                    ]
                ]);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'something went wrong !',
                'error' =>$th->getMessage()
            ]);
        }
    }
}
