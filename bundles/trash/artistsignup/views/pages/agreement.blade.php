@layout('artistsignup::layout')

@section('header')
<hr>
<h3>AGREEMENT</h3>
<hr>
@endsection

@section('content')

<div class="row">
	<div class="span8 offset8">
		<hr>
		{{ Form::open('artistsignup/agreement', 'POST') }}
			{{ Form::submit('Agree', ['class' => 'btn btn-large btn-success span8']) }}
		{{ Form::close() }}
		<hr>
	</div>
</div>

<div class="row">
	<div class="span8 offset8">
		<hr>
		{{ Form::open('artistsignup/agreement', 'DELETE') }}
			{{ Form::submit('Disagree', ['class' => 'btn btn-large btn-danger span8']) }}
		{{ Form::close() }}
		<hr>
	</div>
</div>
@endsection