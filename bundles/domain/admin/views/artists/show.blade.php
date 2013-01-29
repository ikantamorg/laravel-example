@layout('admin::layout')

@section('title')
Artists - Show
@endsection

@section('top-nav')

@include('admin::artists._nav')

@endsection


@section('content')

{{ HTML::link($base_url, '<< Back') }}

{{ $table->render() }}

@endsection