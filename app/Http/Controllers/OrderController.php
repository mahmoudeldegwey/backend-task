<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\OrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Order::paginate(10);
        
        return OrderResource::collection($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderRequest $request)
    {
        DB::beginTransaction();

        try{

            $order = Order::create([
                'order_number' => generate_order_number(),
                'type' => $request->type,
                'customer_name' => $request->customer_name,
                'customer_phone' => $request->customer_phone,
                'delivery_fees' => $request->delivery_fees,
                'table_number' => $request->table_number,
                'waiter_name' => $request->waiter_name,
                'total_price' => calculate_total_price_menu_items($request->items)
            ]);

            $order->items()->sync($request->items);
    
            DB::commit();

        }catch(\Exception $e){
            DB::rollBack();
            return response()->json(['message' => $e->getMessage()],500);        
        }

        return new OrderResource($order);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::find($id);

        if (!$order) {
            return response()->json(['message' => 'not found']);        
        }
        
        return new OrderResource($order);   
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Order::destroy($id);

        return response()->json(['message' => 'successfully delete']);        
    }
}
