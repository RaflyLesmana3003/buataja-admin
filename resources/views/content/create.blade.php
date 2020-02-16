@extends('layouts.app')

@section('title','buat karya')

@section('content')
    <div class="header bg-warning pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h6 class="display-2 text-white d-inline-block mb-0">yuk berkarya!🚀</h6>
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
        <div class="col-lg-3 col-md-7">
          <div class="card card-profile  mt-5">
            <div class="row justify-content-center">
              <div class="col-lg-3 order-lg-2">
                <div class="card-profile-image">
                  <img src="../../assets/img/theme/content (5).png" class="rounded-circle border-secondary">
                </div>
              </div>
            </div>
            <div class="card-body pt-7 px-5">
              <div class="text-center mb-4">
                <h3>karya Tulis</h3>
              </div>
                <div class="text-center">
                <a class="btn btn-primary mt-2" href="{{ url('/76ea0bebb3c22822b4f0dd9c9fd021c5/tulis') }}">mulai</a>
                </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-7">
          <div class="card card-profile  mt-5">
            <div class="row justify-content-center">
              <div class="col-lg-3 order-lg-2">
                <div class="card-profile-image">
                  <img src="../../assets/img/theme/content (3).png" class="rounded-circle border-secondary">
                </div>
              </div>
            </div>
            <div class="card-body pt-7 px-5">
              <div class="text-center mb-4">
                <h3>karya gambar atau foto</h3>
              </div>
                <div class="text-center">
                  <a class="btn btn-primary mt-2" href="{{ url('/76ea0bebb3c22822b4f0dd9c9fd021c5/gambar') }}">mulai</a>
                </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-7">
          <div class="card card-profile  mt-5">
            <div class="row justify-content-center">
              <div class="col-lg-3 order-lg-2">
                <div class="card-profile-image">
                  <img src="../../assets/img/theme/content (2).png" class="rounded-circle border-secondary">
                </div>
              </div>
            </div>
            <div class="card-body pt-7 px-5">
              <div class="text-center mb-4">
                <h3>karya video</h3>
              </div>
                <div class="text-center">
                <a class="btn btn-primary mt-2" href="{{ url('/76ea0bebb3c22822b4f0dd9c9fd021c5/video') }}">mulai</a>
                </div>
            </div>
          </div>
        </div>
        <div class="col-lg-5 col-md-7">
          <div class="card card-profile  mt-5">
            <div class="row justify-content-center">
              <div class="col-lg-3 order-lg-2">
                <div class="card-profile-image">
                  <img src="../../assets/img/theme/content (1).png" class="rounded-circle border-secondary">
                </div>
              </div>
            </div>
            <div class="card-body pt-7 px-5">
              <div class="text-center mb-4">
                <h3>karya audio</h3>
              </div>
                <div class="text-center">
                <a class="btn btn-primary mt-2" href="{{ url('/76ea0bebb3c22822b4f0dd9c9fd021c5/musik') }}">mulai</a>
                </div>
            </div>
          </div>
        </div>
        <!-- <div class="col-lg-5 col-md-7">
          <div class="card card-profile  mt-5">
            <div class="row justify-content-center">
              <div class="col-lg-3 order-lg-2">
                <div class="card-profile-image">
                  <img src="../../assets/img/theme/team-1.png" class="rounded-circle border-secondary">
                </div>
              </div>
            </div>
            <div class="card-body pt-7 px-5">
              <div class="text-center mb-4">
                <h3>bagi link</h3>
              </div>
                <div class="text-center">
                <a class="btn btn-primary mt-2" href="{{ url('/create/link') }}">mulai</a>
                </div>
            </div>
          </div>
        </div> -->
        </div>



   @endsection
