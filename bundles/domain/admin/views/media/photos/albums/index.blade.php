@layout('admin::layout')

@section('title')
Media - Photo - Albums
@endsection

@section('top-nav')

@endsection


@section('content')

{{ HTML::link($base_url.'new', '+ Add a new Album') }}

{{ $table->render() }}

@endsection