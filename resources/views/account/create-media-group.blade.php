@extends('layout')

@section('content')
<div class="w3-container w3-light-grey" style="padding:128px 16px">
  <h1 class="w3-center">Create New Media Group</h1>

  @if (session()->has('success'))
    <p><strong>{{ session()->get('success') }}</strong></p>
  @endif

  <form method="POST" action="{{ route('create-mediagroup') }}" enctype="multipart/form-data">
    @csrf

    <p>
      <input type="text" name="groupname" class="w3-input w3-border" id="groupname" value="{{ old('groupname') }}" placeholder="Name of Media Group">
    </p>

    @if ($errors->has('groupname'))
      <p>{{ $errors->first('groupname') }}</p>
    @endif

    <button style="display:block" onclick="document.getElementById('getFile').click()" type="button">
      Upload Image Thumbnail
    </button>
    <p>
      <input type="file" name="image" id="getFile" value="{{ old('image') }}" style="display: none">
    </p>

    @if ($errors->has('image'))
      <p>{{ $errors->first('image') }}</p>
    @endif

    <button class="w3-button w3-black" type="submit">Submit</button>
  </form>
</div>
@endsection