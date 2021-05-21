<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InventoryModel;

class InventoryController extends Controller
{
    
    public function index()
    {
        return InventoryModel::select('name', 'price', 'qty')
            ->Paginate(10);
    }

    
    public function store(Request $request)
    {
        //no validation
        //InventoryModel? or products.. 
        $products = new InventoryModel;
        $products->name = $request->input('name');
        $products->price = $request->input('price');
        $products->qty = $request->input('qty');
        $products->save();

        return response()->json(array(
            'message' => 'Product added!',
            'products' => $products
        ), 201);
    }

   
    public function show($id)
    {
        $products = InventoryModel::find($id);
        if($products == NULL){
            return response()->json(array(
                'message' => 'Product not found!'
            ), 404);
        }
        return response()->json($products);
    }

    
    public function update(Request $request, $id)
    {
        $products = InventoryModel::find($id);
        if($products == NULL){
            return response()->json(array(
                'message' => 'Product not found!'
            ), 404);
        }
        if ($request->has('name'))
            $products->name = $request->input('name');
        if ($request->has('price')) 
            $products->price = $request->input('price');   
        if ($request->has('qty')) 
            $products->qty = $request->input('qty'); 

    
        $products->save();
        return response()->json(array(
            'message' => 'Product updated!',
            $products
        ));
    }


    
    public function destroy($id)
    {
        $products = InventoryModel::find($id); 
        if($products == NULL){
            return response()->json(array(
                'message' => 'Product not found!'
            ), 404);
        }

        $products->delete();
        return response()->json(array(
            'message' => 'Product deleted!'
        ));
    }
}
