@extends('layout')

@section('content')
<div class="w3-container" style="padding:128px 16px">
	<div class="w3-center">
		<a href="/create-media-group">
			<button class="w3-button w3-black" type="button">Create New Media Group</button>
		</a>
	</div>

	@if (count($mediaGroups) > 0)
		<div class="w3-row-padding w3-grayscale" style="margin-top:64px">
			@foreach ($mediaGroups as $mediaGroup)
			<div class="w3-col l3 m6 w3-margin-bottom">
				<div class="w3-card">
					<img src="{{ asset('images/' . $mediaGroup->image_thumbnail) }}" alt="image" style="width:100%">
					<div class="w3-container">
						<h3>{{ $mediaGroup->group_name }}</h3>
						<p class="w3-opacity">Date Created: {{ $mediaGroup->created_at->format('F m, Y') }}</p>
						<p>
							<a href="/all-media/{{ $mediaGroup->group_id }}">
								<button class="w3-button w3-light-grey w3-block">View All Media</button>
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