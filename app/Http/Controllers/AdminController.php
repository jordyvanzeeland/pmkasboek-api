<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
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
     * Retrieve all books of customer.
     */

     public function getCustomerBooks(int $customerid){
        $customers = Saldo::where('userid', $customerid)->get();
        return response()->json($customers, 200);
    }
}