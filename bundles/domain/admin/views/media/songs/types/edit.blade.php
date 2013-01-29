@layout('admin::layout')

@section('title')
Songs - Types - Edit Song Type
@endsection

@section('top-nav')

@include('admin::media.songs._nav')

@endsection


@section('content')

{{ HTML::link(URL::to($base_url), '<< Back') }}
<hr>
{{ $form->render() }}

@endsection