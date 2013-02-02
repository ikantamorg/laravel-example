@layout('admin::layout')

@section('title')
Industry Membership Connection - Edit Connection
@endsection

@section('top-nav')

@include('admin::industryplayers.memberships._nav')

@endsection


@section('content')


{{ HTML::link(URL::to($base_url), '<< Back') }}

<h3> 
	{{ $resource->industry_membership->industry_member_profile->name }} ---
	{{ $resource->industry_membership->industry_register_entry->name }}, 
	{{ $resource->membership_tag->name }}
</h3>

<hr>
{{ $form->render() }}

@endsection