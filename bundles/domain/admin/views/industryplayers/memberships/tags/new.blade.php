@layout('admin::layout')

@section('title')
Membership Tags - New Tag
@endsection

@section('top-nav')

@endsection


@section('content')

{{ HTML::link($base_url, '<< Back') }}

{{ $form->render() }}

@endsection