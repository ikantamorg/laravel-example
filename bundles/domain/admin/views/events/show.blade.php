@layout('admin::layout')

@section('title')
Event - Show
@endsection

@section('top-nav')

@include('admin::events._nav')

@endsection


@section('content')

{{ HTML::link(URL::to($base_url), '<< Back') }}
<hr>
{{ $table->render() }}

@endsection