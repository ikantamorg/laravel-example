@layout('artistsignup::layout')

@section('header')
	<div class="big-logo"></div>
@endsection

@section('content')
	{{ HTML::link('connect/session/facebook', '', ['class' => 'fb-button']) }}
@endsection