@extends('layout')

@section('content')
<div class="w3-container" style="padding:128px 16px">
	<div class="w3-center">
		<form method="GET" action="{{ route('search-404') }}">
			<p>
				<input type="text" name="result" class="w3-input w3-border" id="result" placeholder="Enter keywords">
			</p>
			<button class="w3-button w3-black" type="submit">Search</button>
		</form>
		<h1>404</h1>
		<h3>The page you are looking for is not available.</h3>
	</div>
</div>
@endsection