@extends('layouts.app')

@section('title','gabung jadi kreator')

@section('content')
    <div class="header bg-gradient-warning pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
          <div class="col-lg-12 col-12">
              <h6 class="display-2 text-white d-inline-block mb-0">Gabung jadi kreator (5/5)🚀</h6>
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
             <div class="card col-xl-6 center" id='form5'>

              <div class="card-header">
              <div class="row align-items-center">
                <div class="col-8">

                  <h5 class="h3 mb-0">dengan ini anda telah menyetujui term of reference dari buataja.id</h5>
                </div>
              </div>
            </div>
              <div class="card-body">
                  <div class="form-row">
                  <div class="rounded" style="height:120px;border:1px solid #ccc;font:16px/26px Georgia, Garamond, Serif;overflow:auto;">
                    As you can see, once there's enough text in this box, the box will grow scroll bars...
                    that's why we call it a scroll box! You could also place an image into the scroll box.
                    As you can see, once there's enough text in this box, the box will grow scroll bars...
                    that's why we call it a scroll box! You could also place an image into the scroll box.
                    As you can see, once there's enough text in this box, the box will grow scroll bars...
                    that's why we call it a scroll box! You could also place an image into the scroll box.
                    As you can see, once there's enough text in this box, the box will grow scroll bars...
                    that's why we call it a scroll box! You could also place an image into the scroll box.
                    As you can see, once there's enough text in this box, the box will grow scroll bars...
                    that's why we call it a scroll box! You could also place an image into the scroll box.
                    As you can see, once there's enough text in this box, the box will grow scroll bars...
                    that's why we call it a scroll box! You could also place an image into the scroll box.
                    As you can see, once there's enough text in this box, the box will grow scroll bars...
                    that's why we call it a scroll box! You could also place an image into the scroll box.
                  </div>
                  </div>
                  <br>

                  <div class="col-md-12">
                  <form id="formtab5">
                    <label ><input name="custom1"  id="tidak" type="checkbox" required>&nbsp;saya telah membaca dan menyetujui term of reference buataja.id</label>
                    </form>
                  </div>
                  <br>
                  <div class="align-right">
                  <button class="btn btn-warning" id="btn1" form="formtab5" type="submit" >gabung jadi kreator</button>
                  </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <script src="{{ asset('assets/vendor/jquery/dist/jquery.min.js') }}"></script>

      <script>



    $("#formtab5").submit(function(e) {
e.preventDefault();
tambah();
});
      function tambah(nu) {



        $.ajaxSetup({

            headers: {

                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

            });
          var Data = {
      kode : 5

          };

            $.ajax({

            type:'POST',

            url:'/844353a0f92c1b37e3842c2cc5cddb67',

            data:{Data:Data},

            success:function(data){

        $(location).attr('href',"{{url('de95b43bceeb4b998aed4aed5cef1ae7')}}");
              // next(nu);

            }

            });



            };

  </script>

   @endsection
