@layout('admin::layout')

@section('title')
Venues - Tags
@endsection

@section('top-nav')

@include('admin::venues._nav')

@endsection


@section('content')

{{ HTML::link($base_url.'new', '+ Add a new Venue Tag') }}

{{ $table->render() }}

@endsection