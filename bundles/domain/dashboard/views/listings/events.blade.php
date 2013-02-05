@include('dashboard::listings.events.title')
				
<div class="row station">
	<div class="span12">
		<div class="row events-list">
			<div class="span12">
				
				@foreach($events as $event)
					{{ render('dashboard::listings.events.list-item', ['event' => $event])}}
				@endforeach				
				
				<div class="row list-item">
					<div class="span12">
						{{ $prev_link }}
						{{ $next_link }}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
$(function (){
  $('.artist-detail .more').hover(
    function (){
      $(this).children('ul').stop().fadeIn(150);
    },
    function(){
      $(this).children('ul').stop().fadeOut(150);
    }
  );
});

$(function (){
  $('.artist-name, .agent-name').hover(
    function (){
      $(this).children(':eq(1)').stop().fadeIn(150);
    },
    function(){
      $(this).children(':eq(1)').stop().fadeOut(50);
    }
  );
})
</script>