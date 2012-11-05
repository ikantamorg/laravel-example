<div class="row" id="header">
	<div class="span4" >
		<div id="logo">
		</div>
	</div>

	<div class="span3">
		<div  class="span3 dropdown pull-left" id="city">
			<a class="dropdown-toggle pull-left " data-toggle="dropdown" href="#">DELHI<div class="icon"></div></a>
			<ul class="dropdown-menu">
				<li><a href="#">MUMBAI</a></li>
				<li><a href="#">PUNE</a></li>
			    <li><a href="#">BANGALORE</a></li>
			</ul>
		</div>
	</div>


	@if($role === 'industry-user')
		<div class="span10">
			<div id="power-panel">
				
				<div class="button dropdown first" id="notification">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">NOTIFICATION 
						<span class="notification-number">(4)</span><div class="icon"></div></a>
					<ul class="dropdown-menu">
						<li>
							{{ HTML::image('img/user.jpg', 'user', ['class' => 'pull-right']) }}
							<p>Raghu Dixit of <b>The Raghu Dixit Project</b> like your Song <b>Abey oye</b></p>
							
						</li>
						<li class="divider"></li>

						<li>
							{{ HTML::image('img/user.jpg', 'user', ['class' => 'pull-right']) }}
							<p>Raghu Dixit of <b>The Raghu Dixit Project</b> like your Song <b>Abey oye</b></p>
							
						</li>
						<li class="divider"></li>

						<li>
							{{ HTML::image('img/user.jpg', 'user', ['class' => 'pull-right']) }}
							<p>Raghu Dixit of <b>The Raghu Dixit Project</b> like your Song <b>Abey oye</b></p>
							
						</li>
						<li class="divider"></li>

						<li>
							{{ HTML::image('img/user.jpg', 'user', ['class' => 'pull-right']) }}
							<p>Raghu Dixit of <b>The Raghu Dixit Project</b> like your Song <b>Abey oye</b></p>
							
						</li>
						<li class="divider"></li>

						<li>
							{{ HTML::image('img/user.jpg', 'user', ['class' => 'pull-right']) }}
							<p>Raghu Dixit of <b>The Raghu Dixit Project</b> like your Song <b>Abey oye</b></p>
							
						</li>
						<li class="divider"></li>

						
					</ul>
				</div>
			
				<div  class="button" id="control-panel">
					<a href="#">CONTROL PANEL<div class="icon"></div></a>	
				</div>

				<div  class="button dropdown" id="profile">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">Sahej Bakshi<div class="icon"></div></a>
					<ul class="dropdown-menu">
						<li>
							<a href="{{ URL::to('artist-profile/info') }}">
							{{ HTML::image('img/user.jpg', 'user', ['class' => 'pull-right']) }}Dualist Enquiry
							</a>
						</li>
						<li>
							<a href="{{ URL::to('artist-profile/info') }}">
							{{ HTML::image('img/user.jpg', 'user', ['class' => 'pull-right']) }}Jalebi Cartel
							</a>
						</li>
						<li>
							<a href="{{ URL::to('artist-profile/info') }}">
							{{ HTML::image('img/user.jpg', 'user', ['class' => 'pull-right']) }}Delhi Muse fest
							</a>
						</li>
						<li>
							<a href="{{ URL::to('artist-profile/info') }}">
							{{ HTML::image('img/user.jpg', 'user', ['class' => 'pull-right']) }}Qutab culturat Festival
							</a>
						</li>
						
					</ul>

				</div>	
			</div>
		</div>

	@elseif($role === 'fan')

		<div class="span10">
			<div id="power-panel">
				
				<div class="button dropdown first" id="notification">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">NOTIFICATION 
						<span class="notification-number">4</span><div class="icon"></div></a>
					<ul class="dropdown-menu">
						<li>
							{{ HTML::image('img/user.jpg', 'user', ['class' => 'pull-right']) }}
							<p>Raghu Dixit of <b>The Raghu Dixit Project</b> like your Song <b>Abey oye</b></p>
							
						</li>
						<li class="divider"></li>

						<li>
							{{ HTML::image('img/user.jpg', 'user', ['class' => 'pull-right']) }}
							<p>Raghu Dixit of <b>The Raghu Dixit Project</b> like your Song <b>Abey oye</b></p>
							
						</li>
						<li class="divider"></li>

						<li>
							{{ HTML::image('img/user.jpg', 'user', ['class' => 'pull-right']) }}
							<p>Raghu Dixit of <b>The Raghu Dixit Project</b> like your Song <b>Abey oye</b></p>
							
						</li>
						<li class="divider"></li>

						
					</ul>
				</div>
			
				<div  class="button" id="industry-signup">
					<a href="#">INDUSTRY SIGNUP<div class="icon"></div></a>	
				</div>

				<div  class="button" id="profile">
					<a href="#">{{ $user->username }}</a>
				</div>	
			</div>
		</div>
		

	@elseif($role ==='visitor')

		<div class="span12">
			<div id="power-panel">
							
				<div  class="button first" id="signup">
					<a href="#">SIGNUP<div class="icon"></div></a>	
				</div>

				<div  class="button" id="signin">
					<a href="#">SIGNIN<div class="icon"></div></a>
				</div>	
			</div>
		</div>
		
	@endif

	@if($role ==='fan' or $role ==='industry-user')
		<div class="span1">
			<div id="display-pic">
				{{ HTML::image('img/user.jpg', 'user', ['class' => 'pull-right']) }}
			</div>
		</div>

		<div  class="span1 dropdown" id="settings">
			<a class="dropdown-toggle pull-left " data-toggle="dropdown" href="#"><div class="icon"></div></a>
			<ul class="dropdown-menu">
				<li><a href="{{ URL::to('settings') }}">Settings</a></li>
				     <li class="divider"></li>
				<li><a href="#">Logout</a></li>
			</ul>
		</div>

	@endif	

	<div class="span3">
		<div id="search">
			<input type="text" placeholder="SEARCH">
		</div>
	</div>

</div>