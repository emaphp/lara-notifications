<?php

namespace App\Http\Controllers\API;

use Alas\CommandManager;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TwilioController extends Controller
{
    public function messageResponse(Request $request)
    {
        $message = $this->getBodyMessage($request->getContent());
        $response = (new CommandManager())->analyzeMessage($message);

        return response($response, 200)
            ->header('Content-Type', 'text/plain');
    }

    public function getBodyMessage($content) {
        $archivo = "/var/www/alas-notifications/app/Alas/requests.txt";
        $file = fopen($archivo,"a");
        fwrite($file,$content.PHP_EOL);
        fclose($file);

        parse_str($content, $values);
        return $values['Body'];
    }
}
