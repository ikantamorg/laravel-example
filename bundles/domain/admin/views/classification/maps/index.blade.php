@layout('admin::layout')

@section('title')
Classification - Tag Maps
@endsection

@section('top-nav')

@include('admin::classification.maps._nav')

@endsection


@section('content')

{{ $table->render() }}

@endsection