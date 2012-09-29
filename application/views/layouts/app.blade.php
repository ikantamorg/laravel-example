<!DOCTYPE html>

<html>
	<head>
		<title>@yield('title') | Musejam - Admin</title>

		{{ Asset::container('common')->styles() }}

	</head>
	<body>

		<div class="container">
			
			<div class="row">
				
				<div class="span14 offset6">
					<div class="row">
						<div class="span14">
							@include('partials.flash')
						</div>
					</div>

					<div class="row" id="content">
						<div class="span14">
							@yield('content')
						</div>
					</div>
				</div>
			</div>

		</div>

		{{ Asset::container('admin-common')->scripts() }}
		{{ Asset::container('admin-app')->scripts() }}
	</body>
</html>