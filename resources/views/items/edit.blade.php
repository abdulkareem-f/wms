@extends('layouts.main.master')

@section('title', 'Items - Edit Item ('.$item->name.')')

@section('content')

<form id="item-form" method="post" action="{{ url('items/'.$item->id) }}">
    @csrf
    @method('PUT')
	<div class="card card-custom">
		<div class="card-header">
			<h3 class="card-title">Item Information</h3>
		</div>
		<div class="card-body">
	        <div class="row">
	            <div class="col-md-6">
	                <div class="form-group">
	                    <label for="name">Name <span class="req">*</span></label>
	                    <input type="text" name="name" id="name" value="{{$item->name}}" class="form-control @error('name') is-invalid @enderror" autocomplete="off">
	                    @error('name')
	                    	<div class="fv-plugins-message-container">
	                    		<div data-field="name" data-validator="notEmpty" class="fv-help-block">{{ $message }}</div>
	                    	</div>
						@enderror
	                </div>
	            </div>
	            <div class="col-md-6">
	                <div class="form-group">
	                    <label for="manufacturer">Manufacturer <span class="req">*</span></label>
	                    <input type="text" name="manufacturer" id="manufacturer" value="{{$item->manufacturer}}" class="form-control @error('manufacturer') is-invalid @enderror" autocomplete="off">
	                    @error('manufacturer')
	                    	<div class="fv-plugins-message-container">
	                    		<div data-field="manufacturer" data-validator="notEmpty" class="fv-help-block">{{ $message }}</div>
	                    	</div>
						@enderror
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
			            <th width="10%" class="text-center">Delete</th>
			        </tr>
			    </thead>
			    <tbody>
			    	@foreach($item->units as $unit)
				        <tr data-id="{{$unit->id}}" data-name="{{$unit->name}}">
				            <th class="text-center pt-5">{{$loop->iteration}}</th>
				            <td>
				            	<div class="form-group mb-0">
					            	<input type="text" name="unit-name[{{$unit->id}}]" value="{{$unit->name}}" class="unit-name form-control" data-name="unit-name">
					            </div>
				            </td>
				            <td>
				            	<div class="form-group mb-0">
				            		<input type="number" name="unit-buy-price[{{$unit->id}}]" value="{{$unit->buy_price}}" class="unit-buy-price form-control" data-name="unit-buy-price">
			            		</div>
				            </td>
				            <td>
				            	<div class="form-group mb-0">
				            		<input type="number" name="unit-sell-price[{{$unit->id}}]" value="{{$unit->sell_price}}" class="unit-sell-price form-control" data-name="unit-sell-price
				            		">
				            	</div>
				            </td>
				            @if ($loop->first)
				            	<td></td>
			            	@else
					            <td class="text-center">
					            	<span class="remove-unit-row fas fa-times-circle icon-lg text-danger hand"></span>
					            </td>
				            @endif
				        </tr>
		        	@endforeach
			    </tbody>
			    <tfoot>
			    	<tr>
			    		<td colspan="4"></td>
			    		<td class="text-center ">
			    			<span id="add-item-unit" class="fas fa-plus-square icon-lg text-primary hand"></span>
			    		</td>
			    	</tr>
			    </tfoot>
			</table>
		</div>
		<div class="card-footer">
			<div class="row">
				<div class="col-md-4 offset-md-4 text-center">
					<a href="{{url('items')}}" class="btn btn-secondary px-10">Back</a>
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
	// Class definition
	var KTFormControls = function () {
		// Private functions
		var _initDemo1 = function () {
			FormValidation.formValidation(
				document.getElementById('item-form'),
				{
					fields: {
						name: {
							validators: {
								notEmpty: {
									message: 'Name is required'
								},
							}
						},
						manufacturer: {
							validators: {
								notEmpty: {
									message: 'Manufacturer is required'
								},
							}
						},
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
						// unit_name: {
						// 	selector: '[data-name="unit-name"]',
						// 	validators: {
						// 		notEmpty: {
						// 			message: 'Unit Name is required'
						// 		},
						// 	}
						// },
						// unit_buy_price: {
						// 	selector: '[data-name="unit-buy-price"]',
						// 	validators: {
						// 		notEmpty: {
						// 			message: 'Unit Buy Price is required'
						// 		},
						// 		digits: {
				  //             		message: 'The velue is not a valid digits'
				  //            	},
				  //            	stringLength: {
					 //              	max:10,
					 //              	message: 'Please enter a value less than 9,999,999,999'
			   //           		}
						// 	}
						// },
						// unit_sell_price: {
						// 	selector: '[data-name="unit-sell-price"]',
						// 	validators: {
						// 		notEmpty: {
						// 			message: 'Unit Sell Price is required'
						// 		},
						// 		digits: {
				  //             		message: 'The velue is not a valid digits'
				  //            	},
				  //            	stringLength: {
					 //              	max:10,
					 //              	message: 'Please enter a value less than 9,999,999,999'
			   //           		}
						// 	}
						// },
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
function delete_unit($units_table){
	$units_table.find('.remove-unit-row').unbind('click').click(function(){
		var $this = $(this);
		var $tr = $this.closest('tr');
		if($tr.data('id')){
			var id = $tr.data('id');
			var name = $tr.data('name');
			_confirm('Delete Unit ('+name+')', 'Are you sure?', 'warning', 'Yes', 'Cancel', function(){
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: 'post',
                data:{id: id},
                url: '{{url('items/delete-unit')}}'
            }).done(function (res) {
                if(res.success){
                	$this.closest('tr').remove();
                    Swal.fire('Deleted!', 'The Unit ('+name+') has been deleted successfully', 'success');
                } else {
                	Swal.fire('Error!', 'Something went wrong! Try again', 'error');
                }
            });
        });
		} else {
			$this.closest('tr').remove();
		}
		
		$units_table.find('tbody tr th:first-of-type').each(function(i){
			$(this).text(i+1);
		});
	});
}
//------------------------------------------------------------------//
	$(function(){
		//================================//
		var $units_table = $('#units-table');
		delete_unit($units_table);
		//================================//
		var today = new Date()
		var tomorrow = new Date(today)
		tomorrow.setDate(tomorrow.getDate() + 1)
		$('#expiry_date').datepicker({
			format: 'yyyy-mm-dd',
		   todayHighlight: true,
		   orientation: "bottom left",
		   startDate: tomorrow
	  	});
	  	//================================//
	  	$('#add-item-unit').click(function(){
	  		var $units_table = $('#units-table');
	  		var tr_count = $units_table.find('tbody tr').length;
	  		var tr_html = `
	  			<tr>
		            <th class="text-center pt-5">`+(tr_count + 1)+`</th>
		            <td>
		            	<input type="text" name="unit-name[]" class="unit-name form-control req">
		            </td>
		            <td>
		            	<input type="number" name="unit-buy-price[]" class="unit-buy-price form-control req">
		            </td>
		            <td>
		            	<input type="number" name="unit-sell-price[]" class="unit-sell-price form-control req">
		            </td>
		            <td class="text-center">
		            	<span class="remove-unit-row fas fa-times-circle icon-lg text-danger hand"></span>
		            </td>
		        </tr>
	  		`;
	  		$units_table.find('tbody').append(tr_html);
	  		delete_unit($units_table);
	  	});
	  	//================================//
	});
//------------------------------------------------------------------//
</script>
@endsection