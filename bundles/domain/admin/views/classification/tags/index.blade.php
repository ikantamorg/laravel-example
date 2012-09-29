@layout('admin::layout')

@section('title')
Classification - Tags
@endsection

@section('top-nav')

@include('admin::classification.tags._nav')

@endsection


@section('content')

{{ HTML::link($base_url.'new', '+ Add a new Tag') }}

{{ $table->render() }}

@endsection