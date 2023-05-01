@extends('layouts.app')

@section('content')

<div class="site-section">
    <div class="container">
     @if(!isset($team->name))
     <h1>No Team Found!</h1>
     @else
     <h1>Players of {{$team->name}}</h1>
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
                @foreach ($team->players as $player)
                    <tr>
                        <td>
                            <div class="team-1" style="height: 72px;">
                                <img src="{{$player->player_image_uri}}" alt="Image" style="height: inherit">
                            </div>
                        </td>
                        <td style="vertical-align: middle"><a href="#"><strong class="text-white">{{$player->first_name." ".$player->last_name}}</strong></a></td>
                        <td style="vertical-align: middle"><a href="#"><strong class="text-white">{{$team->name}}</strong></a></td>
                    </tr>
                @endforeach
              </tbody>
            </table>
          </div>

        </div>
      </div>
      @endif
    </div>
</div>

@endsection
