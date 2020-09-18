@extends('layouts.main.master')

@section('title', 'Items - View Item ('.$item->name.')')

@section('content')

	<div class="card card-custom">
		<div class="card-header">
			<h3 class="card-title">Item Information</h3>
		</div>
		<div class="card-body">
	        <div class="row">
	            <div class="col-md-6">
	                <div class="form-group">
	                    <label for="name">Name</label>
	                    <h6 class="ml-2">{{$item->name}}</h6>
	                </div>
	            </div>
	            <div class="col-md-6">
	                <div class="form-group">
	                    <label for="name">Manufacturer</label>
	                    <h6 class="ml-2">{{$item->manufacturer}}</h6>
	                </div>
	            </div>
	        </div>
	        <div class="row">
	        	<div class="col-md-6">
	                <div class="form-group">
	                    <label for="name">Quantity</label>
	                    <h6 class="ml-2">{{$item->quantity}}</h6>
	                </div>
	            </div>
	            <div class="col-md-6">
	                <div class="form-group">
	                    <label for="name">Expiry Date</label>
	                    <h6 class="ml-2">{{$item->expiry_date}}</h6>
	                </div>
	            </div>
	        </div>
		</div>
		<div class="card-header">
			<h3 class="card-title">Item Units</h3>
		</div>
		<div class="card-body">
			<table id="units-table" class="table table-bordered table-responsive-md">
			    <thead class="thead-light">
			        <tr>
			            <th width="5%" class="text-center">#</th>
			            <th width="35%">Name</th>
			            <th width="25%">Buy Price</th>
			            <th width="25%">Sell Price</th>
			        </tr>
			    </thead>
			    <tbody>
			    	@foreach($item->units as $unit)
				        <tr data-id="{{$unit->id}}" data-name="{{$unit->name}}">
				            <th class="text-center pt-5">{{$loop->iteration}}</th>
				            <td>{{$unit->name}}</td>
				            <td>{{$unit->buy_price}}</td>
				            <td>{{$unit->sell_price}}</td>
				        </tr>
		        	@endforeach
			    </tbody>
			</table>
		</div>
		<div class="card-footer">
			<div class="row">
				<div class="col-md-4 offset-md-4 text-center">
					<a href="{{url('items')}}" class="btn btn-secondary px-15">Back</a>
				</div>
			</div>
		</div>
	</div>

@endsection

@section('js')
@endsection