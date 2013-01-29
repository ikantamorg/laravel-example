@layout('artistsignup::layout')

@section('header')
	<div class="big-logo"></div>
@endsection

@section('content')
	{{ HTML::link('connect/session/facebook', '', ['class' => 'fb-button']) }}

	{{ Form::open('artistsignup/auth', 'POST') }}
		{{ Form::text('username', Input::old('username'), ['class' => 'large', 'placeholder' => 'Name']) }}
		{{ Form::password('password', ['class' => 'large', 'placeholder' => 'Password']) }}
		{{ Form::password('retype_password', ['class' => 'large', 'placeholder' => 'Retype Password']) }}
	{{ Form::close() }}
	
@endsection