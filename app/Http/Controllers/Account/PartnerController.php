<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Helper\ApiHelper;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class PartnerController extends Controller
{
    public function index($name)
    {
        try {

            DB::beginTransaction();

            $client = new Client([
                "timeout" => 10
            ]);

            $data = [];

            if ($name == "POLRES") {
                $params = session("data")["province_id"];
            } else if ($name == "POLSEK" ) {
                $params = session("data")["regency_id"];
            } else if ($name == "KODIM") {
                $params = session("data")["province_id"];
            } else if ($name == "KORAMIL") {
                $params = session("data")["regency_id"];
            }

            $responder = $client->get(ApiHelper::apiUrl("/region/" . session("data")["sub_category_organization_id"]["name"] . "/institution/regencies/" . $params));
            $response = json_decode($responder->getBody(), true);

            $data["keamanan"] = $response["data"];

            $dataResponse = $client->post(ApiHelper::apiUrl("/organization/partner/" . session("data")["sub_category_organization_id"]["name"] . "/org/" . session("data")["province_id"]));
            $responseData = json_decode($dataResponse->getBody(), true);

            $data["dataname"] = $name;

            DB::commit();

            if ($responseData["statusCode"] == 200) {

                $data["response"] = $responseData["data"];

                return view("pages.account.partner.index", $data);
            } else {
                return redirect()->route("pages.dashboard")->with("error", $responseData["message"]);
            }
        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->route("pages.dashboard")->with("error", $e->getMessage());
        }
    }

    public function store(Request $request, $name)
    {
        try {

            DB::beginTransaction();
            if ($name == "POLRES") {
                list($id, $datapolsek, $itemname) = explode("|", $request->regency_id);
                $nama = $itemname;
            } else {
                list($id, $dataname, $regency_id) = explode("|", $request->regency_id);
                $nama = $dataname;
            }

            $data = [
                "nama" => $name . " " . $nama,
                "country_code" => $request->country_code,
                "phone_number" => $request->phone_number_pic,
                "nama_pic" => $request->nama_pic,
                "phone_number_pic" => $request->phone_number_pic,
                "alamat_organisasi" => $request->alamat_organisasi,
                "province_id" => session("data")["province_id"],
                "regency_id" => $name == "POLRES" ? $id : $regency_id,
                "district_id" => $name == "POLRES" ? null : $id
            ];
            

            $client = new Client([
                "timeout" => 10
            ]);

            $response = $client->post(
                ApiHelper::apiUrl("/organization/account/admin/create/partner/" . session("data")["institution_id"]),
                [
                    "json" => $data,
                    'headers' => [
                        'Content-Type' => 'application/json'
                    ]
                ]
            );

            $responseBody = json_decode($response->getBody(), true);

            DB::commit();

            if ($responseBody["statusCode"] == 201) {
                return back()->with("success", $responseBody["message"]);
            } else {
                return back()->with("error", $responseBody["message"]);
            }
        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with("error", $e->getMessage())->withInput();
        }
    }

    public function show($id)
    {
        try {

            DB::beginTransaction();

            $data = [];
            $member_account_code = "";
            $response = Http::timeout(10)->get(ApiHelper::apiUrl("/organization/account/admin/$id/show"));

            if ($response->successful()) {
                $responseBody = $response->json();

                if ($responseBody["statusCode"] == 200) {
                    $data["detail"] = $responseBody["data"];

                    $member_account_code = $data["detail"]["member_account_code"];
                } else {
                    return redirect()->route("pages.dashboard")->with("error", "Terjadi Kesalahan");
                }
            }

            $responseRemaining = Http::timeout(10)->get(ApiHelper::apiUrl("/organization/payment/" . $member_account_code . "/remaining_duration"));

            if ($responseRemaining->successful()) {
                $responseBodyRemaining = $responseRemaining->json();

                if ($responseBodyRemaining["statusCode"] == 200) {
                    $data["remaining"] = $responseBodyRemaining["data"]["detail"];
                } else {
                    return redirect()->route("pages.dashboard")->with("error", "Terjadi Kesalahan");
                }
            } else {
                return redirect()->route("pages.dashboard")->with("error", "Terjadi Kesalahan");
            }

            DB::commit();

            return view("pages.account.admin.detail", $data);
        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->route("pages.dashboard")->with("error", $e->getMessage());
        }
    }

    public function upgrade($id)
    {
        try {

            DB::beginTransaction();

            DB::commit();

            return view("pages.account.admin.upgrade");
        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->route("pages.dashboard")->with("error", $e->getMessage());
        }
    }

    public function lihatPolsek($name, $province_id, $regency_id)
    {
        try {

            DB::beginTransaction();

            $data = [];

            $client = new Client([
                "timeout" => 10
            ]);

            $response = $client->get(
                ApiHelper::apiUrl("/region/" . $name . "/institution/districts/" . $regency_id)
            );

            $responsePolsek = $client->post(ApiHelper::apiUrl("/organization/partner/" . $name . "/org/" . $province_id . "/" . $regency_id));

            $responseBody = json_decode($response->getBody(), true);
            $responseBodyPolsek = json_decode($responsePolsek->getBody(), true);


            $data["name"] = $name;

            DB::commit();

            if ($responseBodyPolsek["statusCode"] == 200) {

                $data["detail"] = $responseBody["data"];
                $data["datapolsek"] = $responseBodyPolsek["data"];

            }

            return view("pages.account.partner.lihat-polsek", $data);

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->route("pages.dashboard")->with("error", $e->getMessage());
        }
    }
}
