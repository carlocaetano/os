<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<title>OS PRIME - Sistema de Ordem de Serviços WEB</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		{{ HTML::style('assets/css/bootstrap.css') }}
		{{ HTML::script('assets/js/jquery-2.0.3.min.js', array('defer' => 'defer')) }}
		{{ HTML::script('assets/js/bootstrap.min.js', array('defer' => 'defer')) }}
		
		<!-- SmartMenus jQuery plugin -->
		{{ HTML::script('assets/libs/jquery-loader.js', array('defer' => 'defer')) }}
		{{ HTML::script('assets/jquery.smartmenus.js', array('defer' => 'defer')) }}

			<!-- SmartMenus core CSS (required) -->
			{{ HTML::style('assets/css/sm-core-css.css') }}

			<!-- "sm-blue" menu theme (optional, you can use your own CSS, too) -->
			{{ HTML::style('assets/css/sm-blue/sm-blue.css') }}

			<!-- #main-menu config - instance specific stuff not covered in the theme -->
			<style type="text/css">
				#main-menu {
					position:relative;
					z-index:9999;
					width:auto;
				}
				#main-menu ul {
					width:12em; /* fixed width only please - you can use the "subMenusMinWidth"/"subMenusMaxWidth" script options to override this if you like */
				}
			</style>

		@if(Auth::check())
			{{ HTML::style('assets/css/datepicker.css') }}
			{{ HTML::style('assets/css/select2.css') }}
			{{ HTML::style('assets/css/select2-bootstrap.css') }}
			{{ HTML::style('assets/css/admin.css') }}
			{{ HTML::script('assets/js/bootstrap-datepicker.js', array('defer' => 'defer')) }}
			{{ HTML::script('assets/js/bootstrap-datepicker.pt-BR.js', array('defer' => 'defer')) }}
			{{ HTML::script('assets/js/select2.min.js', array('defer' => 'defer')) }}
			{{ HTML::script('assets/js/select2_locale_pt-BR.js', array('defer' => 'defer')) }}
			{{ HTML::script('assets/js/jquery.mask.min.js', array('defer' => 'defer')) }}
			{{ HTML::script('assets/js/main.js', array('defer' => 'defer')) }}
		@else
			{{ HTML::style('assets/css/login.css') }}
		@endif
	</head>
	<body>
		@if(Auth::check())
			<div class="navbar navbar-inverse navbar-fixed-top">
	      		<div class="container">
		        	@include('partials._navigation')
	      		</div>
	    	</div>
    	@endif
    	<div class="container">
    		{{ HTML::flash_message() }}
    		@yield('content')
    	</div>
	</body>
</html>