@layout('admin::layout')

@section('title')
Media - Videos - New
@endsection

@section('top-nav')

@include('admin::media.videos._nav')

@endsection


@section('content')

{{ HTML::link($base_url, '<< Back') }}

{{ $form->render() }}

<script>
	window.baseURL = '{{ URL::base() }}';

	$(function () {

		var vent = _.extend({}, Backbone.Events);

		var $youtubeUrlInput = $('input[name=youtube_url]'),
			$fetcherBtn = $('<button class="offset1 btn btn-primary fetcher">Fetch</button>'),
			input = {
				$youtubeId: $('input[name=youtube_id]'),
				$duration: $('input[name=duration]'),
				$thumb: $('input[name=thumb]'),
				$name: $('input[name=name]')
			}
		;	
		
		$youtubeUrlInput.after($fetcherBtn);

		$fetcherBtn.on('click', function (ev) {
			ev.preventDefault();

			var youtubeUrl = $youtubeUrlInput.val().trim();

			var targetUrl = window.baseURL + '/admin/media/videos/youtube_data',
				data = {youtube_url: youtubeUrl};

			$.ajax({
				dataType: 'json',
				url: targetUrl,
				type: 'POST',
				data: data,
				success: function (videoData) {
					vent.trigger('video:fetched', videoData);
				},
				error: function (err) {
					console.log(err);
				}
			})
		});

		vent.on('video:fetched', function (videoData) {

			console.log(videoData);
			if($('iframe').length > 0)
				$('iframe').remove();

			var videoFrameParams = { id: 'ytplayer', type: 'text/html', width: 450, height: 300 };
			var streamingUrl = 'http://www.youtube.com/embed/'+videoData.data.id;

			videoFrameParams.src = streamingUrl +'?autoplay=1';

			var $videoFrame = $('<iframe>', videoFrameParams);

			var $thumb = $('<img>', { src: videoData.data.thumbnail.hqDefault, class: 'offset1' });
			
			$fetcherBtn.after($videoFrame);

			input.$youtubeId.val(videoData.data.id);
			input.$duration.val(videoData.data.duration);
			input.$thumb.val(videoData.data.thumbnail.hqDefault);
			input.$name.val(videoData.data.title);
		})
	});

</script>

@endsection