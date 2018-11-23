<?php

namespace App\Http\Controllers\API;

use App\Profile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use  DB;

class FilePickerController extends Controller
{
    public function getFilePicker(Request $request)
    {
        $profile = DB::table('profiles')->select('id','picture')->where('user_id', $request->input('user_id'))->first();
        return response()->json([
            'profile' => $profile
        ]);
    }

    public function setFilePicker(Request $request)
    {
        DB::table('profiles')->where('id', $request->id)->update(['picture' => $request->url]);
    }
}
