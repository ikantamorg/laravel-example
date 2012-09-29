<!DOCTYPE html>

<html>
	<head>
		<title></title>

		
		{{ HTML::style('css/bootstrap.min.css') }}

		<link href='http://fonts.googleapis.com/css?family=Questrial' rel='stylesheet' type='text/css'>
		<link rel="shortcut icon" href="{{ URL::to_asset('img/icon.png') }}" type="image/x-icon" />

		{{ HTML::style('css/fonts.css') }}
		{{ HTML::style('css/style.css') }}
		
		{{ HTML::script('js/jquery.min.js') }}
		{{ HTML::script('js/bootstrap.min.js') }}

	</head>

	
	<body>
		
		<div id="banner">
			<div class="container">
				<div class="row">
					<div class="span22 offset1">

						@include('common.header')

					</div>
				</div>	
			</div>	
		</div>

		<div id="matter">	
			<div class="container">
				<div class="row">
					<div class="span22 offset1">
						@yield('content')
					</div>
				</div>
			</div>
		</div>	

		<div id="footer">
			<div class="container">
				<div class="row">
					<div class="span22 offset1">

						@include('common.footer')

					</div>
				</div>	
			</div>
		</div>		
		
		<div id="player">
			<div class="container">
				<div class="row">
					<div class="span22 offset1">
						@include('common.player')
					</div>
				</div>	
			</div>
						
		</div>

		

	</body>
</html>