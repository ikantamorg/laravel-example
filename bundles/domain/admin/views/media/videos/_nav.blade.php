<ul class="nav nav-pills">
	<li<?=admin_nav_attr('media/videos')?>>
		<a href="{{ URL::to('admin/media/videos') }}">Videos</a>
	</li>
	<li<?=admin_nav_attr('media/video/types')?>>
		<a href="{{ URL::to('admin/media/video/types') }}">Types</a>
	</li>
</ul>