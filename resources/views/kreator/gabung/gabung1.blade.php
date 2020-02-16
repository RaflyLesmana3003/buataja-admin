@extends('layouts.app')

@section('title','gabung jadi kreator 1')

@section('content')
    <div class="header bg-gradient-warning pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h6 class="display-2 text-white d-inline-block mb-0">Gabung jadi kreator (1/5) 🚀</h6>
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
            <!-- nama halaman -->
            <div class="card col-xl-5 center " id='form1' >
              <!-- Card header -->
              <div class="card-header">
              <div class="row align-items-center">
                <div class="col-8">
                  <!-- Title -->
                  <h5 class="h3 mb-0">Nama halaman kamu</h5>
                </div>
              </div>
            </div>
              <!-- Card body -->
              <div class="card-body">
                  <div class="form-row">
                    <div class="col-md-12 mb-3">
                    <span id="message"></span>

                    <form id="formtab1" class="form">

                      <label class="form-control-label" for="name">nama<span style="color:red;">*</span><sup>tanpa spasi</sup></label>
                      @if(count($data) > 0)
                      @foreach ($data as $kreator)
                          <input type="text" class="form-control" id="name"  pattern="^\S+$" placeholder="ex: buatajachannel" value="{{$kreator->name}}" required>
                        @endforeach

                      @else

                      <input type="text" class="form-control" id="name" pattern="^\S+$" placeholder="ex: buatajachannel" value="" required>
                      @endif
                  </form>

                    </div>
                  </div>
                  <div class="align-right">
                  <button class="btn btn-warning"  form="formtab1" type="submit"  >lanjut</button>
                  </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <script src="{{ asset('assets/vendor/jquery/dist/jquery.min.js') }}"></script>

      <script>

    $("#formtab1").submit(function(e) {
    e.preventDefault();
    tambah();
    });



      function selesai() {
    location.reload();

      }

      function tambah(nu) {

        var nudity = 0;

        if($('#ya').is(':checked')) { var nudity = 1; }


        $.ajaxSetup({

            headers: {

                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

            });
          var Data = {
            name : $("#name").val(),
            kode : 1

          };

            $.ajax({

            type:'POST',

            url:'/844353a0f92c1b37e3842c2cc5cddb67',

            data:{Data:Data},

            success:function(data){

              // next(nu);
              $(location).attr('href',"{{url('8f8fe8570a6fca0299bce1c90079cbe6/2')}}");

            },error:function(data)
            {
              $("#message").append('<div  class="aa alert alert-'+data.responseJSON.tipe+' alert-block"><button type="button" class="close" data-dismiss="alert">×</button> <strong>'+data.responseJSON.data+'</strong></div>');
            setTimeout("$('.aa').fadeOut(1000);", 3000);
            $("html, body").animate({ scrollTop: 0 }, "slow");

            }

            });



            };

    // Example starter JavaScript for disabling form submissions if there are invalid fields

  </script>

   @endsection
