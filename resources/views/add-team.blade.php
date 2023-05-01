@extends('layouts.app')

@section('content')
<div class="site-section">
  <div class="container">
    <div class="row">
      <div class="col-lg-5"></div>
      <div class="col-lg-3">
        <form action="{{ route('teams.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label for="name">Name:</label>
              <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
              @error('name')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="form-group">
              <label for="logo">Logo:</label>
              <input type="file" class="form-control-file @error('logo') is-invalid @enderror" id="logo" name="logo" required>
              @error('logo')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <button type="submit" class="btn btn-primary">Create Team</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
