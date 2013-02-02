<div class="span6 offset1">
	<div class="row display-pic sec">
		<div class="span6">
			<img src="{{ $event->get_profile_photo_url('thumb') }}" alt="{{ e($event->name) }}">
		</div>
	</div>

	<div class="row social-connect sec">
		<div class="span1 share-page facebook"><a></a></div>
		<div class="span1 share-page twitter"><a></a></div>
	</div>

	@if($page === 'info')
		<div class="row sec">
			<div class="span6">
				<div class="heading">CONTACT INFO</div>
				<div class="agent main-content">
					
					<div class="personal-detail contact">
						<span>T : </span>{{-- What to put here --}}
					</div>
					<div class="personal-detail email">
						<span>W : </span>{{-- What to put here --}}
					</div>
				</div>
			</div>
		</div>
		<div class="row sec">
			<div class="span6">
				<div class="heading">BOOKING</div>
				<div class="agent main-content">
					<div class="agent-name">	
						<a class="name" href="#">
							{{-- What to put here --}}
						</a>

						<a class="agency" href="#">
							{{-- What to put here --}}
						</a>
						
					</div>
					<div class="personal-detail contact">
						<span>T : </span>{{-- What to put here --}}
					</div>
					<div class="personal-detail email">
						<span>E : </span>{{--What to put here --}}
					</div>
				</div>
			</div>
		</div>
	@endif
</div>