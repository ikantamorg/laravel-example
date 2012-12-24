@layout('admin::layout')

@section('title')
Venues - Show
@endsection

@section('top-nav')

@include('admin::venues._nav')

@endsection


@section('content')

{{ HTML::link(URL::to($base_url), '<< Back') }}
<hr>
{{ $table->render() }}

@endsection