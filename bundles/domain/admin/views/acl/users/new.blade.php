@layout('admin::layout')

@section('title')
Acl - User - Add User
@endsection

@section('top-nav')

@endsection


@section('content')

{{ HTML::link(URL::to($base_url), '<< Back') }}
<hr>
{{ $form->render() }}

@endsection