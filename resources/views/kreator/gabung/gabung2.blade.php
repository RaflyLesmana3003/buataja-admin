@extends('layouts.app')

@section('title','gabung jadi kreator')

@section('content')
    <div class="header bg-gradient-warning pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-12 col-12">
              <h6 class="display-2 text-white d-inline-block mb-0">Gabung jadi kreator (2/5)🚀</h6>
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
            <!-- apa yang kamu buat -->
            <div class="card col-xl-5 center " id='form2' >
              <!-- Card header -->
              <div class="card-header">
              <div class="row align-items-center">
                <div class="col-6">
                  <!-- Title -->
                  <h5 class="h3 mb-0">apa yang kamu buat</h5>
                </div>
                <div class="col-6 text-right">
                </div>
              </div>
            </div>
              <!-- Card body --> 

              <div class="card-body">
                  <div class="form-row">

                    <div class="col-md-12 mb-3">
                    <form id="formtab2" name="form2">

                      <label class="form-control-label" for="validationCustom01">kreasi kamu</label>
                      @if(count($data) > 0)
                      @foreach ($data as $kreator)
                          <input type="text" class="form-control" id="kreasi" placeholder="ex: pemusik,podcaster" value="{{$kreator->kreasi}}" required>
                        @endforeach
                                           
                      @else

                      <input type="text" class="form-control" id="kreasi" placeholder="ex: pemusik,podcaster" value="" required>             
                      @endif
                      <div class="valid-feedback">
                        Looks good!
                      </div>
                      </form>

                    </div>
                  </div>
                  <div class="align-right">
                  <button class="btn btn-warning" id="btn1" form="formtab2" type="submit"  >lanjut</button>
                  </div>
              </div> 
            </div>
          </div>
        </div>
      </div>

      <script src="{{ asset('assets/vendor/jquery/dist/jquery.min.js') }}"></script>

<script>

$("#formtab2").submit(function(e) {
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
      kreasi : $("#kreasi").val(),
      kode : 2

    };

      $.ajax({

      type:'POST',

      url:'/844353a0f92c1b37e3842c2cc5cddb67',

      data:{Data:Data},

      success:function(data){

        // next(nu);
        $(location).attr('href',"{{url('8f8fe8570a6fca0299bce1c90079cbe6/3')}}");

      }

      });



      };

// Example starter JavaScript for disabling form submissions if there are invalid fields

</script>

   @endsection