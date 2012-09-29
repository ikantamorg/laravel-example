<ul class="nav nav-pills">
	<li<?=admin_nav_attr('artists')?>>
		<a href="{{ URL::to('admin/artists') }}">Artists</a>
	</li>
	<li<?=admin_nav_attr('artist/types')?>>
		<a href="{{ URL::to('admin/artist/types') }}">Artist Types</a>
	</li>
</ul>