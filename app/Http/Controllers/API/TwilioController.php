<?php

namespace App\Http\Controllers\API;

use Alas\CommandManager;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TwilioController extends Controller
{
    public function messageResponse(Request $request)
    {
        $all = $request->getContent();
        parse_str($all, $values);

//        $archivo="/var/www/alas-notifications/app/Alas/requests.txt";
//        $file=fopen($archivo,"a");
//        fwrite($file,$values['Body']."\r\n");
//        fclose($file);

        $response = (new CommandManager())->analyzeMessage($values['Body']);

        return response($response, 200)
            ->header('Content-Type', 'text/plain');
    }
}
