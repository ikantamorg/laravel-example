@layout('admin::layout')

@section('title')
Geo - Cities
@endsection

@section('top-nav')

@endsection


@section('content')

<p>Total : {{ $total_records }}</p>
<p>Activated: {{ $activated_records }}</p>

{{ HTML::link($base_url.'new', '+ Add a new City') }}

{{ $table->render() }}

@endsection