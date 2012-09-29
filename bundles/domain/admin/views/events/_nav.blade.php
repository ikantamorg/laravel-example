<ul class="nav nav-pills">
	<li<?=admin_nav_attr('events')?>>
		<a href="{{ URL::to('admin/events') }}">Events</a>
	</li>
	<li<?=admin_nav_attr('event/types')?>>
		<a href="{{ URL::to('admin/event/types') }}">Event Types</a>
	</li>
</ul>