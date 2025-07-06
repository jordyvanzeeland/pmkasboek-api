<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Saldo;
use Illuminate\Http\Request;

class SaldosController extends Controller
{
    /**
     * Require authentication for all methods in this controller.
     */

     public function __construct(){
        $this->middleware('auth:api');
    }

    /**
     * Retrieve start saldo and bookyear of userid.
     */

     public function getUserStartSaldo(){
        $user = Auth::user();
        $saldo = Saldo::where('userid', $user->id)->get();
        $count = $saldo->count();
        return response()->json(['count' => $count, 'books' => $saldo], 200);
    }

    /**
    * Retrieve a single saldo by it's id.
    * If saldo is not found, then it wil give a 404 response
    */

    public function getSaldo(int $saldoid){
        $saldo = Saldo::find($saldoid);

        if(!$saldoid){
            return response()->json([
                'message' => 'Saldo not found'
            ], 404);
        }

        return response()->json($saldo, 200);
    }

    /**
    * Insert a new saldo and bookyear
    */

    public function insertSaldo(Request $request){
        $user = Auth::user();
        $request["userid"] = $user->id;

        $newSaldo = Saldo::create($request->all());

        return response()->json([
            'message' => 'New saldo added', 
            'newbook' => $newSaldo
        ], 201);
    }

    /**
    * Update an existing saldo and bookyear by it's id.
    * If it's not found, then it will give a 404 response
    */

    public function updateSaldo(Request $request, int $saldoid){
        $saldo = Saldo::find($saldoid);

        if(!$saldo){
            return response()->json([
                'message' => 'Saldo not found'
            ], 404);
        }

        $user = Auth::user();
        $request["userid"] = $user->id;
        
        $saldo->update($request->all());

        return response()->json([
            'message' => 'Saldo updated', 
            'saldo' => $saldo
        ], 200);
    }

    /**
    * Delete an existing saldo and bookyear by it's id.
    * If it's not found, then it wil give a 404 response
    */

    public function deleteSaldo(int $saldoid){
        $saldo = Saldo::find($saldoid);
        
        if(!$saldo){
            return response()->json([
                'message' => 'Saldo not found'
            ], 404);
        }

        $saldo->delete();
        
        return response()->json([
            'message' => 'Saldo deleted'
        ], 200);
    }
}