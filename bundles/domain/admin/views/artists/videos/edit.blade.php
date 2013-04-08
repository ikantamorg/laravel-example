<div class="video-thumb">
    <div class="video-image">
        <img src="{{ $video->thumb }}" alt="{{ e($video->name) }}"/>
    </div>
    <div class="shadow"></div>
    <div class="video-controls">
        <div class="left">
            <a href="{{ URL::to_action('admin/media/videos@edit') }}/{{$video->id}}" target="_blank" class="btn btn-info"><i class="icon-edit icon-white"></i> Edit</a>
        </div>
        <div class="right"></div>
        <div class="clear"></div>
    </div>
    <a class="video-play-btn" href="{{ URL::to_action('admin/media/videos@show') }}/{{$video->id}}" target="_blank"></a>

    <div class="video-detail">
        <div class="video-name">{{ e($video->name) }}</div>
        @if(count($video->artists) > 1)
        <div class="artist-detail">
            <div class="more pull-right">
                <a>{{ count($video->artists) }} artists</a>
                <ul class="unstyled">
                    {{ HTML::image('img/arrow.png', 'arrow', [ 'class' => 'arrow'])}}
                    @foreach($video->artists as $a)
                    <li>
                        <img src="{{ $a->get_profile_photo_url('icon') }}"
                             alt="{{ $a->name }}"/>
                        <a href="#">
                            {{ e($a->name) }}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif
    </div>
</div>
