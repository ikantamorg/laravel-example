@layout('admin::layout')

@section('title')
Media - Photos - Edit
@endsection

@section('top-nav')

@endsection


@section('content')

{{ HTML::link($base_url, '<< Back') }}

{{ $form->render() }}

@endsection