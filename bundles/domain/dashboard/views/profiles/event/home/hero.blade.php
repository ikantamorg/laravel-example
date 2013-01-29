<div class="display-pic">
	@if($photo = $event->cover_photo or $photo = $event->profile_photo)
		<img src="{{ $photo->url }}" alt="{{ e($event->name) }}"/>
	@else
		<img src="" alt="{{ e($event->name) }}"/>
	@endif
</div>
<div class="artist-profile-name">
	<div class="name">{{ e($event->name) }}</div>
	<div class="genres">
		<?=e(implode('/ ', array_map(function ($g) { return $g->name; }, $event->classification_tags)))?>
	</div>
</div> 