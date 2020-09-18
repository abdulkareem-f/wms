<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
		<title>@yield('title') | Warehouse Management System</title>

		@include('layouts.main._styles')

	</head>
	<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">

        @include('layouts.main._header_mobile')

        <div class="d-flex flex-column flex-root">
			<div class="d-flex flex-row flex-column-fluid page">
                @include('layouts.main._sidebar')

                <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">

                    @include('layouts.main._header')

                    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">

                        @include('layouts.main._sub_header')

                        <div class="d-flex flex-column-fluid">

                            <div class="container">

                                @include('layouts.main._flash')

                                @yield('content')

                            </div>

                        </div>

                    </div>

                    @include('layouts.main._footer')
                    
                </div>
            </div>
        </div>
        
        @include('layouts.main._user_menu')

        @include('layouts.main._scroll_top')

        @include('layouts.main._scripts')
    </body>
</html>