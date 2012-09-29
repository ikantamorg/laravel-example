@layout('admin::layout')

@section('title')
Media - Videos
@endsection

@section('top-nav')

@include('admin::media.videos._nav')

@endsection


@section('content')

{{ HTML::link($base_url.'new', '+ Add a new Video') }}

{{ $table->render() }}

@endsection