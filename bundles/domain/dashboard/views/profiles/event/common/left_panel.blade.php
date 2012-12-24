<div class="tabs">
	<div class="nav-icon info<?=($page === 'info') ? ' active' : ''?>">
		<a href="{{ URL::to('dashboard/events/profile/'.$event->slug.'/info') }}"></a>
	</div>	
	<div class="nav-icon artists<?=($page === 'artists') ? ' active' : ''?>">
		<a href="{{ URL::to('dashboard/events/profile/'.$event->slug.'/artists') }}"></a>
	</div>
	<div class="nav-icon videos<?=($page === 'videos') ? ' active' : ''?>">
		<a href="{{ URL::to('dashboard/events/profile/'.$event->slug.'/videos') }}"></a>
	</div>
	<div class="nav-icon pictures<?=($page === 'pictures') ? ' active' : ''?>">
		<a href="{{ URL::to('dashboard/events/profile/'.$event->slug.'/pictures') }}"></a>
	</div>
</div> 

{{-- Use active class to make links active --}}