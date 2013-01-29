@layout('admin::layout')

@section('title')
Classification - Tag - Types
@endsection

@section('top-nav')

@include('admin::classification.tags._nav')

@endsection


@section('content')

{{ HTML::link($base_url.'new', '+ Add a new Tag Type') }}

{{ $table->render() }}

@endsection