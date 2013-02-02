@layout('admin::layout')

@section('title')
Artist - Recommended
@endsection

@section('top-nav')

@include('admin::artists._nav')

@endsection


@section('content')

{{ HTML::link($base_url.'edit', 'Manage Recommended Artists') }}
<hr>
{{ $table->render() }}

@endsection