@layout('admin::layout')

@section('title')
Classification - Tag - Edit Tag
@endsection

@section('top-nav')

@include('admin::classification.tags._nav')

@endsection


@section('content')

{{ HTML::link(URL::to($base_url), '<< Back') }}

{{ $form->render() }}

@endsection