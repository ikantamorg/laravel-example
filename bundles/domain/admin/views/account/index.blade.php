@layout('admin::layout')

@section('title')
Account Manager
@endsection

@section('top-nav')

@endsection


@section('content')

{{ $form->render() }}

@endsection