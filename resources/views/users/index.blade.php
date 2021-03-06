@extends('layouts.main.master')

@section('title', 'Users')

@section('content')

    <div class="card card-custom">
    	<div class="card-header flex-wrap border-0 pt-6 pb-0">
			<div class="card-title">
				<h3 class="card-label">User Management</h3>
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
			</div>
		</div>
		<div class="card-body">
			<div class="mb-7">
				<div class="row align-items-center">
					<div class="col-md-4 my-2 my-md-0">
						<div class="d-flex align-items-center">
							<label class="mr-3 mb-0 d-none d-md-block">Role</label>
							<select class="form-control" id="users_datatable_search_role">
								<option value="">All</option>
								<option value="admin">Admin</option>
								<option value="warehouse_keeper">Warehouse Keeper</option>
							</select>
						</div>
					</div>
				</div>
			</div>
			<div class="datatable datatable-bordered datatable-head-custom" id="users_datatable"></div>
		</div>
	</div>

@endsection

@section('js')
<script>
//-------------------------------------------------------------//
	$(function(){
	    users_datatable();
	});
//-------------------------------------------------------------//
function users_datatable(){

    var datatable = $('#users_datatable').KTDatatable({
        // datasource definition
        data: {
            type: 'remote',
            source: {
                read: {
                    url: '{!! route('usersDatatable.data') !!}',
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
        sortable: true,
        pagination: true,

        columns: [{
            field: 'full_name',
            title: 'Full Name',
        }, {
            field: 'role',
            title: 'Role',
            textAlign: 'center',
            template: function(row) {
                var roles = {
                    "admin": {
                        'title': 'Admin',
                        'class': ' label-light-primary'
                    },
                    "warehouse_keeper": {
                        'title': 'Warehouse Keeper',
                        'class': ' label-light-success'
                    }
                };
                return '<span class="label font-weight-bold label-lg ' + roles[row.role].class + ' label-inline">' + roles[row.role].title + '</span>';
            },
        }, {
            field: 'email',
            title: 'Email Address',
        }, {
            field: 'phone',
            title: 'Phone',
        }, {
            field: 'Actions',
            title: 'Actions',
            sortable: false,
            width: 125,
            overflow: 'visible',
            autoHide: false,
            template: function() {
                return '\
                    <div class="dropdown dropdown-inline">\
                        <a href="javascript:;" class="btn btn-sm btn-clean btn-icon mr-2" data-toggle="dropdown">\
                            <span class="svg-icon svg-icon-md">\
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\
                                        <rect x="0" y="0" width="24" height="24"/>\
                                        <path d="M5,8.6862915 L5,5 L8.6862915,5 L11.5857864,2.10050506 L14.4852814,5 L19,5 L19,9.51471863 L21.4852814,12 L19,14.4852814 L19,19 L14.4852814,19 L11.5857864,21.8994949 L8.6862915,19 L5,19 L5,15.3137085 L1.6862915,12 L5,8.6862915 Z M12,15 C13.6568542,15 15,13.6568542 15,12 C15,10.3431458 13.6568542,9 12,9 C10.3431458,9 9,10.3431458 9,12 C9,13.6568542 10.3431458,15 12,15 Z" fill="#000000"/>\
                                    </g>\
                                </svg>\
                            </span>\
                        </a>\
                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">\
                            <ul class="navi flex-column navi-hover py-2">\
                                <li class="navi-header font-weight-bolder text-uppercase font-size-xs text-primary pb-2">\
                                    Choose an action:\
                                </li>\
                                <li class="navi-item">\
                                    <a href="#" class="navi-link">\
                                        <span class="navi-icon"><i class="la la-print"></i></span>\
                                        <span class="navi-text">Print</span>\
                                    </a>\
                                </li>\
                                <li class="navi-item">\
                                    <a href="#" class="navi-link">\
                                        <span class="navi-icon"><i class="la la-copy"></i></span>\
                                        <span class="navi-text">Copy</span>\
                                    </a>\
                                </li>\
                                <li class="navi-item">\
                                    <a href="#" class="navi-link">\
                                        <span class="navi-icon"><i class="la la-file-excel-o"></i></span>\
                                        <span class="navi-text">Excel</span>\
                                    </a>\
                                </li>\
                                <li class="navi-item">\
                                    <a href="#" class="navi-link">\
                                        <span class="navi-icon"><i class="la la-file-text-o"></i></span>\
                                        <span class="navi-text">CSV</span>\
                                    </a>\
                                </li>\
                                <li class="navi-item">\
                                    <a href="#" class="navi-link">\
                                        <span class="navi-icon"><i class="la la-file-pdf-o"></i></span>\
                                        <span class="navi-text">PDF</span>\
                                    </a>\
                                </li>\
                            </ul>\
                        </div>\
                    </div>\
                    <a href="javascript:;" class="btn btn-sm btn-clean btn-icon mr-2" title="Edit details">\
                        <span class="svg-icon svg-icon-md">\
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\
                                    <rect x="0" y="0" width="24" height="24"/>\
                                    <path d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z" fill="#000000" fill-rule="nonzero"\ transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) "/>\
                                    <rect fill="#000000" opacity="0.3" x="5" y="20" width="15" height="2" rx="1"/>\
                                </g>\
                            </svg>\
                        </span>\
                    </a>\
                    <a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete">\
                        <span class="svg-icon svg-icon-md">\
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\
                                    <rect x="0" y="0" width="24" height="24"/>\
                                    <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero"/>\
                                    <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"/>\
                                </g>\
                            </svg>\
                        </span>\
                    </a>\
                ';
            },
        }],

    });

	$('#users_datatable_search_role').on('change', function() {
        datatable.search($(this).val().toLowerCase(), 'role');
    });

    $('#users_datatable_search_role').selectpicker();
}
//-------------------------------------------------------------//
</script>
@endsection