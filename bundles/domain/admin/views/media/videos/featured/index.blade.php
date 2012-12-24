@layout('admin::layout')

@section('title')
Media - Featured Videos
@endsection

@section('top-nav')

@include('admin::media.videos._nav')

@endsection


@section('content')

{{ HTML::link($base_url.'edit', 'Manage Featured Videos') }}
<hr>
{{ $table->render() }}

@endsection