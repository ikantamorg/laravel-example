<!DOCTYPE html>

<html>
	<head>
		<title>@yield('title') | Musejam - Admin</title>

		{{ Asset::container('admin-common')->styles() }}
		{{ Asset::container('admin-common')->scripts() }}

		{{ Asset::container('admin-app')->styles() }}

		</script>
	</head>
	<body>

		@include('admin::sidebar')

		<div class="container">
			
			<div class="row">
				
				<div class="span14 offset6">
					<div class="row">
						<div class="span14">
							<hr>
							<h2>@yield('title')</h2>
							<hr>
						</div>
					</div>

					<div class="row">
						<div class="span14">
							<hr/>
							@yield('top-nav')
							<hr/>
						</div>
					</div>

					<div class="row" id="filter-form">
						<div class="span5">
							<select class="filter"></select>
						</div>
						<div class="span5">
							<input type="text" class="search"/>
						</div>
						<div class="span2">
							<button class="btn btn-primary go-btn">GO</button>
						</div>
						<div class="span2">
							<button class="btn btn-inverse restore-btn">RESTORE</button>
						</div>
					</div>
					

					<div class="row">
						<div class="span14">
							@include('admin::flash')
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



		
		{{ Asset::container('admin-app')->scripts() }}
	</body>
</html>