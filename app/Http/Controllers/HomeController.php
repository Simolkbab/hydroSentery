<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{
    
public function index()
{
    // Fetch sensor data and calculate average debit for each hour
    $averageDebitByHour = DB::table('sensor_data')
        ->select(DB::raw('HOUR(created_at) AS hour'), DB::raw('AVG(debit) AS average_debit'))
        ->groupBy('hour')
        ->get();
        
    return view('home.home', ['averageDebitByHour' => $averageDebitByHour]);
}
}
