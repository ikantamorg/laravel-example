@layout('admin::layout')

@section('title')
Videos - Types - New video Type
@endsection

@section('top-nav')

@include('admin::media.videos._nav')

@endsection


@section('content')

{{ HTML::link(URL::to($base_url), '<< Back') }}
<hr>
{{ $form->render() }}

@endsection