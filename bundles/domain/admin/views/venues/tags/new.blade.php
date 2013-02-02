@layout('admin::layout')

@section('title')
Venues - Tags - New Venue Tag
@endsection

@section('top-nav')

@include('admin::venues._nav')

@endsection


@section('content')

{{ HTML::link(URL::to($base_url), '<< Back') }}
<hr>
{{ $form->render() }}

@endsection