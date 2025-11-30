<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Amount;
use App\Models\Saldo;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Require authentication for all methods in this controller.
     */

     public function __construct(){
        $this->middleware('auth:api');
    }

    /**
     * Retrieve all customers.
     */

    public function getAllCustomers(){
        $customers = User::where('isAdmin', 0)->get();
        return response()->json($customers, 200);
    }

    /**
     * Retrieve customer by given customer ID.
     */

     public function getCustomerInfo(int $customerid){
        $customer = User::find($customerid);

        if(!$customer){
            return response()->json([
                'message' => 'Customer not found'
            ], 404);
        }

        return response()->json($customer, 200);
    }

     /**
     * Retrieve all books of customer.
     */

     public function getCustomerBooks(int $customerid){
        $customers = Saldo::where('userid', $customerid)->get();
        return response()->json($customers, 200);
    }

    /**
     * Update code of amount of customer.
     */

    public function updateAmountCode(Request $request, int $amountid){
        $amount = Amount::find($amountid);

        if(!$amount){
            return response()->json([
                'message' => 'Amount not found'
            ], 404);
        }

        $amount->code = $request->code;
        $amount->save();

        return response()->json([
            'message' => 'Code of amount updated', 
            'amount' => $amount
        ], 200);
    }
}