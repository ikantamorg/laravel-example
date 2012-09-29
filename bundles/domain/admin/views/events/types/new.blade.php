@layout('admin::layout')

@section('title')
Events - Add Event Type
@endsection

@section('top-nav')

@include('admin::events._nav')

@endsection


@section('content')

{{ HTML::link(URL::to($base_url), '<< Back') }}
<hr>
{{ $form->render() }}

@endsection