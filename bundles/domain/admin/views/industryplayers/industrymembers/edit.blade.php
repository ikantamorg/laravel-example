@layout('admin::layout')

@section('title')
Industry Members - Edit Member
@endsection

@section('top-nav')

@endsection


@section('content')

{{ HTML::link(URL::to($base_url), '<< Back') }}
<hr>
{{ $form->render() }}

@endsection