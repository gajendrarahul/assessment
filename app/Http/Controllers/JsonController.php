<?php

namespace App\Http\Controllers;

use App\Exports\JsonFileExport;
use App\Http\Requests\JsonFileValidationRequest;
use App\Jobs\ExportJsonToExcelJob;
use App\Models\JsonFile;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class JsonController extends Controller
{
    //trait to upload file stored in storage public directory
    use FileUploadTrait;
    //function to  upload json file
    public function uploadJsonFile(JsonFileValidationRequest $request)
    {
        try {
            $validated = $request->validated();
            if ($validated) {
                $folder = 'uploads/json_files';
                $filePath = $this->uploadFile($request->file('json_file'), $folder, 'public');
                $jsonFile = new JsonFile();
                $jsonFile->file_path = $filePath;
                $jsonFile->user_id = Auth::id();
                $jsonFile->save();
                Session::flash('success', 'File uploaded successfully');
            } else {
                Session::flash('error', 'Something went wrong');
            }
        } catch (\Exception $e) {
            Session::flash('error', 'File upload failed: ' . $e->getMessage());
        }

        return back();
    }

// function to export jsonfile to excel
    public function exportJsonFileToExcel(Request $request){
        $jsonFile = JsonFile::findOrFail($request->json_file_id);  // findOrFail will throw 404 error if not found 
        $jsonContents = $this->getJsonData($jsonFile->file_path); //decoding json data
        $exportModal = new JsonFileExport($jsonContents);  //creating jsonfile  object
        ExportJsonToExcelJob::dispatch($exportModal, $jsonFile->file_path); //dispatching job to queue
        Session::flash('success', 'File exported successfully'); //displaying success message
        return back();
    }


// function for json file decoding 
    private function getJsonData($jsonFilePath)
    {
        $jsonContents = Storage::disk('public')->get($jsonFilePath);  //getting json file from storage
        return json_decode($jsonContents, true); //decoding json
    }

}
