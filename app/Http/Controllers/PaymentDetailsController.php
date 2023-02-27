<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Payement;
use Illuminate\Http\Request;

class PaymentDetailsController extends Controller
{
    public function index()
    {
        
        try {
            $allPayment = Payement::all();
            if ($allPayment != null) {
                return response()->json([
                    'status' => 'true',
                    'data' => $allPayment,
                ], 201);
            } else {
                return response()->json([
                    'status' => 'true',
                    'msg' => 'there is no payement now '
                ],201);
            }
        } catch (Exception $ex) {
            return response()->json(['status' => 'error', 'expcetion' => $ex->getMessage(), 'msg' => 'failed to get reviews'], 500);
        }

    }

    public function store(Request $request)
    {
        $payement = new Payement();
        $payement->user_id = $request->user_id;
        $payement->payment_type = $request->payment_type;
        $payement->provider = $request->provider;
        $payement->account_no = $request->account_no;
        $payement->expiry = $request->expiry;
        $payement->save();
        return response()->json([
            'status' => 'true',
            'msg' => 'data stored successfuly'
        ], 201);
    }

    public function show($id)
    {
        try {
            $payement = Payement::find($id);
            if ($payement != null) {
                return response()->json([
                    'status' => 'true',
                    'user' => $payement,
                ], 201);
            } else {
                return response()->json([
                    'status' => 'true',
                    'msg' => 'no records with this id ,please check id ! '
                ],201);
            }
        } catch (Exception $ex) {
            return response()->json(['status' => 'error', 'expcetion' => $ex->getMessage(), 'msg' => 'view process failed'], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $payement = Payement::find($id);
            if ($payement != null) {
                $payement->rate = $request->rate;
                $payement->desc = $request->desc;
                $payement->save();
                return response()->json([
                    'status' => 'true',
                    'msg' => 'your payement is updated now'
                ],201);
            } else {
                return response()->json([
                    'status' => 'true',
                    'msg' => 'no records with this id ,please check id ! '
                ],201);
            }
        } catch (Exception $ex) {
            return response()->json(['status' => 'error', 'expcetion' => $ex->getMessage(), 'msg' => 'update process failed'], 500);
        }
    }

    public function destroy($id)
    {
        try {

            $payement = Payement::find($id);
            if ($payement != null) {
                $payement->delete();
                return response()->json([
                    'status' => 'true',
                    'msg' => 'your payement is deleted now'
                ],201);
            } else {
                return response()->json([
                    'status' => 'true',
                    'msg' => 'no records with this id ,please check id ! '
                ],201);
            }
        } catch (Exception $ex) {
            return response()->json(['status' => 'error', 'expcetion' => $ex->getMessage(), 'msg' => 'delete process failed'], 500);
        }
    }
}
