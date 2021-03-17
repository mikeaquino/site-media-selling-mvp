@extends('layout')

@section('content')
<div class="w3-container" style="padding:128px 16px">
	<div class="w3-center">
		<h1>{{ $media->media_name }}</h1>
		<h4>{{ $media->media_description }}</h4>
		<h4>Price: $4.99</h4>
		<img src="{{ asset('images/assets/' . $media->media) }}" alt="image" style="width:50%">
		<p>
			<a href="/checkout">
				<button class="w3-button w3-black" type="button">One Time Payment</button>
			</a>
		</p>
	</div>
</div>
@endsection