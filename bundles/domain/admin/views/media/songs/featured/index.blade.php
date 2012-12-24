@layout('admin::layout')

@section('title')
Media - Featured Songs
@endsection

@section('top-nav')

@include('admin::media.songs._nav')

@endsection


@section('content')

{{ HTML::link($base_url.'edit', 'Manage Featured Songs') }}
<hr>
{{ $table->render() }}

@endsection