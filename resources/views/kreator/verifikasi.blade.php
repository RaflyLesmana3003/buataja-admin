@extends('layouts.app')

@section('title','verifikasi')

@section('content')
<div class="header bg-warning pb-6">
  <div class="container-fluid">
    <div class="header-body">
      <div class="row align-items-center py-4">
        <div class="col-lg-6 col-7">
          <h6 class="display-2 text-white d-inline-block mb-0">verifikasi!🚀</h6>
        </div>
      </div>
      <!-- Card stats -->
      <div class="row">
      </div>
    </div>
  </div>
</div>

<div class="container-fluid mt--6">
<div class="row justify-content-center">
<div class="card col-8">
        <!-- Card body -->
        <div class="card-body">
          <span id="message"></span>

          <div class="form-row">
            <div class="col-md-12 mb-3">
            <form id="form" name="form">

              <label class="form-control-label" for="customFile1">upload ktp<span class="text-danger">*</span></label><br>

              <div class="custom-file col-8">
              <input type="file" class="custom-file-input" accept="image/jpeg,image/png,image/jpg" id="customFile1" required>
              <label class="custom-file-label"  for="customFile1">pilih foto</label>
            </div>
            <br>
            <br>
            <label class="form-control-label" for="customFile2">upload foto selfie<span class="text-danger">*</span></label><br>

            <div class="custom-file col-8">
            <input type="file" class="custom-file-input" accept="image/jpeg,image/png,image/jpg" id="customFile2" required>
            <label class="custom-file-label"  for="customFile2">pilih foto</label>
            </div>
            <br>
            <br>
            <label class="form-control-label" for="customFile3">upload foto selfie besert ktp<span class="text-danger">*</span></label><br>

            <div class="custom-file col-8">
            <input type="file" class="custom-file-input" accept="image/jpeg,image/png,image/jpg" id="customFile3" required>
            <label class="custom-file-label"  for="customFile3">pilih foto</label>
          </div>
          <br>
          <br>
          <label class="form-control-label" for="customFile4">upload foto halaman awal buku rekening atau rekening koran<span class="text-danger">*</span></label><br>

          <div class="custom-file col-8">
          <input type="file" class="custom-file-input" accept="image/jpeg,image/png,image/jpg" id="customFile4" required>
          <label class="custom-file-label"  for="customFile4">pilih foto</label>
        </div>
              <!-- <label class="form-control-label d-none" for="formatter">deskripsi</label>
                <div data-toggle="quill" id="desc" class="d-none" data-quill-placeholder="pada hari minggu itu"></div>
                <br> -->
                <br>
                <br>

                <div class="align-right">  <button class="btn btn-warning ld-ext-right"  type="submit"> kirim </button>

                </form>
            </div>
            </div>
        </div>
      </div>
    </div>
    </div>
    <script src="{{ asset('assets/vendor/jquery/dist/jquery.min.js') }}"></script>

    <script type="text/javascript">
    $(document).ready(function() {
           //option A
           $("form").submit(function(e){
               e.preventDefault(e);
           });
       });
    $(".custom-file-input").on("change", function() {
var fileName = $(this).val().split("\\").pop();
$(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});

$('#form').submit(function() {
  var formData = new FormData();
  formData.append('ktp', $('input[id=customFile1]')[0].files[0]);
  formData.append('selfie', $('input[id=customFile2]')[0].files[0]);
  formData.append('ktpselfie', $('input[id=customFile3]')[0].files[0]);
  formData.append('rekening', $('input[id=customFile4]')[0].files[0]);

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
  url: "/7165a9480ff79e065fbf0a9214432f90",
  data:formData,
  success:function(data){
    $("#message").append('<div  class="aa alert alert-success alert-block"><button type="button" class="close" data-dismiss="alert">×</button> <strong>terima kasih dan mohon tunggu hasil verifikasi</strong></div>');
      setTimeout("$('.aa').fadeOut(1000);", 3000);
      $("html, body").animate({ scrollTop: 0 }, "slow");
      setTimeout("window.location.href = '{{url('106a6c241b8797f52e1e77317b96a201/kreator')}}';", 3000);
  },
    error: function(file, response)
    {

      $("#message").append('<div  class="aa alert alert-'+file.responseJSON.tipe+' alert-block"><button type="button" class="close" data-dismiss="alert">×</button> <strong>'+file.responseJSON.data+'</strong></div>');
      setTimeout("$('.aa').fadeOut(1000);", 3000);
      $("html, body").animate({ scrollTop: 0 }, "slow");
      setTimeout("location.reload();", 3000);

       return false;
    }

  });

});
    </script>
@endsection
