
<div class="well" id="main-nav">
	<h3>Admin Panel Menu</h3>
	<hr/>

	<ul class="nav nav-list">
		<li<?=admin_nav_attr('dashboard')?>><a href="{{ URL::to('admin/dashboard') }}"><i class="icon-home"></i>DASHBOARD</a></li>
		<li<?=admin_nav_attr('account')?>>
			<a href="{{ URL::to('admin/account') }}"><i class="icon-user"></i>ACCOUNT MANAGER</a>
		</li>
		<li>_____________</li>
		<li<?=admin_nav_attr('event')?>><a href="{{ URL::to('admin/events') }}"><i class="icon-calendar"></i>EVENTS</a></li>
		<li<?=admin_nav_attr('artist')?>><a href="{{ URL::to('admin/artists') }}"><i class="icon-headphones"></i>ARTISTS</a></li>
		<li<?=admin_nav_attr('venue')?>><a href="{{ URL::to('admin/venues') }}"><i class="icon-glass"></i>VENUES</a></li>
		<li<?=admin_nav_attr('compan')?>><a href="{{ URL::to('admin/companies') }}"><i class="icon-home"></i>COMPANIES</a></li>
			
		<li<?=admin_nav_header_attr('media')?>>MEDIA</li>
		<ul class="nav nav-list">
			<li<?=admin_nav_attr('media/song')?>>
				<a href="{{ URL::to('admin/media/songs') }}"><i class="icon-music"></i>SONGS</a>
			</li>
			<li<?=admin_nav_attr('media/videos')?>>
				<a href="{{ URL::to('admin/media/videos') }}"><i class="icon-film"></i>VIDEOS</a>
			</li>
			<li<?=admin_nav_attr('media/photos')?>>
				<a href="{{ URL::to('admin/media/photos') }}"><i class="icon-camera"></i>PHOTOS</a>
			</li>
			<li<?=admin_nav_attr('media/photo/albums')?>>
				<a href="{{ URL::to('admin/media/photo/albums') }}"><i class="icon-book"></i>PHOTO-ALBUMS</a>
			</li>
		</ul>

		<li<?=admin_nav_header_attr('geo')?>>GEO</li>
		<ul class="nav nav-list">
			<li<?=admin_nav_attr('geo/cities')?>>
				<a href="{{ URL::to('admin/geo/cities') }}"><i class="icon-picture"></i>CITIES</a>
			</li>
			<li<?=admin_nav_attr('geo/countries')?>>
				<a href="{{ URL::to('admin/geo/countries') }}"><i class="icon-globe"></i>COUNTRIES</a>
			</li>
		</ul>

		<li<?=admin_nav_header_attr('acl')?>>USER MANAGEMENT</li>
		<ul class="nav nav-list">
			<li<?=admin_nav_attr('acl/users')?>>
				<a href="{{ URL::to('admin/acl/users') }}"><i class="icon-user"></i>USERS</a>
			</li>
			<li<?=admin_nav_attr('acl/roles')?>>
				<a href="{{ URL::to('admin/acl/roles') }}"><i class="icon-certificate"></i>ROLES &amp; ABILITIES</a>
			</li>
		</ul>

		<li<?=admin_nav_header_attr('classification')?>>CLASSIFICATION</li>
		<ul class="nav nav-list">
			<li<?=admin_nav_attr('classification/tag')?>>
				<a href="{{ URL::to('admin/classification/tags') }}"><i class="icon-tags"></i>TAGS &amp; TAGABLES</a>
			</li>
			<li<?=admin_nav_attr('classification/map')?>>
				<a href="{{ URL::to('admin/classification/maps') }}"><i class="icon-random"></i>TAG MAPS</a>
			</li>
			<li<?=admin_nav_attr('classification/genres')?>>
				<a href="{{ URL::to('admin/classification/genres') }}"><i class="icon-tag"></i>GENRES</a>
			</li>
		</ul>

		<li<?=admin_nav_header_attr('industryplayers')?>>INDUSTRY-PLAYERS REGISTER</li>
		<ul class="nav nav-list">
			<li<?=admin_nav_attr('industryplayers/membership/tags')?>>
				<a href="{{ URL::to('admin/industryplayers/membership/tags') }}"><i class="icon-tags"></i>MEMBERSHIP TAGS</a>
			</li>
			<li<?=admin_nav_attr('industryplayers/register')?>>
				<a href="{{ URL::to('admin/industryplayers/register') }}"><i class="icon-list-alt"></i>THE REGISTER</a>
			</li>
			<li<?=admin_nav_attr('industryplayers/industrymembers')?>>
				<a href="{{ URL::to('admin/industryplayers/industrymembers') }}"><i class="icon-user"></i>INDUSTRY MEMBERS</a>
			</li>
			<li<?=admin_nav_attr('industryplayers/memberships')?>>
				<a href="{{ URL::to('admin/industryplayers/memberships') }}"><i class="icon-random"></i>MEMBERSHIPS</a>
			</li>
		</ul>
	</ul>
</div>