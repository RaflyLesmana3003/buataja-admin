@extends('layouts.app')

@section('title','gabung jadi kreator')

@section('content')
    <div class="header bg-gradient-warning pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h6 class="display-2 text-white d-inline-block mb-0">Gabung jadi kreator 🚀</h6>
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
            <div class="card col-xl-5 center " id='form1'>
              <!-- Card header -->
              <div class="card-header">
              <div class="row align-items-center">
                <div class="col-8">
                  <!-- Title -->
                  <h5 class="h3 mb-0">Card title</h5>
                </div>
                <div class="col-4 text-right">
                  <a href="#!" class="btn btn-sm btn-neutral" onclick="next(1)">next</a>
                </div>
              </div>
            </div>
              <!-- Card body -->
              <div class="card-body">
                  <div class="form-row">
                    <div class="col-md-12 mb-3">
                      <label class="form-control-label" for="name">name</label>
                      <!-- @foreach ($data as $kreator)
                      <input type="text" class="form-control" id="name" placeholder="First name" value="{{$kreator->name}}" required>
                      @endforeach -->
                      @if(count($data) > 0)
                      @foreach ($data as $kreator)
                          <input type="text" class="form-control" id="name" placeholder="First name" value="{{$kreator->name}}" required>
                        @endforeach
                                           
                      @else

                      <input type="text" class="form-control" id="name" placeholder="First name" value="" required>             
                      @endif
                      
                    </div>
                  </div>
                  <div class="align-right">
                  <button class="btn btn-warning" id="btn1" onclick="tambah(1)" >ok</button>
                  </div>
              </div> 
            </div>
            <!-- apa yang kamu buat -->
            <div class="card col-xl-5 center d-none" id='form2'>
              <!-- Card header -->
              <div class="card-header">
              <div class="row align-items-center">
                <div class="col-8">
                  <!-- Title -->
                  <h5 class="h3 mb-0">Card title</h5>
                </div>
                <div class="col-4 text-right">
                  <a href="#!" class="btn btn-sm btn-neutral" onclick="back(2)">back</a>
                  <a href="#!" class="btn btn-sm btn-neutral" onclick="next(2)">next</a>
                </div>
              </div>
            </div>
              <!-- Card body --> 

              <div class="card-body">
                  <div class="form-row">
                    <div class="col-md-12 mb-3">
                      <label class="form-control-label" for="validationCustom01">name</label>
                      @if(count($data) > 0)
                      @foreach ($data as $kreator)
                          <input type="text" class="form-control" id="kreasi" placeholder="First name" value="{{$kreator->kreasi}}" required>
                        @endforeach
                                           
                      @else

                      <input type="text" class="form-control" id="kreasi" placeholder="First name" value="" required>             
                      @endif
                      <div class="valid-feedback">
                        Looks good!
                      </div>
                    </div>
                  </div>
                  <div class="align-right">
                  <button class="btn btn-warning" id="btn1" onclick="tambah(2)" >ok</button>
                  </div>
              </div> 
            </div>
            <!-- Verify accounts to expedite your page approval. -->
            <div class="card col-xl-5 center d-none" id='form3'>
              <!-- Card header -->
              <div class="card-header">
              <div class="row align-items-center">
                <div class="col-8">
                  <!-- Title -->
                  <h5 class="h3 mb-0">Verify accounts to expedite your page approval.</h5>
                </div>
                <div class="col-4 text-right">
                  <a href="#!" class="btn btn-sm btn-neutral" onclick="back(3)">back</a>
                  <a href="#!" class="btn btn-sm btn-neutral" onclick="next(3)">next</a>
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
                        <a href="#" class="avatar">
                          <img alt="Image placeholder" src="../../assets/img/facebook.png">
                        </a>
                      </div>
                      <div class="col ml--2">
                        <h4 class="mb-0">
                          <a href="#!">Facebook</a>
                        </h4>
                        <span class="text-success">●</span>
                        <small>connected</small>
                      </div>
                      <div class="col-auto">
                        <!-- <button type="button" class="btn btn-sm btn-outline-warning">unconnected</button> -->
                        <a href="{{ url('/creator/facebook') }}" class="btn btn-facebook"><i class="fa fa-facebook"></i> Facebook</a>
                      </div>
                    </div>
                  </li>
                  <li class="list-group-item px-0">
                    <div class="row align-items-center">
                      <div class="col-auto">
                        <!-- Avatar -->
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
                  </li>
                </ul>
                  <div class="align-right mt-5">
                  <button class="btn btn-warning" id="btn1" onclick="next(3)" >ok</button>

                  </div>
              </div> 
            </div>
            <!-- What describes your content?  -->
            <!-- <div class="card col-xl-6 center d-none" id='form4'>
              <div class="card-header">
                <h3 class="mb-0">What describes your content? </h3>
              </div>
              <div class="card-body">
                  <div class="form-row">
                    <div class="col-md-12 mb-3">
                      <div class="row">
                      <div class="col-md-6">
                        <div class="custom-control custom-checkbox mb-3">
                          <input class="custom-control-input" name="content" value="Podcast" id="customCheck1" type="checkbox">
                          <label class="custom-control-label" for="customCheck1">Podcast</label>
                        </div>
                        <div class="custom-control custom-checkbox mb-3">
                          <input class="custom-control-input" name="content" value="video"  id="customCheck2" type="checkbox">
                          <label class="custom-control-label" for="customCheck2">video</label>
                        </div>
                        <div class="custom-control custom-checkbox mb-3">
                          <input class="custom-control-input" name="content" value="video" id="customCheck3" type="checkbox">
                          <label class="custom-control-label" for="customCheck3">Music</label>
                        </div>
                        <div class="custom-control custom-checkbox mb-3">
                          <input class="custom-control-input" id="customCheck4" type="checkbox">
                          <label class="custom-control-label" for="customCheck4">Communities</label>
                        </div>
                      </div>
                      <div class="col-md-6">
                      <div class="custom-control custom-checkbox mb-3">
                          <input class="custom-control-input" id="customCheck5" type="checkbox">
                          <label class="custom-control-label" for="customCheck5">Illustration & Animation</label>
                        </div>
                        <div class="custom-control custom-checkbox mb-3">
                          <input class="custom-control-input" id="customCheck6" type="checkbox">
                          <label class="custom-control-label" for="customCheck6">writing & journalism</label>
                        </div>
                        <div class="custom-control custom-checkbox mb-3">
                          <input class="custom-control-input" id="customCheck7" type="checkbox">
                          <label class="custom-control-label" for="customCheck7">games & Software</label>
                        </div>
                        <div class="custom-control custom-checkbox mb-3">
                          <input class="custom-control-input" id="customCheck8" type="checkbox">
                          <label class="custom-control-label" for="customCheck8">Other</label>
                        </div>
                      </div>
                    </div>
                    </div>
                  </div>
                  <div class="align-right">
                  <button class="btn btn-warning" onclick="back(4)" type="submit">back</button>
                  <button class="btn btn-warning" onclick="next(4)" type="submit">next</button>
                  </div>
              </div> 
            </div> -->
            <!-- nudity -->
            <div class="card col-xl-5 center d-none" id='form4'>
              <div class="card-header">
              <div class="row align-items-center">
                <div class="col-8">
                  <!-- Title -->
                  <h5 class="h3 mb-0">Does your work contain 18+ themes such as real or illustrated nudity?</h5>
                </div>
                <div class="col-4 text-right">
                  <a href="#!" class="btn btn-sm btn-neutral" onclick="back(4)">back</a>
                  <a href="#!" class="btn btn-sm btn-neutral" onclick="next(4)">next</a>
                </div>
              </div>
            </div>
              <!-- Card body -->
              <div class="card-body">
                  <div class="form-row mb-4">
                  <div class="col-md-6">
                  <div class="custom-control custom-radio mb-3">
                    <input name="custom-radio-2" class="custom-control-input" id="ya" type="radio">
                    <label class="custom-control-label" for="ya">ya, ada beberapa</label>
                  </div>
                  </div>
                  <div class="col-md-6">
                  <div class="custom-control custom-radio mb-3">
                    <input name="custom-radio-2" class="custom-control-input" id="tidak" type="radio">
                    <label class="custom-control-label" for="tidak">tidak ada</label>
                  </div>
                  </div>
                  </div>
                  <div class="align-right">
                  <button class="btn btn-warning" id="btn1" onclick="tambah(4)" >ok</button>
                  </div>
              </div> 
            </div>
            <!-- Almost there! We sent a verification email to -->
            <div class="card col-xl-6 center d-none" id='form5'>
              <!-- Card header -->
              <div class="card-header">
              <div class="row align-items-center">
                <div class="col-8">
                  <!-- Title -->
                  <h5 class="h3 mb-0">verifikasi email</h5>
                </div>
                <div class="col-4 text-right">
                  <a href="#!" class="btn btn-sm btn-neutral" onclick="back(5)">back</a>
                </div>
              </div>
            </div>
              <!-- Card body -->
              <div class="card-body">
                  <div class="form-row">
                  <h4>asasa asasas asdasd</h4>
                  </div>
                  <div class="align-right">
                  <button class="btn btn-warning" id="btn1" onclick="next(3)" >ok</button>
                  </div>
              </div> 
            </div>
          </div>
        </div>
      </div>
      </div>

      <script>
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
            iduser : <?php echo Auth::user()->id  ?>,
            kreasi : $("#kreasi").val(),
            nudity : nudity,

          };

            $.ajax({

            type:'POST',

            url:'/844353a0f92c1b37e3842c2cc5cddb67',

            data:{Data:Data},

            success:function(data){

              next(nu);

            }

            });



            };
      function next(nu) {
          x = nu;
          y = nu + 1;
          var xx = document.getElementById("form"+x);
          var yy = document.getElementById("form"+y);
          xx.classList.add("d-none");
          yy.classList.remove("d-none");
        };
        function back(nu) {
          x = nu;
          y = nu - 1;
          var xx = document.getElementById("form"+x);
          var yy = document.getElementById("form"+y);
          xx.classList.add("d-none");
          yy.classList.remove("d-none");
        };
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
      'use strict';
      window.addEventListener('load', function() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
          form.addEventListener('submit', function(event) {
            if (form.checkValidity() === false) {
              event.preventDefault();
              event.stopPropagation();
            }
            form.classList.add('was-validated');
          }, false);
        });
      }, false);
    })();
  </script>

   @endsection