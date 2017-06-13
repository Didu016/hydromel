<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController {

    use AuthorizesRequests,
        DispatchesJobs,
        ValidatesRequests;

    /**
     * Returns json response using customized jsend formats:
     * {
     *     'status' => 'success' OR 'error'
     *     'data' => {AllTheDatas}
     * }
     * @param type $data
     * @param type $status
     * @return type
     */
    public static function jsend($data, $status = 'success') {
        return response()->json(['status' => $status, 'data' => $data]);
    }

}
