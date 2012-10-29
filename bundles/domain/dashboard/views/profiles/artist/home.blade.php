<div class="span17">
	{{-- title --}}
	{{ render('dashboard::profiles.artist.common.title', ['artist' => $artist]) }}
	{{-- ***** --}}
	
	<div class="row station">
		<div class="span17">
			<div class="row artist-profile">
				<div class="span17">

					{{-- left_panel --}}
					{{ render('dashboard::profiles.artist.common.left_panel', ['artist' => $artist, 'page' => null]) }}
					{{-- ********** --}}

					<div class="row artist-hero">
						{{ render('dashboard::profiles.artist.home.hero', ['artist' => $artist]) }}
					</div>

					<div class="row info-preview">
						{{ render('dashboard::profiles.artist.home.info', ['artist' => $artist]) }}
					</div>

					<div class="row divider">
					</div>

					<div class="row media-preview">
						{{ render('dashboard::profiles.artist.home.media', ['artist' => $artist]) }}
					</div>

					<div class="row picture-preview">
						{{ render('dashboard::profiles.artist.home.pictures', ['artist' => $artist]) }}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

{{-- Right Panel --}}
{{ render('dashboard::profiles.artist.common.right_panel', ['artist' => $artist]) }}
{{-- *********** --}}