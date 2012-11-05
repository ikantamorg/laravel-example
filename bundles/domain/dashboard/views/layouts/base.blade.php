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
	</head>

	
	<body>
		
		<div id="banner">
			<div class="container">
				<div class="row">
					<div class="span22 offset1">
						<?=Dashboard::widget('header')?>
					</div>
				</div>	
			</div>	
		</div>

		<div id="matter">	
			<div class="container">
				<div class="row">
					<div class="span23 offset1">
						<div class="row" id="content">
							<div class="span23">
								<div class="row">
									<div class="span4">
										<?=Dashboard::widget('left_pane')?>
									</div>

									{{-- The main content BS --}}
					
									@yield('content')

									{{-- Hack the shit out of it --}}

								</div>
							</div>
						</div>
					</div>
				</div>			
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