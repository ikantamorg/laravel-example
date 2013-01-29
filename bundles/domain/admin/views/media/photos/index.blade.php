@layout('admin::layout')

@section('title')
Media - Photos
@endsection

@section('top-nav')

@endsection


@section('content')

<p>Total : {{ $total_records }}</p>
<p>Activated: {{ $activated_records }}</p>

{{ HTML::link($base_url.'new', '+ Add a new Photo') }}

{{ $table->render() }}

@endsection