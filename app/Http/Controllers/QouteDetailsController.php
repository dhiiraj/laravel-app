<?php

namespace App\Http\Controllers;

use App\Models\QouteDetails;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;

class QouteDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        try {
            /** call api service here */
            $response = Http::get('https://www.alphavantage.co/query?function=GLOBAL_QUOTE&symbol=' . $request->query('query') . '&apikey=0O18XUJW9P8QVGQJ');
            if ($response->successful()) {
                $i = 1;
                $insert_data = [];
                foreach ($response->json()['Global Quote'] as $key => $value) {
                    $removestr = sprintf("%02d", $i) . '. ';
                    $i++;
                    $key = str_replace($removestr, '', $key);
                    $key = str_replace(' ', '_', $key);
                    array_push($insert_data, [$key => $value]);
                }
                $flattened = Arr::collapse($insert_data);
            }
            DB::beginTransaction();
            if (isset($flattened['symbol'])) {
                QouteDetails::updateOrCreate(
                    ['symbol' => $flattened['symbol']],
                    [
                        'open' => $flattened['open'],
                        'high' => $flattened['high'],
                        'low' => $flattened['low'],
                        'price' => $flattened['price'],
                        'volume' => $flattened['volume'],
                        'latest_trading_day' => $flattened['latest_trading_day'],
                        'previous_close' => $flattened['previous_close'],
                        'change' => $flattened['change'],
                        'change_percent' => $flattened['change_percent'],
                    ]
                );
                DB::commit();
                $response = [
                    'data' => $flattened,
                    'status' => true,
                    'message' => "Fetched successfully",
                ];
            } else {
                $response = [
                    'data' => [],
                    'status' => false,
                    'message' => "No data found",
                ];
            }
        } catch (Exception $e) {
            DB::rollBack();
            $response = [
                'data' => [],
                'status' => false,
                'message' => "Failed Try again !!",
            ];
        }
        return response()->json($response);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\QouteDetails  $qouteDetails
     * @return \Illuminate\Http\Response
     */
    public function show(QouteDetails $qouteDetails)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\QouteDetails  $qouteDetails
     * @return \Illuminate\Http\Response
     */
    public function edit(QouteDetails $qouteDetails)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\QouteDetails  $qouteDetails
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, QouteDetails $qouteDetails)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\QouteDetails  $qouteDetails
     * @return \Illuminate\Http\Response
     */
    public function destroy(QouteDetails $qouteDetails)
    {
        //
    }
}
