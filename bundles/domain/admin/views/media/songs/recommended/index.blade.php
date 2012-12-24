@layout('admin::layout')

@section('title')
Media - Recommended Songs
@endsection

@section('top-nav')

@include('admin::media.songs._nav')

@endsection


@section('content')

{{ HTML::link($base_url.'edit', 'Manage Recommended Songs') }}
<hr>
{{ $table->render() }}

@endsection