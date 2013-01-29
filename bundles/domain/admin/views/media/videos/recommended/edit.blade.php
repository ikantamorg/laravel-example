@layout('admin::layout')

@section('title')
Media - Recommended Videos
@endsection

@section('top-nav')

@include('admin::media.videos._nav')

@endsection


@section('content')

{{ HTML::link($base_url, '<< Back') }}
<hr>
{{ $form->render() }}

@endsection