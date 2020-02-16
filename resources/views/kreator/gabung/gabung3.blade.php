@extends('layouts.app')

@section('title','gabung jadi kreator')

@section('content')
    <div class="header bg-gradient-warning pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
          <div class="col-lg-12 col-12">
              <h6 class="display-2 text-white d-inline-block mb-0">Gabung jadi kreator (3/5)🚀</h6>
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
            <div class="card col-xl-5 center " id='form3'>
              <div class="card-header">
              <div class="row align-items-center">
                <div class="col-6">
                  <!-- Title -->
                  <h5 class="h3 mb-0">apakah konten anda memiliki unsur +18?</h5>
                </div>
                <div class="col-6 text-right">
                </div>
              </div>
            </div>
              <!-- Card body -->
              <div class="card-body">
              <form id="formtab3" name="form2">

                  <div class="form-row mb-4">

                  <div class="col-md-6">

                    <input name="custom1"  id="ya" type="radio" required>
                    <label  for="ya">ya, ada beberapa</label>

                  </div>
                  <div class="col-md-6">
                    <input name="custom1"  id="tidak" type="radio">
                    <label  for="tidak">tidak ada</label>
                  </div>
                  </div>
                  </form>

                  <div class="align-right">
                  <button class="btn btn-warning" id="btn1" form="formtab3" type="submit"  >lanjut</button>

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

function tambah(nu) {

  var nudity = 0;

  if($('#ya').is(':checked')) { nudity = 1; }
  if($('#tidak').is(':checked')) { nudity = 0; }

  $.ajaxSetup({

      headers: {

          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

      }

      });
    var Data = {
      nudity : nudity,
      kode : 3

    };

      $.ajax({

      type:'POST',

      url:'/844353a0f92c1b37e3842c2cc5cddb67',

      data:{Data:Data},

      success:function(data){

        // next(nu);
        $(location).attr('href',"{{url('8f8fe8570a6fca0299bce1c90079cbe6/4')}}");

      }

      });



      };

  </script>

   @endsection
