<?php

namespace App\Http\Controllers\API\General;

use App\Http\Controllers\Controller;
use App\Models\Table1;
use Illuminate\Http\Request;

class Table1Controller extends Controller
{
    public function getTree(){
        
        $success['success'] = true;
        $success['data'] = Table1::tree();

        return response()->json(['success' => $success], 200);

    }
}
