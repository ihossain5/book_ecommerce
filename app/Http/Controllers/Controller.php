<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController {
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    // succes function
    function success($data) {
        return response()->json([
            'success' => true,
            'data'    => $data,
        ]);
    }

    // error function
    function error($data) {
        return response()->json([
            'success' => false,
            'data'    => $data,
        ]);
    }
}
