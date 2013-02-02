@layout('admin::layout')

@section('title')
Events - Recommended
@endsection

@section('top-nav')

@include('admin::events._nav')

@endsection


@section('content')

{{ HTML::link($base_url.'edit', 'Manage Recommended Events') }}
<hr>
{{ $table->render() }}

@endsection