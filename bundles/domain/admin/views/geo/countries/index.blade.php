@layout('admin::layout')

@section('title')
Geo - Countries
@endsection

@section('top-nav')

@endsection

@section('content')

{{ $table->render() }}

@endsection