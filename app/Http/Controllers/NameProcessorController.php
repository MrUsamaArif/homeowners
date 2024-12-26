<?php

namespace App\Http\Controllers;

use App\Http\Requests\CsvUploadRequest;
use App\Models\NameProcessor;

class NameProcessorController extends Controller
{

    public function uploadCsv(CsvUploadRequest $request)
    {

        $filePath = $request->file('csv_file')->storeAs(
            'uploads',
            uniqid() . '_' . $request->file('csv_file')->getClientOriginalName()
        );

        $result = new NameProcessor();
        $result = $result->processCsv(storage_path('app/public/' . $filePath));
        return response()->json($result);
    }

}
