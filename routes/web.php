<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Barryvdh\Snappy\Facades\SnappyPdf;
use App\Http\Controllers\api\PdfController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('file_upload');
});

Route::get('get-pdf',[PdfController::class,'loadPdf']);

Route::post('convert-to-pdf',function (Request $request)
{

    $file = $request->file('image');
    $name = time().$file->getClientOriginalName();
    $fileStore = $file->storeAs('images_uploads', $name);
    return $pdf = SnappyPdf::loadView('pdf.image-to-pdf', ['image' => 'images_uploads/1680332656t3qWG.png']);

});


