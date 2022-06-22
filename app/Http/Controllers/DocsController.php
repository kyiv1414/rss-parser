<?php

namespace App\Http\Controllers;

use OpenApi\Generator;

class DocsController extends Controller
{

    public function json(): string
    {
        //do it dirty
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');

        $openapi = Generator::scan([app_path()]);
        return $openapi->toJson();
    }
}
