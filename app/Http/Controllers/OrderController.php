<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderCollection;
use App\Models\Order;
use App\Models\OrderProduct;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       return new OrderCollection(Order::with('user')->with('products')->where('estado',0)->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // stores
        $order = new Order;
        $order->user_id = Auth::user()->id;
        $order->total = $request->total;
        $order->save();

        // Get ID Order
        $id = $order->id;

        // Get the products

        $products = $request->products;

        // Formart array

        $order_product = [];

        foreach($products as $product){
            $order_product[] = [
                'order_id' => $id,
                'product_id' => $product['id'],
                'quantity' => $product['quantity'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];
        }
        // Store in the DB
        OrderProduct::insert($order_product);

        return [
            'message' => 'Pedido realizado correctamente, estará listo en unos minutos'
        ];
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        $order->estado = 1;
        $order->save();
        return [
            'order' => $order
        ];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
