@layout('admin::layout')

@section('title')
Companies
@endsection

@section('top-nav')

@include('admin::companies._nav')

@endsection


@section('content')

{{ HTML::link($base_url.'new', '+ Add a new Company') }}

{{ $table->render() }}

@endsection