@layout('admin::layout')

@section('title')
Venues
@endsection

@section('top-nav')

@include('admin::venues._nav')

@endsection


@section('content')

{{ HTML::link($base_url.'new', '+ Add a new Venue') }}

{{ $table->render() }}

@endsection