@extends('layouts.app')

@section('title','daftar karya anda')

@section('content')
<div class="col-md-4">
    <div class="modal fade" id="modal-hapus" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
        <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
            <div class="modal-content bg-gradient-danger">

                <div class="modal-header">
                    <h6 class="modal-title" id="modal-title-notification">yakin nih mau dihapus?</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body">
                    <input type="hidden" id="idpost">
                    <div class="py-3 text-center">
                        <i class="ni ni-bell-55 ni-3x"></i>
                        <h4 class="heading mt-4" id="title">You should read this!</h4>
                        <p>postingan ini akan dihapus dan mungkin tidak bisa di kembalikan lagi.</p>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">gajadi</button>
                    <button type="button" class="btn btn-link text-white ml-auto" onclick="hapuspost()">ya</button>
                </div>

            </div>
        </div>
    </div>
</div>

    <div class="header bg-warning pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h6 class="display-2 text-white d-inline-block mb-0">karya keren!🚀</h6>
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
          <div class="card">
            <!-- Card header -->
            <div class="card-header">
              <h3 class="mb-0">daftar karya anda</h3>
              <!-- <p class="text-sm mb-0">
                This is an exmaple of datatable using the well known datatables.net plugin. This is a minimal setup in order to get started fast.
              </p> -->
            </div>
            <div class="table-responsive py-4">
              <table class="table table-flush" id="datatable-basic1">
                <thead class="thead-light">
                  <tr>
                    <th>judul</th>
                    <th>thumbnail</th>
                    <th>tipe</th>
                    <th>like</th>
                    <th>privilage</th>
                    <th>tanggal</th>
                    <th>opsi</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>judul</th>
                    <th>thumbnail</th>
                    <th>tipe</th>
                    <th>like</th>
                    <th>privilage</th>
                    <th>tanggal</th>
                    <th>opsi</th>
                  </tr>
                </tfoot>
                <tbody>
                  @if (count($post)>0)
                  @foreach ($post as $posts)
                  <tr>
                    <td>            <a href="{{ url('42b90196b487c54069097a68fe98ab6f/'.$posts->id) }}">
{{$posts->title}}</a></td>
                    <td><img class=" img-fluid rounded" width="150px" src="{{ asset('storage/file/'.$posts->thumbnail) }}"></td>
                    <td>
                      @if($posts->tipe == 1)
                      <span class="badge badge-pill badge-danger ">karya tulis</span>
                      @elseif($posts->tipe == 2)
                      <span class="badge badge-pill badge-danger">karya gambar/foto</span>
                      @elseif($posts->tipe == 3)
                      <span class="badge badge-pill badge-danger">karya video</span>
                      @elseif($posts->tipe == 4)
                      <span class="badge badge-pill badge-danger">karya musik</span>
                      @endif
                    </td>
                    <td>  @if($posts->like == "")
                      {{"0"}}
                      @else
                      {{$posts->like}}
                    @endif</td>
                    <td>  @if($posts->privilage == -1)
                      <span class="badge badge-pill badge-secondary">publik</span>
                      @elseif($posts->privilage == -2)
                      <span class="badge badge-pill badge-primary">pendukung</span>
                      @else
                      <span class="badge badge-pill badge-warning">paket</span>
                      @endif</td>
                    <td>{{$posts->created_at}}</td>
                    <td><button onclick="modalhapus('{{$posts->id}}','{{$posts->title}}')" class="btn btn-warning">hapus</button></td>
                  </tr>
                  @endforeach
                  @else
                  @endif

                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <script type="text/javascript">
      function modalhapus(id, title) {
          $("#title").text(title);
          $("#idpost").val(id);

          $('#modal-hapus').modal('show');
      }

      function hapuspost() {
          var formData = new FormData();

          formData.append("id", $('#idpost').val());
          $.ajaxSetup({

              headers: {

                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

              }

          });

          $.ajax({

              type: 'POST',
              processData: false,
              contentType: false,
              url: '/ebf429e2cc2e4dae0f248cf231c9a932',

              data: formData,

              success: function(data) {
                  location.reload();
              }

          });
      }
      </script>



   @endsection
