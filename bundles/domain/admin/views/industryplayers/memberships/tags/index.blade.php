@layout('admin::layout')

@section('title')
Membership Tags
@endsection

@section('top-nav')

@endsection


@section('content')

{{ HTML::link($base_url.'new', 'Add a new Membership Tag') }}

{{ $table->render() }}

@endsection