@layout('admin::layout')

@section('title')
Companies - Tags
@endsection

@section('top-nav')

@include('admin::companies._nav')

@endsection


@section('content')

{{ HTML::link($base_url.'new', '+ Add a new Tag') }}

{{ $table->render() }}

@endsection