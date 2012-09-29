<ul class="nav nav-pills">
	<li<?=admin_nav_attr('media/songs')?>>
		<a href="{{ URL::to('admin/media/songs') }}">Songs</a>
	</li>
	<li<?=admin_nav_attr('media/song/types')?>>
		<a href="{{ URL::to('admin/media/song/types') }}">Types</a>
	</li>
</ul>