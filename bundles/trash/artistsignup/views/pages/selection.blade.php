@layout('artistsignup::layout')

@section('header')
	<h1 class="selection-msg">SELECT THE ARTIST YOU WANT TO CLAIM</h1>
@endsection

@section('content')
	<div class="row">
		<div class="span8 offset8"
		<div class="form-box">
			{{ Form::open('artistsignup/selection', 'POST') }}
				<hr>
				{{ Form::select('artist_id', $artist_options, Input::old('artist_id'), ['class' => 'chzn span8']) }}
				<hr>
				{{ Form::password('password', ['placeholder' => 'Secret Password', 'class' => 'large span8']) }}
				<hr>
				{{ Form::submit('Submit', ['class' => 'btn btn-large btn-primary span4 offset2']) }}
			{{ Form::close() }}
		</div>
	</div>

	<script>
		$(function () {
			$('.chzn').chosen();
		});
	</script>

@endsection