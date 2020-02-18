@extends('layouts.app')

@section('title','pencairan')

@section('content')
<?php
function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'tahun',
        'm' => 'bulan',
        'w' => 'minggu',
        'd' => 'hari',
        'h' => 'jam',
        'i' => 'menit',
        's' => 'detik',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? '' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' lagi' : 'baru saja';
}
?>
<div class="header bg-gradient-warning pb-6">
  <div class="container-fluid">
    <div class="header-body">
      <div class="row align-items-center py-4">
        <div class="col-lg-6 col-7">
          <!-- <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
              <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
              <li class="breadcrumb-item"><a href="#">Dashboards</a></li>
              <li class="breadcrumb-item active" aria-current="page">Default</li>
            </ol>
          </nav> -->
        </div>
        <!-- <div class="col-lg-6 col-5 text-right">
          <a href="#" class="btn btn-sm btn-neutral">New</a>
          <a href="#" class="btn btn-sm btn-neutral">Filters</a>
        </div> -->
      </div>
      <!-- Card stats -->
      <div class="row">
        <div class="col-xl-3 col-md-6">
          <div class="card card-stats">
            <!-- Card body -->
             
          </div>
        </div>

      </div>
    </div>
  </div>
</div>
<div class="container-fluid mt--6">
  <div class="row">
   
    <div class="col-xl-12">
      <div class="card">
        <!-- Card header -->
        <div class="card-header">
          <h3 class="mb-0">permintaan penarikan</h3>
          <!-- <p class="text-sm mb-0">
            This is an exmaple of datatable using the well known datatables.net plugin. This is a minimal setup in order to get started fast.
          </p> -->
        </div>
        <div class="table-responsive py-4">
          <table class="table table-flush" id="datatable-basic2">
            <thead class="thead-light">
              <tr>
                <th>waktu penarikan</th>
                <th>nama kreator</th>
                <th>jumlah</th>
                <th>rekening tujuan</th>
                <th>atas nama</th>
                <th>bank tujuan</th>
                <th>status</th>
                <th>opsi</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
              <th>waktu penarikan</th>
                <th>nama kreator</th>
                <th>jumlah</th>
                <th>rekening tujuan</th>
                <th>atas nama</th>
                <th>bank tujuan</th>
                <th>status</th>
                <th>opsi</th>
              </tr>
            </tfoot>
            <tbody>
              @if (count($with)>0)
              @foreach ($with as $withs)
              <tr>
              <td>{{$withs->created_at}}</td>
              <td>{{$withs->kreator}}</td>
              <td>Rp.{{$withs->total}}</td>
              <td>{{$withs->rekening_tujuan}}</td>
                <td>{{$withs->atas_nama}}</td>
                <td>{{$withs->name}}</td>
              <td>
                  @if ($withs->status == 1)
                  <span class="badge badge-pill badge-primary">pending</span>
                  @elseif($withs->status == 2)
                  <span class="badge badge-pill badge-success">success</span>

                  @else
                  <span class="badge badge-pill badge-danger">ditolak</span>
                  @endif
                  </td>
                
                  <td>
                  <button class="btn btn-success btn-sm" onclick="success({{$withs->id}})">success</button>
                  <button class="btn btn-warning btn-sm" onclick="gagal({{$withs->id}})">gagal</button>
                  </td>
               
              </tr>
              @endforeach
              @endif
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <script>
  function success(id) {
    var formData = new FormData();
  formData.append('id', id);

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
  url: "/successpenarikan",
  data:formData,
  success:function(data){
    $("#message").append('<div  class="aa alert alert-success alert-block"><button type="button" class="close" data-dismiss="alert">×</button> <strong>data anda telah diupdate</strong></div>');
      setTimeout("$('.aa').fadeOut(1000);", 3000);
      $("html, body").animate({ scrollTop: 0 }, "slow");
      setTimeout("window.location.href = '{{url('/')}}';", 3000);


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
   
  }

  function gagal(id) {
    var formData = new FormData();
  formData.append('id', id);

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
  url: "/gagalpenarikan",
  data:formData,
  success:function(data){
    
    setTimeout("location.reload();", 3000);


  },
    error: function(file, response)
    {

        setTimeout("location.reload();", 3000);

       return false;
    }

  });
   
  }
  </script>
@endsection
