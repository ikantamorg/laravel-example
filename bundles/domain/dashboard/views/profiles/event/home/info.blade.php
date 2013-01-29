<div class="span5">
	<div class="sec">
		<div class="heading">DETAILS</div>

		<div class="event-detail">
			<div class="row date">
				<div class="span4">
					@if($event->start_date === $event->end_date)
						{{ $event->get_start_date('j M, D') }}
					@else
						{{ $event->get_start_date('j M D') }} - {{ $event->get_end_date('j M D') }}
					@endif
				</div>
			</div>
			<div class="row time">
				<div class="span4">
					@if((int) $event->is_timed === 1)
						@if($event->start_time === $event->end_time)
							{{ $event->get_start_time('g:ia') }} onwards
						@else
							{{ $event->get_start_time('g:ia') }} - {{ $event->get_end_time('g:ia') }}
						@endif
					@else
						Timing to be announced
					@endif
				</div>
			</div>
			<div class="row venue">
				<div class="span4">
					@if(count($event->venues) > 0)
						@foreach($event->venues as $i => $v)
							{{ e($v->name) }}, {{ e($v->city->name) }}
							@if(@$event->venues[$i+1])
								|
							@endif
						@endforeach
					@endif
				</div>
			</div>
		</div>

	</div>
</div>

<div class="span5 offset1">
	<div class="sec">
		<div class="heading">CONTACT INFO</div>
		<div class="agent sec">
			
			<div class="personal-detail contact">
				<span>T : </span>{{-- What do I put here --}}
			</div>
			<div class="personal-detail email">
				<span>W : </span>{{-- What do I put here--}}
			</div>
		</div>
		<div class="heading">MANAGEMENT</div>
		<div class="agent sec">
			<div class="agent-name">	
				<a class="name" href="#">
					{{-- What do I put here --}}
				</a>

				<a class="agency" href="#">
					{{-- What do I put here --}}
				</a>
				
			</div>
			<div class="personal-detail contact">
				<span>T : </span>{{-- What do I put here --}}
			</div>
			<div class="prsonal-detail email">
				<span>E : </span>{{-- What do I put here --}}
			</div>
		</div>
	</div>
</div>

<div class="span5 offset1">
	<div class="sec">
		<div class="heading">ABOUT</div>
		<div class="about-preview sec">
			{{ nl2p($event->about) }}
		</div>
		<a class="more">Read more</a>
	</div>
</div>