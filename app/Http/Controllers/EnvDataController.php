<?php

namespace App\Http\Controllers;

use App\EnvData;
use Illuminate\Http\Request;

use App\Http\Requests;

class EnvDataController extends Controller {

    public function graphs() {
        $firstData = EnvData::all()->first();

        $coord_x = $firstData ? $firstData->coord_x : 0;

        $envData = EnvData::where('coord_x', $coord_x)
            ->orderBy('timestamp')
            ->get();

        $labels = [];

        $co_data = [];
        $no2_data = [];
        $proc_no2_data = [];
        $o3_data = [];
        $proc_o3_data = [];

        foreach ($envData as $item) {
            array_push($labels, $item->timestamp);

            array_push($co_data, $item->co == 0 ? null : $item->co);
            array_push($no2_data, $item->no2 == 0 ? null : $item->no2);
            array_push($proc_no2_data, $item->proc_no2 == 0 ? null : $item->proc_no2);
            array_push($o3_data, $item->o3 / 100.0 == 0 ? null : $item->o3 / 100.0);
            array_push($proc_o3_data, $item->proc_o3 == 0 ? null : $item->proc_o3);
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

    public function map() {
        $lastTimestamp = EnvData::orderBy('timestamp', 'desc')->first()->timestamp;

        $latestData = EnvData::where('timestamp', $lastTimestamp)->get();

        $ozoneLevels = [];

        foreach ($latestData as $item) {
            $sensorData['coords']['lng'] = $item->coord_x;
            $sensorData['coords']['lat'] = $item->coord_y;
            $sensorData['o3'] = $item->o3;

            array_push($ozoneLevels, $sensorData);
        }

        dd($ozoneLevels);

        return view('map', compact('ozoneLevels'));
    }

}
