<!DOCTYPE html>
<html lang="en">
	<!--begin::Head-->
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
		<title>@yield('title') | Warehouse Management System</title>
		
		@include('layouts.auth._styles')
	
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">

		<!--begin::Main-->
		<div class="d-flex flex-column flex-root">
			@yield('content')
		</div>
		<!--end::Main-->

		@include('layouts.auth._scripts')

	</body>
	<!--end::Body-->
</html>