@layout('admin::layout')

@section('title')
Artists - Types
@endsection

@section('top-nav')

@include('admin::artists._nav')

@endsection

@section('content')

{{ HTML::link($base_url.'new', 'Add new Artist Type')}}

{{ $table->render() }}

@endsection