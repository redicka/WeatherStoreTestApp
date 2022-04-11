<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\WeatherHistory;
use Carbon\Carbon;

class WeatherController extends Controller
{
    public function generateTestData(Request $request)
    {
        $count = WeatherHistory::count();
        $generate_rows_count = $request->query('generate_rows_count', 100);
        if ($count == 0) {
            $data = [];
            for ($i = 0; $i < $generate_rows_count; $i++) {
                array_push($data, [
                    "temp" => rand(-1, 12),
                    "created_at" => Carbon::now()->subDays($generate_rows_count - $i)
                ]);
            }
            WeatherHistory::insert($data);
        };
        return response();
    }

    public function getLastTemp(Request $request)
    {
        $resp = WeatherHistory::orderBy('created_at', 'desc')->take(1)->select('id', 'temp', 'created_at')->get();
        return response($resp->jsonSerialize(), Response::HTTP_OK);
    }

    public function getLastTemps(Request $request)
    {
        $count = $request->query('count', 1);
        $resp = WeatherHistory::orderBy('created_at', 'desc')->take($count)->select('id', 'temp', 'created_at')->get();
        return response($resp->jsonSerialize(), Response::HTTP_OK);
    }

    public function getTempsByDates(Request $request)
    {
        $start_date = Carbon::createFromFormat('Y-m-d', $request->start_date)->format('Y-m-d');
        $end_date = Carbon::createFromFormat('Y-m-d', $request->end_date)->format('Y-m-d');
        $resp = WeatherHistory::where('created_at', '>=', $start_date)->where('created_at', '<=', $end_date)
            ->select('id', 'temp', 'created_at')->get();
        return response($resp->jsonSerialize(), Response::HTTP_OK);
    }

}
