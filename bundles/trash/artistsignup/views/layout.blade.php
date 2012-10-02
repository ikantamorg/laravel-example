<!DOCTYPE html>

<html>
	<head>
		{{ Asset::styles() }}
		{{ Asset::container('artistsignup')->styles() }}
		{{ Asset::scripts() }}
		{{ Asset::container('artistsignup')->scripts() }}
	</head>
	<body>
		
		<div class="container">
			<div class="row header">
				<div class="span24">
					@yield('header')
				</div>
			</div>

			<div class="row">
				<div class="span24">
					@yield('content')
				</div>
			</div>
		</div>

	</body>
</html>