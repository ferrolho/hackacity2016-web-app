<?php

namespace App\Http\Controllers;

use App\EnvData;
use Illuminate\Http\Request;

use App\Http\Requests;

class EnvDataController extends Controller {

    public function graphs() {
        $envData = EnvData::orderBy('timestamp')->get();

        $labels = [];

        $co_data = [];
        $no2_data = [];
        $proc_no2_data = [];
        $o3_data = [];
        $proc_o3_data = [];

        foreach ($envData as $item) {
            array_push($labels, $item->timestamp);

            array_push($co_data, $item->co);
            array_push($no2_data, $item->no2);
            array_push($proc_no2_data, $item->proc_no2);
            array_push($o3_data, $item->o3 / 100.0);
            array_push($proc_o3_data, $item->proc_o3);
        }

        return view('graphs', compact(
            'labels',
            'co_data',
            'no2_data',
            'proc_no2_data',
            'o3_data',
            'proc_o3_data'
        ));
    }

}
