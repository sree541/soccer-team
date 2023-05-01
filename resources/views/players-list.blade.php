@extends('layouts.app')

@section('content')
<div class="site-section" style="margin-bottom: -100px">
    <div class="container">
        <form action="http://localhost:8001/players/search" method="POST">
            @csrf
            <div class="form-group">
                <input class="col-lg-6" placeholder="Search with player name/player id..." type="text" class="form-control @error('term') is-invalid @enderror" id="term" name="term" value="{{ old('term') }}" required>
                @error('term')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </form>
    </div>
</div>
<div class="site-section" style="margin-bottom: -100px">
    <div class="container">
        <form action="http://localhost:8001/players/search" method="POST">
            @csrf
            <div class="form-group">
                <input class="col-lg-6" placeholder="Search with team name/team id..." type="text" class="form-control @error('team') is-invalid @enderror" id="team" name="team" value="{{ old('team') }}" required>
                @error('team')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </form>
    </div>
</div>
<div class="site-section">
    <div class="container">
      <h1>Players</h1>
      <div class="row">
        <div class="col-lg-6">
          
          <div class="widget-next-match">
            <table class="table custom-table">
              <thead>
                <tr>
                  <th></th>
                  <th>Name</th>
                  <th>Team</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($players as $player)
                    <tr>
                        <td>
                            <div class="team-1" style="height: 72px;">
                                <img src="{{$player->player_image_uri}}" alt="Image" style="height: inherit">
                            </div>
                        </td>
                        <td style="vertical-align: middle"><a href="#"><strong class="text-white">{{$player->first_name." ".$player->last_name}}</strong></a></td>
                        <td style="vertical-align: middle"><a href="#"><strong class="text-white">{{$player->team->name}}</strong></a></td>
                    </tr>
                @endforeach
              </tbody>
            </table>
          </div>

        </div>
      </div>
    </div>
</div>

@endsection
