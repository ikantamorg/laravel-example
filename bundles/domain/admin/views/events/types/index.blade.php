@layout('admin::layout')

@section('title')
Events
@endsection

@section('top-nav')

@include('admin::events._nav')

@endsection


@section('content')

{{ HTML::link($base_url.'new', '+ Add a new Event') }}

{{ $table->render() }}

@endsection