@extends('layout')

@section('content')
<div class="w3-container w3-light-grey" style="padding:128px 16px">
  <h1 class="w3-center">Upload Media</h1>

  @if (session()->has('success'))
    <p><strong>{{ session()->get('success') }}</strong></p>
  @endif

  @if (session()->has('warning'))
    <p><strong>{{ session()->get('warning') }}</strong></p>
  @endif

  <form method="POST" action="/upload-media/{{ $groupId }}" enctype="multipart/form-data">
    @csrf

    <p>
      <input type="text" name="media_name" class="w3-input w3-border" id="media_name" value="{{ old('media_name') }}" placeholder="Name of Media">
    </p>

    @if ($errors->has('media_name'))
      <p>{{ $errors->first('media_name') }}</p>
    @endif

    <p>
      <input type="text" name="media_description" class="w3-input w3-border" id="media_description" value="{{ old('media_description') }}" placeholder="Description">
    </p>

    @if ($errors->has('media_description'))
      <p>{{ $errors->first('media_description') }}</p>
    @endif

    <p>
      <select class="w3-select" name="typeof_media">
        <option value="" disabled selected>Choose the type of media</option>
        <option value="image">Image</option>
      </select>
    </p>

    @if ($errors->has('typeof_media'))
      <p>{{ $errors->first('typeof_media') }}</p>
    @endif

    <button style="display:block" onclick="document.getElementById('getMedia').click()" type="button">
      Upload Media
    </button>
    <p>
      <input type="file" name="media" id="getMedia" value="{{ old('media') }}" style="display: none">
    </p>

    @if ($errors->has('media'))
      <p>{{ $errors->first('media') }}</p>
    @endif

    <button style="display:block" onclick="document.getElementById('getImg').click()" type="button">
      Upload Media Thumbnail
    </button>
    <p>
      <input type="file" name="media_thumbnail" id="getImg" value="{{ old('media_thumbnail') }}" style="display: none">
    </p>

    @if ($errors->has('media_thumbnail'))
      <p>{{ $errors->first('media_thumbnail') }}</p>
    @endif

    <button class="w3-button w3-black" type="submit">Submit</button>
  </form>
</div>
@endsection