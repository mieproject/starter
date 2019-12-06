<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class FileCon extends Controller
{
    public function __construct()
    {
     //   $this->middleware('auth');
    }

    public function store(Request $request, $path, $inputName = null)
    {
        $input = $request->all();

//        $rules = array(
//
//        );
//
//        $validation = Validator::make($input, $rules);
//
//        if ($validation->fails())
//        {
//            return Response::make($validation->errors->first(), 400);
//        }

        $file = $request->file('file');

//        dd($file);
        $directory = storage_path('app/public/'.$path);
        $upload_success = $file->move($directory, $file->getClientOriginalName());

        if ($upload_success) {
            return response()->json('success', 200);
        } else {
            return response()->json('error', 400);
        }

    }
}
