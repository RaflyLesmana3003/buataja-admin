@extends('layouts.app')

@section('title','gabung jadi kreator')

@section('content')
    <div class="header bg-gradient-warning pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
          <div class="col-lg-12 col-12">
              <h6 class="display-2 text-white d-inline-block mb-0">Gabung jadi kreator (4/5)🚀</h6>
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
      <div class="row">
        <div class="col">
          <div class="card-wrapper">

            <!-- Verify accounts to expedite your page approval. -->
            <div class="card col-xl-5 center " id='form4'>
              <!-- Card header -->
              <div class="card-header">
              <div class="row align-items-center">
                <div class="col-6">
                  <!-- Title -->
                  <h5 class="h3 mb-0">koneksikan channel buataja dengan sosial media</h5>
                </div>
                <div class="col-6 text-right">
                </div>
              </div>
            </div>
              <!-- Card body -->
              <div class="card-body">
                <ul class="list-group list-group-flush list my--3">
                  <li class="list-group-item px-0">
                    <div class="row align-items-center">
                      <div class="col-auto">
                        <!-- Avatar -->
                        <a href="#" >
                          <img  class="avatar" alt="Image placeholder" src="../../assets/img/facebook.png">
                        </a>
                      </div>
                      <div class="col ml--2">
                        <h4 class="mb-0">
                          <a href="#!">Facebook</a>
                        </h4>
                        @if(count($data) > 0)
                       @foreach ($data as $users)
                       @if($users->idfacebook  == null)

                       <span class="text-danger">●</span>
                        <small>unconnected</small>
                      @else
                      <span class="text-success">●</span>
                        <small>connected</small>

                        @endif

                        @endforeach

                        @else
                        <span class="text-success">●</span>
                        <small>connected</small>
                         @endif

                      </div>

                      <div class="col-auto">

                       @if(count($data) > 0)
                       @foreach ($data as $users)
                       @if($users->idfacebook  == null)

                        <a href="{{ url('/connect/facebook') }}" class="btn btn-sm btn-outline-warning">connect</a>
                      @else
                        <a href="{{ url('/disconnect/facebook') }}" class="btn btn-sm btn-warning">disconnect</a>

                        @endif

                        @endforeach

                        @else
                         <a href="{{ url('/connect/facebook') }}" class="btn btn-sm btn-outline-warning">connect</a>
                         @endif
                      </div>
                    </div>
                  </li>
                  <!-- <li class="list-group-item px-0">
                    <div class="row align-items-center">
                      <div class="col-auto">
                        Avatar
                        <a href="#" class="avatar">
                          <img alt="Image placeholder" src="../../assets/img/instagram.png">
                        </a>
                      </div>
                      <div class="col ml--2">
                        <h4 class="mb-0">
                          <a href="#!">instagram</a>
                        </h4>
                        <span class="text-warning">●</span>
                        <small>unconnected</small>
                      </div>
                      <div class="col-auto">
                        <button type="button" class="btn btn-sm btn-outline-warning">connected</button>
                      </div>
                    </div>
                  </li> -->
                </ul>
                  <div class="align-right mt-5">
                  <button class="btn btn-warning" id="btn1" onclick="next()" >lanjut</button>
                  </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <script src="{{ asset('assets/vendor/jquery/dist/jquery.min.js') }}"></script>

<script>


$("#formtab3").submit(function(e) {
e.preventDefault();
tambah();
});



function selesai() {
location.reload();

}

function next() {
  $(location).attr('href',"{{url('8f8fe8570a6fca0299bce1c90079cbe6/5')}}");

}




</script>

   @endsection
