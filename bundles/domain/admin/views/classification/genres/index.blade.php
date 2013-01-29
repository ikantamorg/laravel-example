@layout('admin::layout')

@section('title')
Clasification - Genres
@endsection

@section('top-nav')

@endsection


@section('content')

{{ HTML::link($base_url.'new', '+ Add a new Genre') }}

{{ $table->render() }}

@endsection