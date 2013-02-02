@layout('admin::layout')

@section('title')
Geo - Cities - Edit City
@endsection

@section('top-nav')

@endsection


@section('content')

{{ HTML::link(URL::to($base_url), '<< Back') }}
<hr>
{{ $form->render() }}

@endsection