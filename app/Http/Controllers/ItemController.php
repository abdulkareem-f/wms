<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Item;
use App\ItemUnits;
use Yajra\Datatables\Datatables;
use Carbon\Carbon;

class ItemController extends Controller{
//---------------------------------------------------------//
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('admin', ['only' => ['create', 'store', 'edit', 'update', 'delete']]);
    }
//---------------------------------------------------------//
	public function index(){
		return view('items.index');
	}
//---------------------------------------------------------//
	public function itemsDatatable(Request $request){
		$items = Item::orderBy('created_at', 'desc')->get();

        return Datatables::of($items)
        		->addColumn('units_count', function($col){
        			return count($col->units->toArray());
        		})->make(true);
	}
//---------------------------------------------------------//
	public function create(){
		return view('items.create');
	}
//---------------------------------------------------------//
	public function store(Request $request){
		$request->validate([
	        'name' 			=> 'required|max:255|unique:items',
	        'manufacturer' 	=> 'required|max:255',
	        'quantity' 		=> 'required|numeric|digits_between:1,5',
	        'expiry_date' 	=> 'required|date',
	    ]);

		$data = $request->all();

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

		session()->flash('success', 'The Item has been created successfully');
		return redirect('items');
	}
//---------------------------------------------------------//
	public function show(Item $item){
		return view('items.show', compact('item'));
	}
//---------------------------------------------------------//
	public function edit(Item $item){
		return view('items.edit', compact('item'));
	}
//---------------------------------------------------------//
	public function update(Request $request, Item $item){
		$request->validate([
	        'name' 			=> 'required|max:255|unique:items,id,'.$item->user_id,
	        'manufacturer' 	=> 'required|max:255',
	        'quantity' 		=> 'required|numeric|digits_between:1,5',
	        'expiry_date' 	=> 'required|date',
	    ]);

		$data = $request->all();

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
		session()->flash('success', 'The Item has been updated successfully');

		return redirect('items');
	}
//---------------------------------------------------------//
	public function destroy(Item $item){
		$item_units = ItemUnits::where('item_id', $item->id)->get();
		foreach ($item_units as $unit) {
			$unit->delete();
		}
		
		if($item->delete()){
			session()->flash('success', 'The Item has been deleted successfully');
			return response()->json(['success' => true]);
		} else { 
			session()->flash('error', 'Something went wrong! Try again');
			return response()->json(['success' => false]);
		}
	}
//---------------------------------------------------------//
	public function deleteUnit(Request $request){
		$id = $request['id'];
		$item_unit = ItemUnits::find($id);
		if($item_unit->delete()){
			return response()->json(['success' => true]);
		} else {
			return response()->json(['success' => false]);
		}
	}
//---------------------------------------------------------//
	public function editInfo($id){
		$item = Item::find($id);
		return view('items.edit-info', compact('item'));
	}
//---------------------------------------------------------//
	public function updateInfo(Request $request){
		$request->validate([
	        'quantity' 		=> 'required|numeric|digits_between:1,5',
	        'expiry_date' 	=> 'required|date',
	    ]);

		$data = $request->all();

		$id = $data['id'];
		$item = Item::find($id);
		$item->quantity = $data['quantity'];
		$item->expiry_date = $data['expiry_date'];
		$item->save();

		//============================================//
		$item_name = $item->name;
		$today_date = Carbon::now()->toDateString();
		if($data['quantity']==0 || $data['expiry_date']==$today_date){

			if($data['quantity']==0 && $data['expiry_date']==$today_date){
				$admin_msg = 'Item ('.$item_name.') is out of stock and expired';
			} else {
				if($data['quantity']==0){
					$admin_msg = 'Item ('.$item_name.') is out of stock';
				} elseif($data['expiry_date']==$today_date){
					$admin_msg = 'Item ('.$item_name.') is expired';
				}
			}

			$data = [
                'email_subject'  	=>  'Item ('.$item_name.') updates',
                'admin_msg'      	=>  $admin_msg,
            ];

            $admin = User::where('role', 'admin')->first();

            Mail::to($admin->email)->send(new \App\Mail\ItemOutStockOrExpired($data));
		}
		//============================================//

		session()->flash('success', 'The Item (Quantity & Expiry Date) has been updated successfully');

		return redirect('items');
	}
//---------------------------------------------------------//
}
