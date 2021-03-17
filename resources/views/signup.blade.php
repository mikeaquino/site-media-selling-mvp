@extends('layout')

@section('content')
<div class="w3-container w3-light-grey" style="padding:128px 16px">
  <h1 class="w3-center">Sign Up</h1>
  <form method="POST" action="{{ route('register-user') }}">
    @csrf
    
    @if (Session::has('remember-email'))
      <p>
        <input type="text" name="email" class="w3-input w3-border" id="email" value="{{ Session::get('remember-email') }}" placeholder="Email">
      </p>
    @else
      <p>
        <input type="text" name="email" class="w3-input w3-border" id="email" value="{{ old('email') }}" placeholder="Email">
      </p>
    @endif

    @if ($errors->has('email'))
      <p>{{ $errors->first('email') }}</p>
    @endif

    @if (Session::has('remember-pass'))
      <p>
        <input type="password" name="pass" class="w3-input w3-border" id="pass" value="{{ Session::get('remember-pass') }}" placeholder="Password">
      </p>
    @else
      <p>
        <input type="password" name="pass" class="w3-input w3-border" id="pass" value="{{ old('pass') }}" placeholder="Password">
      </p>
    @endif

    @if ($errors->has('pass'))
      <p>{{ $errors->first('pass') }}</p>
    @endif

    <p>
      <input type="password" name="cpassword" class="w3-input w3-border" id="cpassword" value="{{ old('cpassword') }}" placeholder="Confirm Password">
    </p>

    @if ($errors->has('cpassword'))
      <p>{{ $errors->first('cpassword') }}</p>
    @endif

    @if (session()->has('message'))
      <p>{{ session()->get('message') }}</p>
    @endif

    <button class="w3-button w3-black" type="submit">Register</button>
  </form>
</div>
@endsection