@layout('admin::layout')

@section('title')
ACL - Users
@endsection

@section('top-nav')

@endsection


@section('content')

{{ HTML::link($base_url.'new', '+ Add a new User') }}

{{ $table->render() }}

@endsection