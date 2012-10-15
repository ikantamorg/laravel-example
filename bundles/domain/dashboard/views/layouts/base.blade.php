<!DOCTYPE html>

<html>
	<head>
		<title>Musejam</title>

		
		{{ HTML::style('css/bootstrap.min.css') }}

		<link href='http://fonts.googleapis.com/css?family=Questrial' rel='stylesheet' type='text/css'>
		<link rel="shortcut icon" href="{{ URL::to_asset('img/icon.png') }}" type="image/x-icon" />

		{{ Asset::container('common')->styles() }}
		{{ Asset::container('dashboard')->styles() }}

		{{ Asset::container('common')->scripts() }}

		{{ Asset::container('dashboard')->scripts() }}

		{{-- HTML::script('js/script.js') --}}
		{{-- HTML::script('js/player.js') --}}
		{{-- HTML::script('js/left-pane.js') --}}
	</head>

	
	<body>
		
		<div id="banner">
			<div class="container">
				<div class="row">
					<div class="span22 offset1">

						{{ render('dashboard::common.header', ['role' => 'visitor']) }}

					</div>
				</div>	
			</div>	
		</div>

		<div id="matter">	
			<div class="container">

				@yield('content')
				
			</div>
		</div>	

		<div id="footer">
			<div class="container">
				<div class="row">
					<div class="span22 offset1">

						@include('dashboard::common.footer')

					</div>
				</div>	
			</div>
		</div>		
		
		<div id="player">
			<div class="container">
				<div class="row">
					<div class="span22 offset1">
						@include('dashboard::common.player')
					</div>
				</div>	
			</div>
		</div>

	@include('dashboard::temp.scripts')

	</body>

	<script type="text/javascript" data-main="{{ URL::to_asset('js/dash/app.config.js') }}" src="{{ URL::to_asset('js/require.js') }}">
	</script>
</html>