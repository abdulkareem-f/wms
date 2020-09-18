<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\ItemResource;
use App\Item;
use App\ItemUnits;

class ItemController extends Controller{
//---------------------------------------------------------//
    public function __construct(){
        $this->middleware('auth:api');
        $this->middleware('admin:api', ['only' => ['create', 'store', 'edit', 'update', 'delete']]);
    }
//---------------------------------------------------------//
    public function index(){
    	$items = Item::with('units')->get();
        return response([ 'message' => 'Retrieved All Items successfully', 'items' => ItemResource::collection($items)], 200);
    }
//---------------------------------------------------------//
    public function store(Request $request){
    	$data = $request->all();

        $validator = Validator::make($data, [
	        'name' 			=> 'required|max:255|unique:items',
	        'manufacturer' 	=> 'required|max:255',
	        'quantity' 		=> 'required|numeric|digits_between:1,5',
	        'expiry_date' 	=> 'required|date',
	    ]);

		if($validator->fails()){
            return response(['error' => $validator->errors(), 'Validation Error']);
        }

		$item = new Item();
		$item->name = $data['name'];
		$item->manufacturer = $data['manufacturer'];
		$item->quantity = $data['quantity'];
		$item->expiry_date = $data['expiry_date'];
		$item->save();

		$unit_name = $data['unit-name'];
		$unit_buy = $data['unit-buy-price'];
		$unit_sell = $data['unit-sell-price'];

		foreach ($unit_name as $key => $unit) {
			$item_unit = new ItemUnits();
			$item_unit->name = $unit_name[$key];
			$item_unit->buy_price = $unit_buy[$key];
			$item_unit->sell_price = $unit_sell[$key];
			$item_unit->item_id = $item->id;
			$item_unit->save();
		}

		return response([ 'message' => 'Created successfully', 'item' => new ItemResource($item), 'units' => new ItemResource($item->units)], 200);
	}
//---------------------------------------------------------//
	public function update(Request $request, Item $item){
		$data = $request->all();

        $validator = Validator::make($data, [
	        'name' 			=> 'required|max:255|unique:items,id,'.$item->user_id,
	        'manufacturer' 	=> 'required|max:255',
	        'quantity' 		=> 'required|numeric|digits_between:1,5',
	        'expiry_date' 	=> 'required|date',
	    ]);

		if($validator->fails()){
            return response(['error' => $validator->errors(), 'Validation Error']);
        }

		$item->name = $data['name'];
		$item->manufacturer = $data['manufacturer'];
		$item->quantity = $data['quantity'];
		$item->expiry_date = $data['expiry_date'];
		$item->save();

		$unit_name = $data['unit-name'];
		$unit_buy = $data['unit-buy-price'];
		$unit_sell = $data['unit-sell-price'];

		foreach ($unit_name as $key => $unit) {
			$item_unit = ItemUnits::find($key);
			if(!$item_unit){
				$item_unit = new ItemUnits();
			}
			$item_unit->name = $unit_name[$key];
			$item_unit->buy_price = $unit_buy[$key];
			$item_unit->sell_price = $unit_sell[$key];
			$item_unit->item_id = $item->id;
			$item_unit->save();
		}
		
		$returned_item = $item->with('units')->first();
		return response([ 'message' => 'Updated successfully', 'item' => new ItemResource($returned_item)], 200);
	}
//---------------------------------------------------------//
	public function show(Item $item){
		$returned_item = $item->with('units')->first();
		return response([ 'message' => 'Retrieved successfully', 'item' => new ItemResource($returned_item)], 200);
    }
//---------------------------------------------------------//
    public function destroy(Item $item){
        $item_units = ItemUnits::where('item_id', $item->id)->get();
		foreach ($item_units as $unit) {
			$unit->delete();
		}
		
		if($item->delete()){
			return response(['message' => 'Deleted successfully'] ,200);
		} else { 
			return response(['message' => 'Something went wrong! Try again'], 400);
		}
    }
//---------------------------------------------------------//
}
