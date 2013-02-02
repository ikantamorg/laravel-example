@layout('admin::layout')

@section('title')
Industry Members - New Member
@endsection

@section('top-nav')

@endsection


@section('content')

{{ HTML::link(URL::to($base_url), '<< Back') }}
<hr>
{{ $form->render() }}

@endsection