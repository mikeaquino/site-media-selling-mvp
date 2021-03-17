<footer class="w3-center w3-padding-64">
	<div class="w3-container w3-light-grey" style="padding:128px 16px">
		<h3 class="w3-center">Newsletter Signup</h3>
		<form method="POST" action="{{ route('newsletter-signup') }}">
			@csrf

			@if (session()->has('message'))
				<p>{{ session()->get('message') }}</p>
			@endif

			<p>
				<input type="text" name="newsletter_email" class="w3-input w3-border" id="newsletter_email" value="{{ old('newsletter_email') }}" placeholder="Email">
			</p>
			
			@if ($errors->has('newsletter_email'))
				<p>{{ $errors->first('newsletter_email') }}</p>
			@endif

			<button class="w3-button w3-black" type="submit">Submit</button>
		</form>
	</div>
	<p>Powered by Duel Marketing</p>
</footer>