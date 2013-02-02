@layout('admin::layout')

@section('title')
Industry Membership Connections
@endsection

@section('top-nav')

@include('admin::industryplayers.memberships._nav')

@endsection


@section('content')

{{ $table->render() }}

@endsection