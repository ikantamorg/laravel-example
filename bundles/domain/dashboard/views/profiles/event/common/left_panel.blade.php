<div class="tabs">
	<div class="nav-icon info">
		<a href="{{ URL::to('dashboard/events/profile/'.$event->slug.'/info') }}"></a>
	</div>	
	<div class="nav-icon songs">
		<a href="{{ URL::to('dashboard/events/profile/'.$event->slug.'/artists') }}"></a>
	</div>
	<div class="nav-icon videos">
		<a href="{{ URL::to('dashboard/events/profile/'.$event->slug.'/videos') }}"></a>
	</div>
	<div class="nav-icon pictures">
		<a href="{{ URL::to('dashboard/events/profile/'.$event->slug.'/pictures') }}"></a>
	</div>
</div> 

{{-- Use active class to make links active --}}