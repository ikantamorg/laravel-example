@layout('admin::layout')

@section('title')
Artists - Type - New
@endsection

@section('top-nav')

@include('admin::artists._nav')

@endsection

@section('content')

{{ HTML::link($base_url, '<< Back')}}

{{ $form->render() }}

@endsection