@layout('admin::layout')

@section('title')
Classification - Tag - Tagables
@endsection

@section('top-nav')

@include('admin::classification.tags._nav')

@endsection


@section('content')

{{ $table->render() }}

@endsection