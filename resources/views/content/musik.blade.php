@extends('layouts.app')

@section('title','karya audio')

@section('content')
    <div class="header bg-gradient-warning pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h6 class="display-2 text-white d-inline-block mb-0">Karya audio 🚀</h6>
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
            <!-- nama halaman -->
            <div class="col-xl-8 order-xl-1">
            <div class="card" id='form1'>
              <!-- Card body -->
              <div class="card-body">
              <span id="message"></span>

                  <div class="form-row">
                    <div class="col-md-12 mb-3">
                    <form id="form" name="form">

                      <label class="form-control-label" for="validationCustom01">judul<span class="text-danger">*</span></label>
                      <input type="text" class="form-control" id="title" placeholder="judul karya anda" required>
                      <br>
                      <label class="form-control-label" for="customFile">upload thumbnail<span class="text-danger">*</span></label><br>
                      <div class="custom-file col-8">
                      <input type="file" class="custom-file-input" accept="image/jpeg,image/png,image/jpg" id="customFile" required>
                      <label class="custom-file-label" for="customFile">pilih foto</label>
                    </div>
                    <div class="form-group">
                    <br>
                    <label class="form-control-label" for="caption">caption<span class="text-danger">*</span></label>
                    <textarea class="form-control"  id="caption" rows="2"  placeholder="hallo guys...." resize="none"></textarea>
                  </div>
                    <label class="form-control-label" for="validationCustom01">upload karya<span class="text-danger">*</span></label>
                  <div   class="dropzone" id="dropzone">

                  </div>
                  <ul class="dz-preview dz-preview-multiple list-group list-group-lg list-group-flush">
                  <li class="list-group-item px-0" >
                                <div class="row align-items-center">
                                    <div class="col-6">
                                    <h4 class="mb-1" data-dz-name>...</h4>
                                    <p class="small text-muted mb-0" data-dz-size>...</p>
                                    </div>
                                    <div class="col-4">
                                    <div class="progress">
                                    <div class="progress-bar progress-bar-primary" role="progressbar" data-dz-uploadprogress>
                                        <span class="progress-text"></span>
                                    </div>
                                </div>
                                    </div>
                                    <div class="col-2">
                                    <a href="#" class="dropdown-item" data-dz-remove>
                                            hapus
                                        </a>
                                    </div>
                                </div>
                                </li>
                            </ul>
                    <br>

                      <label class="form-control-label" for="formatter">deskripsi</label>
                        <div data-toggle="quill" id="desc" data-quill-placeholder="pada hari minggu itu"></div>
                        <br>


                        </form>
                    </div>
                    </div>
              </div>
            </div>
            </div>

            <div class="col-xl-3 order-xl-1">
            <!-- setting -->
            <div class="card  ">
              <!-- Card body -->
              <div class="card-body">
                  <div class="form-row">
                    <div class="col-md-12 mb-3">
                      <label class="form-control-label" for="validationCustom01">siapa yang dapat melihat ini?</label>
                      <div class="form-row mb-4 mt-1">
                        <div class="col-md-6">
                        <div class="custom-control custom-radio mb-3">
                          <input name="custom-radio-2"   onclick="paket()"  form="form" class="custom-control-input privilage" id="customRadio5" value="-1" type="radio" required>
                          <label class="custom-control-label" for="customRadio5">publik</label>
                        </div>
                        <div class="custom-control custom-radio mb-3">
                          <input name="custom-radio-2"  onclick="paket()"   form="form" class="custom-control-input privilage" value="-2" id="customRadio1" type="radio">
                          <label class="custom-control-label" for="customRadio1">semua pendukung</label>
                        </div>

                        @if(count($paket))
                        <div class="custom-control custom-radio mb-3">
                          <input name="custom-radio-2" onclick="paket()"  form="form" class="custom-control-input " id="customRadio2" type="radio">
                          <label class="custom-control-label" for="customRadio2">pilih paket</label>
                        </div>
                        <div id="paket" class="d-none">
                              <hr class="mt-2">
                              @foreach($paket as $pakets)
                              <div class="custom-control custom-checkbox mb-3">
                                <input class="custom-control-input aa privilage" id="{{$pakets->id}}" value="{{$pakets->id}}" type="checkbox" required>
                                <label class="custom-control-label" for="{{$pakets->id}}">{{$pakets->nama_paket}}</label>
                              </div>
                              @endforeach
                        </div>

                        @endif
                        </div>
                        </div>
                  <div class="align-right">
                  <button class="btn btn-warning ld-ext-right " id="btn1" form="form" type="submit"> buat karya</button>
                  <button class="btn btn-warning ld-ext-right d-none" id="btn2" > <i class="fa fa-spinner fa-spin"></i> sabar dulu</button>

                  </div>
              </div>
            </div>
            </div>
            </div>
            </div>
            </div>

            <script src="{{ asset('assets/vendor/dropzone/dist/min/dropzone.min.js') }}"></script>
            <script src="{{ asset('assets/vendor/quill/dist/quill.min.js') }}"></script>

            <script src="{{ asset('assets/vendor/jquery/dist/jquery.min.js') }}"></script>


      <script>
      $("#form").submit(function(e) {
          var xx = document.getElementById("btn1");
          var yy = document.getElementById("btn2");
          xx.classList.add("d-none");
          yy.classList.remove("d-none");
    e.preventDefault();
});

       var $quill = new Quill('[data-toggle="quill"]', {
    modules: {
      toolbar: [
            ['bold', 'italic'],
            ['link', 'blockquote', 'code','video', 'image'],
            [{
              'list': 'ordered'
            }, {
              'list': 'bullet'
            }]
          ]
    },
    placeholder: 'silahkan berkarya disini',
    theme: 'snow'
});

      $(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});
 var preview = $('.dz-preview');
		  var currentFile = undefined;
      var $dropzonePreview = $('.dz-preview');
       Dropzone.options.dropzone =
         {
          headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
          url: "/80d5f512d443c9573b5a408fb01d2e3a",
          autoProcessQueue: false,
          thumbnailWidth: null,
          thumbnailHeight: null,
          previewsContainer: preview.get(0),
          previewTemplate: preview.html(),
          maxFilesize: 200000000,
          acceptedFiles: ".mp3",
          maxFiles: 1 ,
          timeout: 36000000,
          removedfile: function(file)
          {

              var name = file.upload.filename;
              $.ajax({
                  headers: {
                              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                          },
                  type: 'POST',
                  url: "{{url('image/delete')}}",
                  data: {filename: name},
                  success: function (data){
                      console.log("File has been successfully removed!!");
                  },
                  error: function(e) {
                      console.log(e);
                  }});
                  var fileRef;
                  return (fileRef = file.previewElement) != null ?
                  fileRef.parentNode.removeChild(file.previewElement) : void 0;
          },
          uploadprogress: function(file, progress, bytesSent) {
    if (file.previewElement) {
        var progressElement = file.previewElement.querySelector("[data-dz-uploadprogress]");
        progressElement.style.width = progress + "%";
        progressElement.querySelector(".progress-text").textContent = progress + "%";
    }
},
     init: function() {

      preview.html('');

     this.on("sending", function(file, xhr, formData){
      var content;
        var desceditor = new Quill('#desc');
        var delta = desceditor.getContents();
        content = JSON.stringify(delta);

        formData.append("privilage",$('.privilage:checked').map(function(_, el) {return $(el).val();}).get());
        formData.append("title",$('#title').val());
        formData.append("caption",$('#caption').val());
        formData.append("desc",content);
        formData.append('thumbnail', $('#customFile')[0].files[0]);
              });

     var submitButton = document.querySelector("#btn1")
    Dropzone = this;
    $('form').submit(function() {
      checked = $("input[type=checkbox]:checked").length;
      if($('#customRadio2').is(':checked')) {
        if(!checked) {
          $("#message").append('<div  class="aa alert alert-danger alert-block"><button type="button" class="close" data-dismiss="alert">×</button> <strong>pilihan paket harus diisi</strong></div>');
            setTimeout("$('.aa').fadeOut(1000);", 3000);
            var xx = document.getElementById("btn1");
          var yy = document.getElementById("btn2");
          xx.classList.remove("d-none");
          yy.classList.add("d-none");
  return false;
}

      }
      var _validFileExtensions = [".jpg", ".jpeg", ".bmp", ".gif", ".png"];

var arrInputs = document.getElementsByTagName("input");
  for (var i = 0; i < arrInputs.length; i++) {
      var oInput = arrInputs[i];
      if (oInput.type == "file") {
          var sFileName = oInput.value;
          if (sFileName.length > 0) {
              var blnValid = false;
              for (var j = 0; j < _validFileExtensions.length; j++) {
                  var sCurExtension = _validFileExtensions[j];
                  if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                      blnValid = true;
                      break;
                  }
              }

              if (!blnValid) {
                $("#message").append('<div  class="aa alert alert-danger" alert-block"><button type="button" class="close" data-dismiss="alert">×</button> <strong>file harus .jpg atau .png</strong></div>');
                setTimeout("$('.aa').fadeOut(1000);", 3000);
                $("html, body").animate({ scrollTop: 0 }, "slow");
                var xx = document.getElementById("btn1");
        formData.append("privilage",$('.privilage:checked').map(function(_, el) {return $(el).val();}).get());
                var yy = document.getElementById("btn2");
                xx.classList.remove("d-none");
                yy.classList.add("d-none");
                  return false;
              }
          }
      }
  }


      if (Dropzone.getQueuedFiles().length > 0) {
        Dropzone.processQueue();
      } else {

        var content;
        var desceditor = new Quill('#desc');
        var delta = desceditor.getContents();
        content = JSON.stringify(delta);
        var formData = new FormData();

        formData.append("title",$('#title').val());
        formData.append("caption",$('#caption').val());
        formData.append("desc",content);
        formData.append('thumbnail', $('input[type=file]')[0].files[0]);

        $.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

        });



        $.ajax({

        type:'POST',
        processData: false,
    contentType: false,
        fileElementId: "customFile",
        url: "/80d5f512d443c9573b5a408fb01d2e3a",

        data:formData,

        success:function(data){
          $("#message").append('<div  class="aa alert alert-success alert-block"><button type="button" class="close" data-dismiss="alert">×</button> <strong>karya anda baru diposting</strong></div>');
            setTimeout("$('.aa').fadeOut(1000);", 3000);
            $("html, body").animate({ scrollTop: 0 }, "slow");
            setTimeout("window.location.href = '{{url('106a6c241b8797f52e1e77317b96a201/kreator')}}';", 3000);
        },
          error: function(file, response)
          {

              $("#message").append('<div  class="aa alert alert-'+file.responseJSON.tipe+' alert-block"><button type="button" class="close" data-dismiss="alert">×</button> <strong>'+file.responseJSON.data+'</strong></div>');
            setTimeout("$('.aa').fadeOut(1000);", 3000);
            $("#message").attr("id", "message1");
            $("html, body").animate({ scrollTop: 0 }, "slow");

            setTimeout("location.reload();", 2000);
            return false;

          },

        });

      }
    });
   },
   success:function(data){
          $("#message").append('<div  class="aa alert alert-success alert-block"><button type="button" class="close" data-dismiss="alert">×</button> <strong>karya anda baru diposting</strong></div>');
            setTimeout("$('.aa').fadeOut(1000);", 3000);
            $("html, body").animate({ scrollTop: 0 }, "slow");
            setTimeout("window.location.href = '{{url('106a6c241b8797f52e1e77317b96a201/kreator')}}';", 3000);
        },
          error: function(file, response)
          {

              $("#message").append('<div  class="aa alert alert-'+file.responseJSON.tipe+' alert-block"><button type="button" class="close" data-dismiss="alert">×</button> <strong>'+file.responseJSON.data+'</strong></div>');
            setTimeout("$('.aa').fadeOut(1000);", 3000);
            $("#message").attr("id", "message1");
            $("html, body").animate({ scrollTop: 0 }, "slow");


            setTimeout("location.reload();", 2000);
            return false;

          },

};

      //DOM manipulation code

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
