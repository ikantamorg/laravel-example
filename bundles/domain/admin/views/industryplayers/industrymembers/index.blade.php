@layout('admin::layout')

@section('title')
Industry Members
@endsection

@section('top-nav')

@endsection


@section('content')

{{ HTML::link($base_url.'new', '+ Add a new Member') }}

{{ $table->render() }}

@endsection