<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\GetHistoricalData;
use App\Jobs\SendEmail;
use Exception;

class HistoricalDataController extends Controller
{
    //display form
    public function historicalDataForm()
    {
        $responce = Http::get(config("common.nasdaq_list_url"));
        return view("historicaldata.form",["data" => $responce->collect()]);
    }

    //validation, display data and graph
    public function getHisotricalData(GetHistoricalData $request)
    {
        $input = $request->safe()->all();//get all data if validated successfully

        try{
            //call data from API
            $response = Http::withHeaders([
                'X-RapidAPI-Key' => config('common.rapid_api_key'),
                'X-RapidAPI-Host' => config('common.rapid_api_host')
            ])->get(config('common.historical_data_url'), [
                'symbol' => $input['symbol'],
            ])['prices'];

            //collect data for filter as per date - range
            $date = [
                'start_date' => strtotime($input['start_date']),
                'end_date' => strtotime($input['end_date'])
            ];

            $email_data = [
                'subject' => "Company Name: {$input['company_name']}",
                'message' => "From {$input['start_date']} to {$input['end_date']}",
                'to' => $input['email']
            ];
            SendEmail::dispatch($email_data);
        }catch(Exception $e){
            //In case api not sending a data
            return back()->withInput()->with('error', $e->getMessage());
        }

        return view("historicaldata.display", ["data" => $response, "date" => $date]);
    }
}
