@extends('layout')

@section('content')
<div class="w3-container w3-light-grey" style="padding:128px 16px">
  <h3 class="w3-center">Profile Settings</h3>

  @if (session()->has('success'))
    <p><strong>{{ session()->get('success') }}</strong></p>
  @endif
  
  <form method="POST" action="{{ route('save-profile') }}">
    @csrf

    @if (!empty($profile))
      @php
        $firstname = $profile->user_firstname;
        $lastname = $profile->user_lastname;
        $description = $profile->user_description;
      @endphp
    @else
      @php
        $firstname = old('fname');
        $lastname = old('lname');
        $description = old('description');
      @endphp
    @endif

    <h4>First Name</h4>
    <p>
      <input type="text" name="fname" class="w3-input w3-border" id="fname" value="{{ $firstname }}">
    </p>

    @if ($errors->has('fname'))
      <p>{{ $errors->first('fname') }}</p>
    @endif

    <h4>Last Name</h4>
    <p>
      <input type="text" name="lname" class="w3-input w3-border" id="lname" value="{{ $lastname }}">
    </p>

    @if ($errors->has('lname'))
      <p>{{ $errors->first('lname') }}</p>
    @endif

    <h4>About Me</h4>
    <p>
      <input type="text" name="description" class="w3-input w3-border" id="description" value="{{ $description }}">
    </p>

    @if ($errors->has('description'))
      <p>{{ $errors->first('description') }}</p>
    @endif

    <p>
      <button class="w3-button w3-black w3-block" type="submit">Save Settings</button>
    </p>
    <p>
      <a href="/account/change-email">
        <button class="w3-button w3-black w3-block" type="button">Change Email</button>
      </a>
    </p>
    <p>
      <a href="/account/delete">
        <button class="w3-button w3-black w3-block" type="button">Delete Account</button>
      </a>
    </p>
  </form>
</div>
@endsection