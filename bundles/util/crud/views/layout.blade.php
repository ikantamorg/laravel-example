<!DOCTYPE html>

<html>
	<head>
		<title>Musejam - CRUD</title>

		{{ Asset::container('crud-common')->styles() }}
	</head>
	<body>
		<div class="container">
			<div class="row">
				<div class="span6">
					@include('admin::nav.main')
				</div>
				<div class="span14">
					@yield('sub-nav')
				</div>
			</div>			
			@include('crud::nav')

			@include('crud::flash')

			@yield('content')

			{{ Asset::container('crud-common')->scripts() }}
		</div>
	</body>
</html>