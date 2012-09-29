@layout('admin::layout')

@section('title')
Media - Songs -Edit
@endsection

@section('top-nav')

@include('admin::media.songs._nav')

@endsection


@section('content')

{{ HTML::link(URL::to($base_url), '<< Back') }}
<hr>
{{ $form->render() }}

@endsection