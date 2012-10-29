<div class="span17">
	{{-- title --}}
	{{ render('dashboard::profiles.artist.common.title', ['artist' => $artist]) }}
	{{-- ***** --}}
	
	<div class="row station">
		<div class="span17">
			<div class="row artist-profile">
				<div class="span17">

					{{-- left_panel --}}
					{{ render('dashboard::profiles.artist.common.left_panel', ['artist' => $artist, 'page' => $page]) }}

					<div class="row {{ $page }}-main">
						{{ render("dashboard::profiles.artist.pages.{$page}", ['artist' => $artist]) }}
						
						@if(! in_array($page, ['videos', 'pictures']) )
							{{ render('dashboard::profiles.artist.layout.right-col', ['artist' => $artist, 'page' => $page]) }}
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


{{-- Right Panel --}}
{{ render('dashboard::profiles.artist.common.right_panel', ['artist' => $artist]) }}
{{-- *********** --}}