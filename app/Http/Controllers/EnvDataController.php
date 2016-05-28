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
        $firstTimestamp = EnvData::orderBy('timestamp')->first()->timestamp;
        $lastTimestamp = EnvData::orderBy('timestamp', 'desc')->first()->timestamp;

        $t1 = strtotime($lastTimestamp);
        $t2 = strtotime($firstTimestamp);
        $diff = $t1 - $t2;
        $hours = floor($diff / (60 * 60));

        $latestData = EnvData::where('timestamp', $lastTimestamp)->get();

        $ozoneLevels = [];

        foreach ($latestData as $item) {
            $sensorData['coords']['lng'] = $item->coord_x;
            $sensorData['coords']['lat'] = $item->coord_y;
            $sensorData['o3'] = $item->o3;

            array_push($ozoneLevels, $sensorData);
        }

        return view('map', compact('ozoneLevels', 'firstTimestamp', 'lastTimestamp', 'hours'));
    }

    public function getSensorData($hours) {
        $firstTimestamp = EnvData::orderBy('timestamp')->first()->timestamp;

        $timestamp = date("Y-m-d H:i:s.0", strtotime($firstTimestamp) + $hours * 3600);

        $timestamp = EnvData::where('timestamp', '>=', $timestamp)->first()->timestamp;

        $data = EnvData::where('timestamp', $timestamp)->get();

        $ozoneLevels = [];

        foreach ($data as $item) {
            $sensorData['coords']['lng'] = $item->coord_x;
            $sensorData['coords']['lat'] = $item->coord_y;
            $sensorData['o3'] = $item->o3;

            array_push($ozoneLevels, $sensorData);
        }

        return $ozoneLevels;
    }

}
