<div class="display-pic">
	@if($photo = $artist->cover_photo or $photo = $artist->profile_photo)
		<img src="{{ $photo->url }}" alt="{{ e($artist->name) }}"/>
	@else
		<img src="" alt="{{ e($artist->name) }}"/>
	@endif
</div>
<div class="artist-profile-name">
	<div class="name">{{ e($artist->name) }}</div>
	<div class="genres">
		<?=e(implode('/ ', array_map(function ($g) { return $g->name; }, $artist->classification_tags)))?>
	</div>
</div> 