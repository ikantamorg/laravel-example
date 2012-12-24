@layout('admin::layout')

@section('title')
Industry Memberships
@endsection

@section('top-nav')

@include('admin::industryplayers.memberships._nav')

@endsection


@section('content')

{{ HTML::link($base_url.'new', '+ Add a new Membership') }}

{{ $table->render() }}

@endsection