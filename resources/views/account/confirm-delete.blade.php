@extends('layout')

@section('content')
<div class="w3-container w3-light-grey" style="padding:128px 16px">
  <h1 class="w3-center">Delete Account</h1>

  @if (session()->has('message'))
    <p><strong>{{ session()->get('message') }}</strong></p>
  @endif

  <p>* <strong>Kindly input your email to confirm if you want to continue deleting your account</strong></p>

  <form method="POST" action="{{ route('input-email') }}">
    @csrf

    <p>
      <input type="text" name="email" class="w3-input w3-border" id="email" value="{{ old('email') }}" placeholder="Enter your email">
    </p>

    @if ($errors->has('email'))
      <p>{{ $errors->first('email') }}</p>
    @endif

    <button class="w3-button w3-black" type="submit">Submit</button>
  </form>
</div>
@endsection