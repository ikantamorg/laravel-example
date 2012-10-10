@layout('admin::layout')

@section('title')
Classification - Tags
@endsection

@section('top-nav')

@include('admin::classification.tags._nav')

@endsection


@section('content')

<p>Total : {{ $total_records }}</p>
<p>Activated: {{ $activated_records }}</p>

{{ HTML::link($base_url.'new', '+ Add a new Tag') }}

{{ $table->render() }}

@endsection