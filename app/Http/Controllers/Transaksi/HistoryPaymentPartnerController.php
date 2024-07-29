<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use App\Http\Helper\ApiHelper;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HistoryPaymentPartnerController extends Controller
{
    public function index()
    {
        try {

            DB::beginTransaction();

            $data = [];

            $client = new Client([
                "timeout" => 10
            ]);

            $response = $client->get(ApiHelper::apiUrl("/"));

            DB::commit();

            return view("pages.transaksi.history-payment-partner.index");

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->route("pages.dashboard")->with("error", $e->getMessage());
        }
    }
}
