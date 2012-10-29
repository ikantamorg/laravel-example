@layout('admin::layout')

@section('title')
Artists - Featured
@endsection

@section('top-nav')

@include('admin::artists._nav')

@endsection


@section('content')

{{ HTML::link($base_url, '<< Back') }}
<hr>
{{ $form->render() }}

@endsection