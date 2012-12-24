@layout('admin::layout')

@section('title')
Venues
@endsection

@section('top-nav')

@include('admin::venues._nav')

@endsection


@section('content')

<p>Total : {{ $total_records }}</p>
<p>Activated: {{ $activated_records }}</p>

{{ HTML::link($base_url.'new', '+ Add a new Venue') }}

{{ $table->render() }}

@endsection