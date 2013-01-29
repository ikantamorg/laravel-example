@layout('admin::layout')

@section('title')
Companies - Add Company
@endsection

@section('top-nav')

@include('admin::companies._nav')

@endsection


@section('content')

{{ HTML::link(URL::to($base_url), '<< Back') }}
<hr>
{{ $form->render() }}

@endsection