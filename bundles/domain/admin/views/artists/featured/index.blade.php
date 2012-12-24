@layout('admin::layout')

@section('title')
Artist - Featured
@endsection

@section('top-nav')

@include('admin::artists._nav')

@endsection


@section('content')

{{ HTML::link($base_url.'edit', 'Manage Featured Artists') }}
<hr>
{{ $table->render() }}

@endsection