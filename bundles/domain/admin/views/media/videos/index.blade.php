@layout('admin::layout')

@section('title')
Media - Videos
@endsection

@section('top-nav')

@include('admin::media.videos._nav')

@endsection


@section('content')

<p>Total : {{ $total_records }}</p>
<p>Activated: {{ $activated_records }}</p>

{{ HTML::link($base_url.'new', '+ Add a new Video') }}

{{ $table->render() }}

@endsection