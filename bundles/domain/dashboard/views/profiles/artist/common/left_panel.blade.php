<div class="tabs">
	<div class="nav-icon info<?=($page === 'info') ? ' active' : ''?>">
		<a href="{{ URL::to('dashboard/artists/profile/'.$artist->slug.'/info') }}" data-driver="pageChanger"></a>
	</div>	
	<div class="nav-icon songs<?=($page === 'songs') ? ' active' : ''?>">
		<a href="{{ URL::to('dashboard/artists/profile/'.$artist->slug.'/songs') }}" data-driver="pageChanger"></a>
	</div>	
	<div class="nav-icon events<?=($page === 'events') ? ' active' : ''?>">
		<a href="{{ URL::to('dashboard/artists/profile/'.$artist->slug.'/events') }}" data-driver="pageChanger"></a>
	</div>	
	<div class="nav-icon videos<?=($page === 'videos') ? ' active' : ''?>">
		<a href="{{ URL::to('dashboard/artists/profile/'.$artist->slug.'/videos') }}" data-driver="pageChanger"></a>
	</div>	
	<div class="nav-icon pictures<?=($page === 'pictures') ? ' active' : ''?>">
		<a href="{{ URL::to('dashboard/artists/profile/'.$artist->slug.'/pictures') }}" data-driver="pageChanger"></a>
	</div>	
</div>
{{-- Use active class to make link active --}}