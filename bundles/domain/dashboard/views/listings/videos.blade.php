@include('dashboard::listings.videos.title')
				
<div class="row station">
	<div class="span12">
		<div class="row videos-list">
			<div class="span12">
				
				@foreach($videos as $video)
					{{ render('dashboard::listings.videos.list-item', ['video' => $video]) }}
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