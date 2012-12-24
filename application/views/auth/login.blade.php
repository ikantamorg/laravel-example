@layout('layouts.app')

@section('title')
Login
@endsection

@section('content')

{{ $form->render() }}

@endsection