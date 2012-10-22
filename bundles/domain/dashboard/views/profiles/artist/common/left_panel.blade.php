<div class="tabs">
	<div class="nav-icon info">
		<a href="{{ URL::to('dashboard/artists/profile/'.$artist->slug.'/info') }}"></a>
	</div>	
	<div class="nav-icon songs">
		<a href="{{ URL::to('dashboard/artists/profile/'.$artist->slug.'/songs') }}"></a>
	</div>	
	<div class="nav-icon events">
		<a href="{{ URL::to('dashboard/artists/profile/'.$artist->slug.'/events') }}"></a>
	</div>	
	<div class="nav-icon videos">
		<a href="{{ URL::to('dashboard/artists/profile/'.$artist->slug.'/videos') }}"></a>
	</div>	
	<div class="nav-icon pictures">
		<a href="{{ URL::to('dashboard/artists/profile/'.$artist->slug.'/pictures') }}"></a>
	</div>	
</div>
{{-- Use active class to make link active --}}