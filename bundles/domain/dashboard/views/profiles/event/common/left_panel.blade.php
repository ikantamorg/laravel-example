<div class="tabs">
	<div class="nav-icon info">
		<a href="{{ URL::to('dashboard/events/profile/'.$event->slug.'/info') }}"></a>
	</div>	
	<div class="nav-icon songs">
		<a href="{{ URL::to('event-profile/songs') }}"></a>
	</div>
	<div class="nav-icon videos">
		<a href="{{ URL::to('event-profile/videos') }}"></a>
	</div>
	<div class="nav-icon pictures">
		<a href="{{ URL::to('event-profile/pictures') }}"></a>
	</div>
</div> 

{{-- Use active class to make links active --}}