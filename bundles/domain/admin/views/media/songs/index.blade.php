@layout('admin::layout')

@section('title')
Media - Songs
@endsection

@section('top-nav')

@include('admin::media.songs._nav')

@endsection


@section('content')

{{ HTML::link(URL::to($base_url.'new'), 'Add a new Song') }}
<hr>
{{ $table->render() }}

@endsection