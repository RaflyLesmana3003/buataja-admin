@extends('layouts.app')

@section('title','list follower')

@section('content')
@foreach ($user as $kreator)
    @if($kreator->cover != "")
    <div class="header d-flex align-items-center" style="min-height: 368px; background-image: url('{{ url('storage/file/pp/'.$kreator->cover) }}'); background-size: cover; background-position: center;"></div>
    @else
    <div class="header  d-flex align-items-center" style="min-height: 368px; background-image: url(../../assets/img/theme/profile-cover2.png); background-size: cover; background-position: center;"></div>
    @endif

    @endforeach
    <div class="container-fluid" style="margin-top: -200px;">
        <div class="row justify-content-center">
        <div class="col-xl-8">
          <!-- Members list group card -->
          <div class="card">
            <!-- Card header -->
            <div class="card-header">
              <!-- Title -->
              <h5 class="h3 mb-0">kreator diikuti</h5>
            </div>
            <!-- Card body -->
            <div class="card-body">
              <!-- List group -->
              <ul class="list-group list-group-flush list my--3">
              @if(count($follow) > 0)
            @foreach ($follow as $follows)
                <li class="list-group-item px-0">
                  <div class="row align-items-center">
                    <div class="col-auto">
                    @if($follows->photo != "")
                        <a href="{{ url($follows->name) }}">
                        <img src="{{ url('storage/file/pp/'.$follows->photo) }}" class="avatar avatar-xs rounded-circle avatar-md">
                        </a> @else
                        <a href="{{ url($follows->name) }}">
                        <img src="../../assets/img/theme/team-1.png" class="avatar avatar-xs rounded-circle avatar-md">
                        </a>
                        @endif
                    </div>
                    <div class="col ml--2">
                      <h4 class="mb-0">
                        <a href="#!">{{$follows->name}}</a>
                      </h4>
                    </div>
                    <div class="col-auto">
                      <button type="button" class="btn btn-sm btn-primary" onclick="unfollow({{ $follows->id }})">berhenti</button>
                    </div>
                  </div>
                </li>
                @endforeach
                @else
            <div class="row justify-item-center mx-1">
            <div class="col-12">
            <img class="thumbnail img-fluid rounded" src="{{ asset('assets/img/empty2.png') }}"  alt="">

            </div>
            <div class="col-12 text-center">
            <p class="text-muted"><span class="h3 text-muted">sorry nih...</span><br>anda belum ngikutin kreator sama sekali</p>

            </div>
            </div>
                @endif
              </ul>
            </div>
            @if(count($follow) > 0)
            <div class="row justify-content-md-center">
            {{ $follow->links() }}
            </div>
            @endif
          </div>
        </div>
        </div>
@endsection
