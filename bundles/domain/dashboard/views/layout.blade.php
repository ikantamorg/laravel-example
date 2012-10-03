<!DOCTYPE html>

<html>
	<head>
		<title></title>

		
		{{ HTML::style('css/bootstrap.min.css') }}

		<link href='http://fonts.googleapis.com/css?family=Questrial' rel='stylesheet' type='text/css'>
		<link rel="shortcut icon" href="{{ URL::to_asset('img/icon.png') }}" type="image/x-icon" />

		{{ Asset::container('common')->styles() }}
		{{ Asset::container('dashboard')->styles() }}

		{{ Asset::container('common')->scripts() }}

		{{-- HTML::script('js/script.js') --}}
		{{-- HTML::script('js/player.js') --}}
		{{-- HTML::script('js/left-pane.js') --}}

		<script type="text/javascript">
			/*	
			$(function (){
				$('.artist-name, .agent-name').hover(
					function (){
						$(this).children(':eq(1)').stop().fadeIn(150);
					},
					function(){
						$(this).children(':eq(1)').stop().fadeOut(150);
					}
				);
			})

			$(function (){
				$('.artist-detail .more').hover(
					function (){
						$(this).children('ul').stop().fadeIn(150);
					},
					function(){
						$(this).children('ul').stop().fadeOut(150);
					}
				);
			})
			*/
		</script>
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

		

	</body>
</html>