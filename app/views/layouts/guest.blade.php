<!DOCTYPE html>
<html>
    <head>
        <title>
            @section('title')
            @show
        </title>
		<meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- CSS are placed here -->
        {{ HTML::style('css/gateway.css') }}

        <style>
        @section('styles')
          
        @show
        </style>
    </head>

    <body>
        <!-- Container -->
        <div class="container">
			@if ( Session::has('error') )
				<div class="alert alert-danger">
					{{ trans(Session::get('reason')) }}
				</div>
			@elseif ( Session::has('success') )
				<div class="alert alert-success">
					{{ Session::get('success') }}
				</div>
			@elseif ( Session::has('info') )
				<div class="alert alert-info">
					{{ Session::get('info') }}
				</div>
			@endif
            <!-- Content -->
			<div class='row'>
				<div class='col-sm-10 col-sm-offset-1'>
            @yield('content')
				</div>
			</div>
        </div>
		<div id='footer' class='container'>
			<hr/>
			<div class='row'>
				<div class='col-sm-3 col-sm-offset-9 text-right'><em>International Bancard 2013 &copy;</em></div>
			</div>
			
			
		</div>
        <!-- Scripts are placed here -->
        {{ HTML::script('js/jquery-1.10.1.min.js') }}
        {{ HTML::script('js/bootstrap.min.js') }}

    </body>
</html>
