@extends('layout')

@section('content')
<div class="w3-container w3-light-grey" style="padding:128px 16px">
    <div class="w3-center">
        <h3>Payment Successful!</h3>

        @if (Session::has('mediafile-id'))
	        <a href="/download/{{ Session::get('mediafile-id') }}">
	        	<button class="w3-button w3-black" type="button">Download Media</button>
	        </a>
        @endif

        <p>
        	<a href="/all-media-groups">Go Back</a>
        </p>
    </div>
</div>
@endsection