@layout('admin::layout')

@section('title')
Media - Recommended Songs
@endsection

@section('top-nav')

@include('admin::media.songs._nav')

@endsection


@section('content')

{{ HTML::link($base_url, '<< Back') }}
<hr>
{{ $form->render() }}

@endsection