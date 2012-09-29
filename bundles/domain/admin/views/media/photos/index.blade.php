@layout('admin::layout')

@section('title')
Media - Photos
@endsection

@section('top-nav')

@endsection


@section('content')

{{ HTML::link($base_url.'new', '+ Add a new Photo') }}

{{ $table->render() }}

@endsection