@layout('admin::layout')

@section('title')
Clasification - Genres - Add Genre
@endsection

@section('top-nav')

@endsection


@section('content')

{{ HTML::link($base_url, '<< Back') }}

{{ $form->render() }}

@endsection