@layout('admin::layout')

@section('title')
Industry Membership Connection - Edit Connection
@endsection

@section('top-nav')

@include('admin::industryplayers.memberships._nav')

@endsection


@section('content')

{{ HTML::link(URL::to($base_url), '<< Back') }}
<hr>
{{ $form->render() }}

@endsection