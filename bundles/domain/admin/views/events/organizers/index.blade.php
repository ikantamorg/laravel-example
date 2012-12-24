@layout('admin::layout')

@section('title')
Event Organizers for {{ $event->name }}
@endsection

@section('top-nav')

@include('admin::events._nav')

@endsection


@section('content')

{{ HTML::link($base_url.'new', '+ Add a new Event Organizer') }}

{{ $table->render() }}

@endsection