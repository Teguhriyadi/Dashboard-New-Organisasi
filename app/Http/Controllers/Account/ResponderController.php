<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Helper\ApiHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class ResponderController extends Controller
{
    public function indexByAdmin($member_account_code)
    {
        try {

            DB::beginTransaction();

            $data = [];

            $response = Http::get(ApiHelper::apiUrl("/organization/account/responder/" . $member_account_code . "/admin"));

            if ($response->successful()) {

                $responseBody = $response->json();

                if ($responseBody["statusCode"] == 200) {
                    $data["responder"] = $responseBody["data"];
                } else {
                    return redirect()->route("pages.dashboard")->with("error", $responseBody["message"]);
                }
            }

            DB::commit();

            return view("pages.account.responder.index", $data);

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->route("pages.dashboard")->with("error", $e->getMessage());
        }
    }

    public function store(Request $request, $member_account_code)
    {
        try {

            DB::beginTransaction();

            $data = [
                "nama" => $request->nama,
                "country_code" => $request->country_code,
                "phone_number" => $request->phone_number,
                "password" => $request->password
            ];

            $response = Http::post(ApiHelper::apiUrl("/organization/account/admin/" . $member_account_code . "/create_responder"), $data);

            DB::commit();

            $responseBody = $response->json();

            if ($responseBody["statusCode"] == 201) {
                return back()->with("success", $responseBody["message"]);
            } else {
                return back()->with("error", $responseBody["message"]);
            }

        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with("error", $e->getMessage());
        }
    }

    public function show($username)
    {
        try {

            DB::beginTransaction();

            $data = [];

            $response = Http::get(ApiHelper::apiUrl("/organization/account/responder/" . $username . "/show"));

            if ($response->successful()) {

                $responseBody = $response->json();

                if ($responseBody["statusCode"] == 200) {
                    $data["detail"] = $responseBody["data"];
                }
            }

            DB::commit();

            return view("pages.account.responder.detail", $data);

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->route("pages.dashboard")->with("error", $e->getMessage());
        }
    }

    public function destroy($idUser)
    {
        try {

            DB::beginTransaction();

            $response = Http::timeout(10)->delete(ApiHelper::apiUrl("/organization/account/responder/" . $idUser . "/delete/admin"));

            DB::commit();

            $responseBody = $response->json();

            if ($responseBody["statusCode"] == 200) {
                return back()->with("success", "Data Berhasil di Hapus");
            } else {
                return back()->with("error", $responseBody["message"]);
            }

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->route("pages.dashboard")->with("error", $e->getMessage());
        }
    }

    public function changeStatus(Request $request, $idUser)
    {
        try {

            DB::beginTransaction();

            $response = Http::timeout(10)->put(ApiHelper::apiUrl("/organization/account/responder/" . $idUser . "/put/account_status"));

            DB::commit();

            return response()->json([
                "status" => true,
                "message" => "Data Berhasil di Simpan",
                "data" => $response
            ]);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                "status" => false,
                "message" => $e->getMessage()
            ]);
        }
    }

    public function updateStatus($username)
    {
        try {

            DB::beginTransaction();

            $response = Http::put(ApiHelper::apiUrl("/organization/account/responder/" . $username . "/put/account_status"));

            DB::commit();

            $responseBody = $response->json();

            if ($responseBody["statusCode"] == 200) {

                return response()->json([
                    "status" => true,
                    "message" => $responseBody["message"]
                ]);

            } else {
                return response()->json([
                    "status" => false,
                    "message" => $responseBody["message"]
                ]);
            }

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                "status" => false,
                "message" => $e->getMessage()
            ]);
        }
    }
}
