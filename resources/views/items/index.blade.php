@extends('layouts.main.master')

@section('title', 'Items')

@section('content')

    <div class="card card-custom">
    	<div class="card-header flex-wrap border-0 pt-6 pb-0">
			<div class="card-title">
				<h3 class="card-label">Items Management</h3>
			</div>
			<div class="card-toolbar">
				<div class="dropdown dropdown-inline mr-2">
					<button type="button" class="btn btn-light-primary font-weight-bolder dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<span class="svg-icon svg-icon-md">
						<!--begin::Svg Icon | path:assets/media/svg/icons/Design/PenAndRuller.svg-->
						<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
							<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
								<rect x="0" y="0" width="24" height="24" />
								<path d="M3,16 L5,16 C5.55228475,16 6,15.5522847 6,15 C6,14.4477153 5.55228475,14 5,14 L3,14 L3,12 L5,12 C5.55228475,12 6,11.5522847 6,11 C6,10.4477153 5.55228475,10 5,10 L3,10 L3,8 L5,8 C5.55228475,8 6,7.55228475 6,7 C6,6.44771525 5.55228475,6 5,6 L3,6 L3,4 C3,3.44771525 3.44771525,3 4,3 L10,3 C10.5522847,3 11,3.44771525 11,4 L11,19 C11,19.5522847 10.5522847,20 10,20 L4,20 C3.44771525,20 3,19.5522847 3,19 L3,16 Z" fill="#000000" opacity="0.3" />
								<path d="M16,3 L19,3 C20.1045695,3 21,3.8954305 21,5 L21,15.2485298 C21,15.7329761 20.8241635,16.200956 20.5051534,16.565539 L17.8762883,19.5699562 C17.6944473,19.7777745 17.378566,19.7988332 17.1707477,19.6169922 C17.1540423,19.602375 17.1383289,19.5866616 17.1237117,19.5699562 L14.4948466,16.565539 C14.1758365,16.200956 14,15.7329761 14,15.2485298 L14,5 C14,3.8954305 14.8954305,3 16,3 Z" fill="#000000" />
							</g>
						</svg>
						<!--end::Svg Icon-->
					</span>Export</button>
					<div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
						<!--begin::Navigation-->
						<ul class="navi flex-column navi-hover py-2">
							<li class="navi-header font-weight-bolder text-uppercase font-size-sm text-primary pb-2">Choose an option:</li>
							<li class="navi-item">
								<a href="#" class="navi-link">
									<span class="navi-icon">
										<i class="la la-print"></i>
									</span>
									<span class="navi-text">Print</span>
								</a>
							</li>
							<li class="navi-item">
								<a href="#" class="navi-link">
									<span class="navi-icon">
										<i class="la la-copy"></i>
									</span>
									<span class="navi-text">Copy</span>
								</a>
							</li>
							<li class="navi-item">
								<a href="#" class="navi-link">
									<span class="navi-icon">
										<i class="la la-file-excel-o"></i>
									</span>
									<span class="navi-text">Excel</span>
								</a>
							</li>
							<li class="navi-item">
								<a href="#" class="navi-link">
									<span class="navi-icon">
										<i class="la la-file-text-o"></i>
									</span>
									<span class="navi-text">CSV</span>
								</a>
							</li>
							<li class="navi-item">
								<a href="#" class="navi-link">
									<span class="navi-icon">
										<i class="la la-file-pdf-o"></i>
									</span>
									<span class="navi-text">PDF</span>
								</a>
							</li>
						</ul>
						<!--end::Navigation-->
					</div>
				</div>
                @if($role=='admin')
                    <a href="{{url('items/create')}}" class="btn btn-primary font-weight-bolder">
                        <span class="fas fa-plus-square mr-2"></span>Add Item
                    </a>
                @endif
			</div>
		</div>
		<div class="card-body">
			<div class="datatable datatable-bordered datatable-head-custom" id="items_datatable"></div>
		</div>
	</div>

@endsection

@section('js')
<script>
//-------------------------------------------------------------//
	$(function(){
        //============================================//
	    items_datatable();
        //============================================//
        $(document).on('click', '.delete-item', function(){
            var $this = $(this);
            var name = $this.data('name');
            var id = $this.data('id');
            _confirm('Delete Item ('+name+')', 'Are you sure?', 'warning', 'Yes', 'Cancel', function(){
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: 'post',
                    data:{'_method':'DELETE'},
                    url: '{{url('items')}}/'+id
                }).done(function (res) {
                    if(res.success){
                        window.location.reload();
                    }
                });
            });
        });
        //============================================//
	});
//-------------------------------------------------------------//
function items_datatable(){

    var datatable = $('#items_datatable').KTDatatable({
        // datasource definition
        data: {
            type: 'remote',
            source: {
                read: {
                    url: '{!! route('itemsDatatable.data') !!}',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    map: function(raw) {
                        // sample data mapping
                        var dataSet = raw;
                        if (typeof raw.data !== 'undefined') {
                            dataSet = raw.data;
                        }
                        return dataSet;
                    },
                },
            },
            pageSize: 10,
            serverPaging: true,
            serverFiltering: true,
            serverSorting: true,
        },
        layout: {
            scroll: false,
            footer: false,
        },
        sortable: false,
        pagination: true,

        columns: [{
            field: 'name',
            title: 'Name',
        }, {
            field: 'manufacturer',
            title: 'Manufacturer',
        }, {
            field: 'quantity',
            title: 'quantity',
            width: 150,
            textAlign: 'center',
        }, {
            field: 'expiry_date',
            title: 'Expiry Date',
        }, {
            field: 'units_count',
            title: 'Units',
            width: 100,
            textAlign: 'center',
        }, {
            field: 'Actions',
            title: 'Actions',
            sortable: false,
            width: 200,
            textAlign: 'center',
            overflow: 'visible',
            autoHide: false,
            template: function(data) {
                return `
                    @if($role=='admin')
                        <a href="{{url('items')}}/`+data.id+`/edit" class="btn btn-sm btn-clean btn-icon mr-2" data-toggle="tooltip" title="Edit Item">
                            <span class="fas fa-edit"></span>
                        </a>
                        <a href="javascript:;" class="btn btn-sm btn-clean btn-icon delete-item" data-id="`+data.id+`" data-name="`+data.name+`" data-toggle="tooltip" title="Delete Item">
                            <span class="fas fa-trash"></span>
                        </a>
                    @endif

                    @if($role=='warehouse_keeper')
                        <a href="{{url('items')}}/`+data.id+`/edit-info" class="btn btn-sm btn-clean btn-icon update-item" data-toggle="tooltip" title="Update item">
                            <span class="fas fa-edit"></span>
                        </a>
                    @endif

                    <a href="{{url('items')}}/`+data.id+`" class="btn btn-sm btn-clean btn-icon mr-2" data-toggle="tooltip" title="View Item">
                        <span class="fas fa-eye"></span>
                    </a>
                `;
            },
        }],
    });

    datatable.on('datatable-on-ajax-done', function(){
        setTimeout(function(){
            $('[data-toggle="tooltip"]').tooltip();
        }, 2000);
    });

	$('#items_datatable_search_role').on('change', function() {
        datatable.search($(this).val().toLowerCase(), 'role');
    });

    $('#items_datatable_search_role').selectpicker();
}
//-------------------------------------------------------------//
</script>
@endsection