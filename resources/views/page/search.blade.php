@extends('layouts.app')

@section('title','pencarian')

@section('content')

    <div class="header bg-warning pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h6 class="display-2 text-white d-inline-block mb-0">pencarian!🚀</h6>
            </div>
          </div>
          <!-- Card stats -->
          <div class="row">
          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
    <div class="row justify-content-center">
    <div class="card col-auto">
            <!-- Card header -->
            <div class="card-header">
              <!-- Title -->
              <h5 class="h3 mb-0">kreator</h5>
            </div>
            <!-- Card body -->
            <div class="card-body">
              <!-- List group -->
              <ul class="list-group list-group-flush list my--3">
                @if(count($data)>0)
                @foreach ($data as $creator)
                <li class="list-group-item px-0">
                  <div class="row align-items-center">
                    <div class="col-auto">
                      <!-- Avatar -->
                      @if($creator->photo != "")
                        <a href="#">
                        <img src="{{ url('storage/file/pp/'.$creator->photo) }}" class="avatar avatar-md">
                        </a> @else
                        <a href="#">
                        <img src="../../assets/img/theme/team-1.png" class="avatar avatar-md">
                        </a>
                        @endif
                    </div>
                    <div class="col ml--2">
                      <h4 class="mb-0">
                        <a href="#!">{{ $creator->name }}</a>
                      </h4>
                      <small>{{ $creator->kreasi }}</small>
                    </div>
                    <div class="col-auto">
                        <a href="{{ url($creator->name) }}">
                      <button type="button" class="btn btn-sm btn-primary">lihat profil</button>
                      </a>
                    </div>
                  </div>
                </li>
                @endforeach
@else
            <div class="row justify-item-center mx-1">
            <div class="col-12">
            <img class="thumbnail img-fluid rounded" width="100px" src="{{ asset('assets/img/empty6.png') }}"  alt="">

            </div>
            <div class="col-12 text-center">
            <p class="text-muted"><span class="h3 text-muted">kreator tidak ditemukan nih</p>

            </div>
            </div>
                @endif
              </ul>
            </div>
          </div>
        </div>



   @endsection
