<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\MenuItemResource;
use App\Models\MenuItem;
use App\Http\Requests\MenuItemRequest;

class MenuItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = MenuItem::paginate(10);

        return MenuItemResource::collection($data);
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
    public function store(MenuItemRequest $request)
    {
        $menuItem = MenuItem::create([
            'name' => $request->name,
            'price' => $request->price
        ]);

        return new MenuItemResource($menuItem);   
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $menuItem = MenuItem::find($id);

        if (!$menuItem) {
            return response()->json(['message' => 'not found']);        
        }
        
        return new MenuItemResource($menuItem);   
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
        $menuItem = MenuItem::find($id);

        if (!$menuItem) {
            return response()->json(['message' => 'not found']);        
        }

        MenuItem::where('id', $id)->update([
            'name' => $request->name,
            'price' => $request->price
        ]);

        return response()->json(['message' => 'successfully updated']);        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        MenuItem::destroy($id);

        return response()->json(['message' => 'successfully delete']);        
    }
}
