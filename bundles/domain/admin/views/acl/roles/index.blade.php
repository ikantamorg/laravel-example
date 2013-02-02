@layout('admin::layout')

@section('title')
ACL - Roles
@endsection

@section('top-nav')
@endsection


@section('content')

{{ HTML::link($base_url.'new', '+ Add a new Role') }}

{{ $table->render() }}

@endsection