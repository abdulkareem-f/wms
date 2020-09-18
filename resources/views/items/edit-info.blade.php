@extends('layouts.main.master')

@section('title', 'Items - Edit Item Info ('.$item->name.')')

@section('content')

	<form id="item-form" method="post" action="{{ url('items/update-info') }}">
	    @csrf
	    <input type="hidden" name="id" value="{{$item->id}}">
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
		                    <label for="quantity">Quantity <span class="req">*</span></label>
		                    <input type="number" name="quantity" id="quantity" value="{{$item->quantity}}" maxlength="5" class="form-control @error('quantity') is-invalid @enderror" autocomplete="off">
		                    @error('quantity')
		                    	<div class="fv-plugins-message-container">
		                    		<div data-field="quantity" data-validator="notEmpty" class="fv-help-block">{{ $message }}</div>
		                    	</div>
							@enderror
		                </div>
		            </div>
		            <div class="col-md-6">
		                <div class="form-group">
		                    <label for="expiry_date">Expiry Date <span class="req">*</span></label>
		                    <input type="text" name="expiry_date" id="expiry_date" readonly value="{{$item->expiry_date}}" class="form-control @error('expiry_date') is-invalid @enderror" autocomplete="off">
		                    @error('expiry_date')
		                    	<div class="fv-plugins-message-container">
		                    		<div data-field="expiry_date" data-validator="notEmpty" class="fv-help-block">{{ $message }}</div>
		                    	</div>
							@enderror
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
						<button type="submit" class="btn btn-success px-10">Update</button>
					</div>
				</div>
			</div>
		</div>
	</form>

@endsection

@section('js')
<script type="text/javascript">
//------------------------------------------------------------------//
	var KTFormControls = function () {
		
		var _initDemo1 = function () {
			FormValidation.formValidation(
				document.getElementById('item-form'),
				{
					fields: {
						quantity: {
							validators: {
								notEmpty: {
									message: 'Quantity is required'
								},
								digits: {
				              		message: 'The velue is not a valid digits'
				             	},
				             	stringLength: {
					              	max:5,
					              	message: 'Please enter a value less than 99,999'
			             		}
							}
						},
						expiry_date: {
							validators: {
								notEmpty: {
									message: 'Expiry Date is required'
								},
							}
						},
					},

					plugins: { //Learn more: https://formvalidation.io/guide/plugins
						trigger: new FormValidation.plugins.Trigger(),
						// Bootstrap Framework Integration
						bootstrap: new FormValidation.plugins.Bootstrap(),
						// Validate fields when clicking the Submit button
						submitButton: new FormValidation.plugins.SubmitButton(),
	            		// Submit the form when all fields are valid
	            		defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
					}
				}
			);
		}

		return {
			init: function() {
				_initDemo1();
			}
		};
	}();

	jQuery(document).ready(function() {
		KTFormControls.init();
	});
//------------------------------------------------------------------//
	$(function(){
		//================================//
		var today = new Date();
		$('#expiry_date').datepicker({
			format: 'yyyy-mm-dd',
		   todayHighlight: true,
		   orientation: "bottom left",
		   startDate: today,
		   todayBtn: "linked",
	  	});
		//================================//
	});
//------------------------------------------------------------------//
</script>
@endsection