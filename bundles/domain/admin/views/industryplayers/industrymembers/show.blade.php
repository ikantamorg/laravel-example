@layout('admin::layout')

@section('title')
Industry Members - Show Member
@endsection

@section('top-nav')

@endsection


@section('content')

{{ HTML::link(URL::to($base_url), '<< Back') }}
<hr>
{{ $table->render() }}

@endsection