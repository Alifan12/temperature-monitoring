<?php

namespace App\Http\Controllers;

use App\Models\Sensor;
use Illuminate\Http\Request;

class SensorController extends Controller
{
    public function index()
    {
        $unique_dates = Sensor::selectRaw('DATE(created_at) as unique_date')
                        ->distinct()
                        ->latest()
                        ->first();
        // dd($unique_dates);2024-06-29
        $datas = Sensor::whereDate('created_at', "2024-06-28")
                        ->get();
        $day = date('l, d M Y', strtotime("2024-06-28"));
        // $datas = Sensor::whereDate('created_at', $unique_dates->unique_date)
        //                 ->get();
        // $day = date('l, d M Y', strtotime($unique_dates->unique_date));
        $lastData = $datas->last();
        $arrayData = [];
        
        foreach ($datas as $key => $data) {
            $formattedTime = date('H.i', strtotime($data->created_at));
            $floatTime = floatval(str_replace('', '', $formattedTime));

            $newArray = [
                $floatTime, 
                $data->t22,
                $data->h22,
                $data->ppm
            ];
            array_push($arrayData, $newArray);
        }

        return view('dashboard.index', compact('arrayData', 'day', 'lastData'));
    }
}
