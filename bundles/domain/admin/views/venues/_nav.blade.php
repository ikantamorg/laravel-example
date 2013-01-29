<ul class="nav nav-pills">
	<li<?=admin_nav_attr('venues')?>>
		<a href="<?=URL::to('admin/venues')?>">Venues</a>
	</li>
	<li<?=admin_nav_attr('venue/tags')?>>
		<a href="<?=URL::to('admin/venue/tags')?>">Venue Tags</a>
	</li>
</ul>