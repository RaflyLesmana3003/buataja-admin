@extends('layouts.app')

@section('title','karya tulis')

@section('content')
    <div class="header bg-gradient-warning pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h6 class="display-2 text-white d-inline-block mb-0">bagikan link 🚀</h6>
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
                  <div class="form-row">
                    <div class="col-md-12 mb-3">
                    <form method="post" action="{{url('image/upload/store')}}" >
                    <label class="form-control-label" for="validationCustom01">sematkan url</label>
                    <div class="form-group">
                        <div class="input-group input-group-merge">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-link"></i></span>
                          </div>
                          <input class="form-control" id="url" placeholder="https://" type="text">
                        </div>
                      </div>
                      <label class="form-control-label" for="validationCustom01">judul</label>
                      <input type="text" class="form-control" id="title" placeholder="contoh: pada hari minggu" required>
                      <div class="valid-feedback">
                        Looks good!
                      </div>
                      <br><div class="form-group">
                    <label class="form-control-label" for="caption">caption</label>
                    <textarea class="form-control"  id="caption" rows="2" resize="none"></textarea>
                          </div>
                      <label class="form-control-label" for="formatter">desc</label>
                        <div data-toggle="quill" id="desc"  data-quill-placeholder="pada hari minggu itu"></div>
                        <br>
                  
                  @csrf
                  <label class="form-control-label" for="dropzone">lampiran dokumen</label>
                  <div  data-dropzone-multiple class="dropzone" id="dropzone">
                    
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
                          <input name="custom-radio-2" onclick="paket()" class="custom-control-input" id="customRadio5" type="radio">
                          <label class="custom-control-label" for="customRadio5">publik</label>
                        </div>
                        <div class="custom-control custom-radio mb-3">
                          <input name="custom-radio-2" onclick="paket()" class="custom-control-input" id="customRadio1" type="radio">
                          <label class="custom-control-label" for="customRadio1">hanya member</label>
                        </div>
                        <div class="custom-control custom-radio mb-3">
                          <input name="custom-radio-2" onclick="paket()" class="custom-control-input" id="customRadio2" type="radio">
                          <label class="custom-control-label" for="customRadio2">pilih paket</label>
                        </div>
                        
                        <div id="paket" class="d-none">
                        <hr>
                         <label class="form-control-label">pilih paket</label>
                        <br>
                         <div class="custom-control custom-checkbox mb-3">
                          <input class="custom-control-input" id="customCheck5" type="checkbox">
                          <label class="custom-control-label" for="customCheck5">paket 1</label>
                        </div> 
                        <div class="custom-control custom-checkbox mb-3">
                          <input class="custom-control-input" id="customCheck1" type="checkbox">
                          <label class="custom-control-label" for="customCheck1">paket 2</label>
                        </div>  
                        </div>
                        </div>
                        </div>
                  <div class="align-right">
                  <button class="btn btn-warning" id="btn1" >buat karya</button>
                  </div>
              </div> 
            </div>
            </div>
            </div> 
            </div>
            </div>
            
            <script src="{{ asset('assets/vendor/dropzone/dist/min/dropzone.min.js') }}"></script>

            <script src="{{ asset('assets/vendor/jquery/dist/jquery.min.js') }}"></script>

      <script>

      var preview = $('.dz-preview');
		  var currentFile = undefined;
      var $dropzonePreview = $('.dz-preview');
       Dropzone.options.dropzone =
         {
          headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
          url: "{{url('link')}}",
          autoProcessQueue: false,
          uploadMultiple:true,
          thumbnailWidth: null,
          thumbnailHeight: null,
          previewsContainer: preview.get(0),
          previewTemplate: preview.html(),
          maxFilesize: 200,
          parallelUploads:10,
          acceptedFiles: ".jpeg,.jpg,.png,.gif",
          timeout: 50000,
          uploadprogress: function(file, progress, bytesSent) {
    if (file.previewElement) {
        var progressElement = file.previewElement.querySelector("[data-dz-uploadprogress]");
        progressElement.style.width = progress + "%";
        progressElement.querySelector(".progress-text").textContent = progress + "%";
    }
},
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
     init: function() {
      Dropzone = this;
     preview.html('');

     this.on("sending", function(file, xhr, formData){
      var content;
        var desceditor = new Quill('#desc');
        var delta = desceditor.getContents();
        content = JSON.stringify(delta);
                      formData.append("title",$('#title').val());
        formData.append("caption",$('#caption').val());
                      formData.append("desc",content);
                      formData.append("url",$('#url').val());
              });
     var submitButton = document.querySelector("#btn1")
    Dropzone = this;
    submitButton.addEventListener("click", function() {
      
      if (Dropzone.getQueuedFiles().length > 0) {                        
        Dropzone.processQueue(); 
      } else {                       
        
        var content;
        var desceditor = new Quill('#desc');
        var delta = desceditor.getContents();
        content = JSON.stringify(delta);

        $.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

        });

        var Data = {
        title : $('#title').val(),
        url : $('#url').val(),
        caption : $('#caption').val(),
        desc : content

        };

        $.ajax({

        type:'POST',

        url: "/link",

        data:{Data:Data},

        success:function(data){

        }

        });

      }
    });
   },
          success: function(file, response) 
          {
              // console.log(response);
          },
          error: function(file, response)
          {
             return false;
          },
          
};


// Dropzone.autoDiscover = false;
// $('#btn1').click(function(){           
//   myDropzone.processQueue();
// });

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