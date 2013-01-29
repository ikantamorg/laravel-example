@layout('admin::layout')

@section('title')
Acl - Roles - Add Role
@endsection

@section('top-nav')
@endsection


@section('content')

{{ HTML::link(URL::to($base_url), '<< Back') }}
<hr>
{{ $form->render() }}

@endsection