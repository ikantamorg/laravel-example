@layout('admin::layout')

@section('title')
Artists - Edit Artist
@endsection

@section('top-nav')

@include('admin::artists._nav')

@endsection


@section('content')

{{ HTML::link($base_url, '<< Back') }}

{{ $form->render() }}

@endsection