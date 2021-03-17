@extends('layout')

@section('content')
<div class="w3-container" style="padding:128px 16px">
	<form class="w3-container w3-card-4" method="POST" action="{{ route('filter-media') }}">
		@csrf
		<h3>Filter media by:</h3>
		<select class="w3-select" name="filter_media" id="filter_media">
			<option value="" disabled selected>Newest</option>
			<option value="oldest">Oldest</option>
			<option value="lowtohigh">Media Size Low to High</option>
			<option value="hightolow">Media Size High to Low</option>
		</select>
		<p>
			<button class="w3-btn w3-black">Generate</button>
			@auth
			<a href="/upload-media/{{ $groupId }}">
				<button class="w3-button w3-black" type="button">Upload Media</button>
			</a>
			@endauth
		</p>
	</form>

	@php
		$value = 'show';
	@endphp

	{{ Session::put('media-identifier', $value) }}

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

						<p class="w3-opacity">Media FileSize: {{ $mediaList->media_filesize }}</p>
						<p class="w3-opacity">Date Created: {{ $mediaList->created_at->format('F m, Y') }}</p>

						<p>
							<a href="/{{ strtolower(str_replace(' ', '-', $mediaList->media_name)) }}-{{ $mediaList->id }}">
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