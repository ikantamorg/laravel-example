@layout('admin::layout')

@section('title')
Events - Featured
@endsection

@section('top-nav')

@include('admin::events._nav')

@endsection


@section('content')

{{ HTML::link($base_url.'edit', 'Manage Featured Events') }}
<hr>
{{ $table->render() }}

@endsection