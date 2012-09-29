@layout('admin::layout')

@section('title')
Media - Songs - New
@endsection

@section('top-nav')

@include('admin::media.songs._nav')

@endsection


@section('content')

{{ HTML::link(URL::to($base_url), '<< Back') }}
<hr>
{{ $form->render() }}

<script>

window.baseURL = '{{ URL::base() }}';

	$(function () {

		var vent = _.extend({}, Backbone.Events);

		var $soundcloudUrlInput = $('input[name=soundcloud_url]');
		var $fileInput = $('input[name=audio]');
		var $nameInput = $('input[name=name]');

		var $fetchBtn = $('<button class="btn btn-primary offset1">Fetch</button>');

		var $streamUrlInput = $('<input>', { name: 'stream_url', type: 'hidden' });

		var $providerInput = $('<input>', { name: 'provider', type: 'hidden' });

		$soundcloudUrlInput.after($fetchBtn).after($streamUrlInput).after($providerInput);

		var scUrlToApi = function (str) {
			return '/tracks/' + str.split('/').slice(-1) + '.json';
		};

		$fetchBtn.on('click', function (ev) {
			ev.preventDefault();

			var apiUrl = scUrlToApi($soundcloudUrlInput.val());

			SC.get(apiUrl, function (data) {
				
				if(data.errors)
					vent.trigger('song:soundcloud:failed', data);
				else
					vent.trigger('song:soundcloud:success', data);
			});
		});

		vent.on('song:soundcloud:success', function (songData) {
			$fileInput.remove();
			$nameInput.val(songData.title);
			$streamUrlInput.val(songData.stream_url);
			$providerInput.val('soundcloud');
		})
	});

</script>

@endsection