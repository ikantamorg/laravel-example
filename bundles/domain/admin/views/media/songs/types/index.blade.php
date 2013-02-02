@layout('admin::layout')

@section('title')
Songs - Types
@endsection

@section('top-nav')

@include('admin::media.songs._nav')

@endsection


@section('content')

{{ HTML::link($base_url.'new', '+ Add a new Song Type') }}

{{ $table->render() }}

@endsection