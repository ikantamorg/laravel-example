<ul class="nav nav-pills">
	<li<?=admin_nav_attr('artists')?>>
		<a href="{{ URL::to('admin/artists') }}">Artists</a>
	</li>
	<li<?=admin_nav_attr('artist/types')?>>
		<a href="{{ URL::to('admin/artist/types') }}">Artist Types</a>
	</li>
	<li<?=admin_nav_attr('artist/featured')?>>
		<a href="{{ URL::to('admin/artist/featured') }}">Featured</a>
	</li>
	<li<?=admin_nav_attr('artist/recommended')?>>
		<a href="{{ URL::to('admin/artist/recommended') }}">Recommended</a>
	</li>
</ul>