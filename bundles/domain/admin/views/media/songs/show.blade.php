@layout('admin::layout')

@section('title')
Media - Songs - Show
@endsection

@section('top-nav')

@include('admin::media.songs._nav')

@endsection


@section('content')

{{ HTML::link(URL::to($base_url), '<< Back') }}
<hr>
{{ $table->render() }}

@endsection