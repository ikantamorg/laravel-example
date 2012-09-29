@layout('admin::layout')

@section('title')
Geo - Cities
@endsection

@section('top-nav')

@endsection


@section('content')

{{ HTML::link($base_url.'new', '+ Add a new City') }}

{{ $table->render() }}

@endsection