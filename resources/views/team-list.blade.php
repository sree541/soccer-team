@extends('layouts.app')

@section('content')

<div class="site-section">
    <div class="container">
    <h1>Teams</h1>
      <div class="row">
        <div class="col-lg-6">
          
          <div class="widget-next-match">
            <table class="table custom-table">
              <thead>
                <tr>
                  <th></th>
                  <th>Team</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($teams as $team)
                    <tr>
                        <td>
                            <div class="team-1" style="height: 72px;">
                                <img src="{{$team->logo_uri}}" alt="Image" style="height: inherit">
                            </div>
                        </td>
                        <td style="vertical-align: middle">
                            <a href="{{route('teams.players',[$team->id])}}"><strong class="text-white">{{$team->name}}</strong></a>
                        </td>
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

