<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Amount;
use Illuminate\Http\Request;

class AmountsController extends Controller
{
    /**
     * Require authentication for all methods in this controller.
     */

     public function __construct(){
        $this->middleware('auth:api');
    }

    /**
     * Retrieve all amounts of userid.
     */

     public function getAllAmountsOfUser(){
        $user = Auth::user();
        $amounts = Amount::with('type')->where('userid', $user->id)->get();
        return response()->json($amounts, 200);
    }

    /**
    * Retrieve a single amount by it's id.
    * If amount is not found, then it wil give a 404 response
    */

    public function getAmount(int $amountid){
        $amount = Amount::find($typeid);

        if(!$amount){
            return response()->json([
                'message' => 'Amount not found'
            ], 404);
        }

        return response()->json($amount, 200);
    }

    /**
    * Insert a new amount
    */

    public function insertAmount(Request $request){
        $user = Auth::user();
        $request["userid"] = $user->id;

        $newAmount = Amount::create($request->all());
        
        return response()->json([
            'message' => 'New amount added', 
            'amount' => $newAmount
        ], 201);
    }

    /**
    * Update an existing amount by it's id.
    * If amount is not found, then it will give a 404 response
    */

    public function updateAmount(Request $request, int $amountid){
        $amount = Amount::find($amountid);

        if(!$amount){
            return response()->json([
                'message' => 'Amount not found'
            ], 404);
        }

        $user = Auth::user();
        $request["userid"] = $user->id;
        
        $amount->update($request->all());

        return response()->json([
            'message' => 'Amount updated', 
            'amount' => $amount
        ], 200);
    }

    /**
    * Delete an existing amount by it's id.
    * If amount is not found, then it wil give a 404 response
    */

    public function deleteAmount(int $amountid){
        $amount = Amount::find($amountid);
        
        if(!$amount){
            return response()->json([
                'message' => 'Amount not found'
            ], 404);
        }

        $amount->delete();

        return response()->json([
            'message' => 'Amount deleted'
        ], 200);
    }
}