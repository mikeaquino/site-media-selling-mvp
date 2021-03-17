@extends('layout')

@section('content')
<div class="w3-container w3-light-grey" style="padding:128px 16px">
  <h1 class="w3-center">Login</h1>
  <form method="POST" action="{{ route('login-user') }}">
    @csrf

    <p>
      <input type="text" name="email" class="w3-input w3-border" id="email" value="{{ old('email') }}" placeholder="Email">
    </p>

    @if ($errors->has('email'))
      <p>{{ $errors->first('email') }}</p>
    @endif

    <p>
      <input type="password" name="pass" class="w3-input w3-border" id="pass" value="{{ old('pass') }}" placeholder="Password">
    </p>

    @if ($errors->has('pass'))
      <p>{{ $errors->first('pass') }}</p>
    @endif

    @if (session()->has('warning'))
      <p>{{ session()->get('warning') }}</p>
    @endif

    @if (session()->has('message'))
      <p>{{ session()->get('message') }} <a href="/signup">register now</a></p>
    @endif

    <button class="w3-button w3-black" type="submit">Login</button>
  </form>
</div>
@endsection