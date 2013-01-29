@layout('admin::layout')

@section('title')
Videos - Types
@endsection

@section('top-nav')

@include('admin::media.videos._nav')

@endsection


@section('content')

{{ HTML::link($base_url.'new', '+ Add a new video Type') }}

{{ $table->render() }}

@endsection