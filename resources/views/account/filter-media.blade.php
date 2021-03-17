@extends('layout')

@section('content')
<div class="w3-container" style="padding:128px 16px">
	@if (count($media) > 0)
		<div class="w3-row-padding w3-grayscale" style="margin-top:64px">
			@foreach ($media as $mediaList)
			<div class="w3-col l3 m6 w3-margin-bottom">
				<div class="w3-card">
					<img src="{{ asset('images/assets/' . $mediaList->media_thumbnail) }}" alt="image" style="width:100%">
					<div class="w3-container">
						<h3>{{ $mediaList->media_name }}</h3>
						<p class="w3-opacity">Media Type: {{ $mediaList->typeof_media }}</p>

						@if (strlen($mediaList->media_description) >= 25)
							<p>{{ substr($mediaList->media_description, 0, 25) }} ...</p>
						@else
							<p>{{ $mediaList->media_description }}</p>
						@endif

						<p>
							<a href="/show-media/{{ $mediaList->id }}">
								<button class="w3-button w3-light-grey w3-block">Open</button>
							</a>
						</p>
					</div>
				</div>
			</div>
			@endforeach
		</div>
	@else
		<p class="w3-center">No result found.</p>
	@endif
	
</div>
@endsection