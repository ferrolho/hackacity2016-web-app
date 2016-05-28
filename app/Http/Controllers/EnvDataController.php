<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class EnvDataController extends Controller {

    public function graphs() {
        return view('graphs');
    }

}
