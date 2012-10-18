@layout('admin::layout')

@section('title')
Event Photos
@endsection

@section('top-nav')

@include('admin::events._nav')

@endsection


@section('content')

{{ HTML::link($base_url.'new', '+ Add a new Event Photo') }}

{{ $table->render() }}

@endsection