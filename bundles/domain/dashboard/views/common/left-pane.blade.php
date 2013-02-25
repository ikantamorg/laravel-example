<div class="row left-pane">
	<div class="span4">
		<div class="row title"></div>

		<div class="row artist-tag left-item{{ (@$active_tagable->slug === 'artists') ? ' selected' : '' }}">
			<div class="span4">
				<a 
          class="heading"
          href="{{ URL::to_action('dashboard::artists.listing') }}"
          data-driver="pageChanger"
        >
          ARTISTS
        </a>
				@if($selected_tags and @$active_tagable->slug === 'artists')
					<a
            class="clear" 
            href="{{ URL::to_action('dashboard::artists.listing') }}"
            data-driver="pageChanger"
          >
            clear x
          </a>
				@endif

				@if(@$active_tagable->slug === 'artists')						
					<div class="tag-list">
						<ul class="unstyled">
							@foreach($displayed_tags as $t)
								<li>
									<a
                    href="<?=URL::to('dashboard/artists/listing').'?'.$qs($t->slug)?>"
                    data-driver="pageChanger"
                  >
										{{ $t->name }}
									</a>
								</li>
							@endforeach							
						</ul>
					</div>
				@endif
			</div>	
		</div>
		<div class="row event-tag left-item{{ (@$active_tagable->slug === 'events') ? ' selected' : '' }}">
			<div class="span4">
				<a class="heading"
          href="{{ URL::to_action('dashboard::events.listing') }}"
          data-driver="pageChanger"
        >
          EVENTS
        </a>
				@if($selected_tags and @$active_tagable->slug === 'events')
					<a 
            class="clear" 
            href="{{ URL::to_action('dashboard::events.listing') }}"
            data-driver="pageChanger"
          >
              clear x
          </a>
				@endif

				@if(@$active_tagable->slug === 'events')
					<div class="tag-list">
						<ul class="unstyled">
							@foreach($displayed_tags as $t)
								<li>
									<a
                    href="<?=URL::to('dashboard/events/listing').'?'
													. (in_array('timespan', $params) ? $qs($t->slug) : $qs($t->slug, 'timespan')) ?>"
                    data-driver="pageChanger"
									>
										{{ $t->name }}
									</a>
								</li>
							@endforeach							
						</ul>
					</div>
				@endif
			</div>	
		</div>

		<div class="row song-tag left-item{{ (@$active_tagable->slug === 'songs') ? ' selected' : '' }}">
			<div class="span4">
				<a
          class="heading"
          href="{{ URL::to_action('dashboard::songs.listing') }}"
          data-driver="pageChanger"
        >
          SONGS
        </a>
				@if($selected_tags and @$active_tagable->slug === 'songs')
					<a
            class="clear" 
            href="{{ URL::to_action('dashboard::songs.listing') }}"
            data-driver="pageChanger"
          >
            clear x
          </a>
				@endif

				@if(@$active_tagable->slug === 'songs')
					<div class="tag-list">
						<ul class="unstyled">
							@foreach($displayed_tags as $t)
								<li>
									<a 
                    href="<?=URL::to('dashboard/songs/listing').'?'.$qs($t->slug)?>"
                    data-driver="pageChanger"
                  >
										{{ $t->name }}
									</a>
								</li>
							@endforeach							
						</ul>
					</div>
				@endif
			</div>	
		</div>
		
		<div class="row video-tag left-item{{ (@$active_tagable->slug === 'videos') ? ' selected' : '' }}">
			<div class="span4">
				<a 
          class="heading" 
          href="{{ URL::to_action('dashboard::videos.listing') }}"
          data-driver="pageChanger"
        >
          VIDEOS
        </a>
				@if($selected_tags and @$active_tagable->slug === 'videos')
					<a 
            class="clear" 
            href="{{ URL::to_action('dashboard::videos.listing') }}"
            data-driver="pageChanger"
          >
            clear x
          </a>
				@endif

				@if(@$active_tagable->slug === 'videos')
					<div class="tag-list">
						<ul class="unstyled">
							@foreach($displayed_tags as $t)
								<li>
									<a 
                    href="<?=URL::to('dashboard/videos/listing').'?'.$qs($t->slug)?>"
                    data-driver="pageChanger"
                  >
										{{ $t->name }}
									</a>
								</li>
							@endforeach
						</ul>
					</div>
				@endif
			</div>	
		</div>

		<?=Dashboard::widget('favorites_menu', [$uri, $user, $params])?>
	</div>
</div>

<script>
$(function () {

  var $el = $('#content .left-pane .left-item.selected');

  $el.height($el.find('.tag-list').height() + 30);

  /*
  $('#content .left-pane .heading').click(function () {
    var $el = $(this).parent().parent();

    if($el.hasClass('selected'))
      return false;
    
    var height = $el.find('.tag-list').height() + 30 ;

    $el.siblings('.selected')
        .removeClass('selected')
        .find('.tag-list').animate({'opacity': 0}).end()
        .animate(
          {'height': '30px'}
        );

    $el.addClass('selected')
        .find('.tag-list').animate({'opacity': 1}).end()
        .animate({'height': height+10});
              
  });
  */
});

$(function () {
  $('#content .left-pane .favorite-tag .fav').click(function () {
    var $el = $(this);

    if($el.hasClass('selected'))
      $el.removeClass('selected')
    else
      $el.siblings('.selected').removeClass('selected').end().addClass('selected')
  });
});
</script>