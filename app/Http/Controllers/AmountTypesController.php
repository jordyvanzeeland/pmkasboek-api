<?php

namespace App\Http\Controllers;

use App\Models\AmountType;
use Illuminate\Http\Request;

class AmountTypesController extends Controller
{
    /**
     * Require authentication for all methods in this controller.
     */

     public function __construct(){
        $this->middleware('auth:api');
    }

    /**
     * Retrieve all amount types.
     */

     public function getAllTypes(){
        $types = AmountType::get();
        return response()->json($types, 200);
    }

    /**
    * Retrieve a single type by it's id.
    * If type is not found, then it wil give a 404 response
    */

    public function getType(int $typeid){
        $type = Book::find($typeid);

        if(!$type){
            return response()->json([
                'message' => 'Type not found'
            ], 404);
        }

        return response()->json($type, 200);
    }

    /**
    * Insert a new type
    */

    public function insertType(Request $request){
        $newType = AmountType::create($request->all());

        return response()->json([
            'message' => 'New type added', 'type' => $newType
        ], 201);
    }

    /**
    * Update an existing type by it's id.
    * If type is not found, then it wil give a 404 response
    */

    public function updateType(Request $request, int $typeid){
        $type = AmountType::find($typeid);
        
        if(!$typeid){
            return response()->json([
                'message' => 'Type not found'
            ], 404);
        }
        
        $type->update($request->all());
        
        return response()->json([
            'message' => 'Type updated', 'type' => $type
        ], 200);
    }

    /**
    * Delete an existing type by it's id.
    * If type is not found, then it wil give a 404 response
    */

    public function deleteType(int $typeid){
        $type = AmountType::find($typeid);
        
        if(!$typeid){
            return response()->json([
                'message' => 'Type not found'
            ], 404);
        }

        $type->delete();
        
        return response()->json([
            'message' => 'Type deleted'
        ], 200);
    }
}