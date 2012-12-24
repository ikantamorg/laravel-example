@layout('admin::layout')

@section('title')
Classification - Tag - Categories - Edit Category
@endsection

@section('top-nav')

@include('admin::classification.tags._nav')

@endsection


@section('content')

{{ HTML::link(URL::to($base_url), '<< Back') }}
<hr/>
<h3>{{ $resource->name }}</h3>
<hr/>
{{ $form->render() }}

@endsection