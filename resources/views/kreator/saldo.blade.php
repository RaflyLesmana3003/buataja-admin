@extends('layouts.app')

@section('title','saldo')

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
              <div class="card-body">
                <div class="row">
                  <div class="col">
                    <h5 class="card-title text-uppercase text-muted mb-0">saldo saat ini</h5>
                    @if($pendapatan)
                    <span class="h2 font-weight-bold mb-0">Rp. {{$pendapatan}}</span>
                    @else
                    <span class="h2 font-weight-bold mb-0">0</span>

                    @endif
                  </div>
                  <div class="col-auto">
                    <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                      <i class="fa fa-money"></i>
                    </div>
                  </div>
                </div>
              <div class="row text-center">
                <div class="col-12  mt-3 mb-0">
                <a href="{{url('f27fc78ffa140e97e0c535374a2a2213/tarik')}}" class="btn btn-outline-primary btn-xl ">tarik saldo</a>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>
<div class="container-fluid mt--6">
  <div class="row">
    <div class="col-xl-6">
      <div class="card">
        <!-- Card header -->
        <div class="card-header">
          <h3 class="mb-0">history transaksi</h3>
          <!-- <p class="text-sm mb-0">
            This is an exmaple of datatable using the well known datatables.net plugin. This is a minimal setup in order to get started fast.
          </p> -->
        </div>
        <div class="table-responsive py-4">
          <table class="table table-flush" id="datatable-basic">
            <thead class="thead-light">
              <tr>
                <th>photo</th>
                <th>nama</th>
                <th>email</th>
                <th>paket</th>
                <th>harga</th>
                <th>tanggal transaksi</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>photo</th>
                <th>nama</th>
                <th>email</th>
                <th>paket</th>
                <th>harga</th>
                <th>tanggal transaksi</th>
              </tr>
            </tfoot>
            <tbody>
              @if (count($transaksi)>0)
              @foreach ($transaksi as $transaksis)
              <tr>

                <td>  @if($transaksis->photo != "")
                      <a href="#">
                      <img src="{{ url('storage/file/pp/'.$transaksis->photo) }}"  class="avatar avatar-md rounded-circle">
                      </a>

                      @else
                      <a href="#">
                      <img src="../../assets/img/theme/team-1.png"  class="avatar avatar-md rounded-circle">
                      </a>
                      @endif</td>
                <td>{{$transaksis->name}}</td>
                <td>{{$transaksis->email}}</td>
                <td>{{$transaksis->nama_paket}}</td>
                <td>{{number_format($transaksis->harga,2,",",".")}}</td>
                <td>{{$transaksis->updated_at}}</td>
              </tr>
              @endforeach
              @endif
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="col-xl-6">
      <div class="card">
        <!-- Card header -->
        <div class="card-header">
          <h3 class="mb-0">history penarikan</h3>
          <!-- <p class="text-sm mb-0">
            This is an exmaple of datatable using the well known datatables.net plugin. This is a minimal setup in order to get started fast.
          </p> -->
        </div>
        <div class="table-responsive py-4">
          <table class="table table-flush" id="datatable-basic2">
            <thead class="thead-light">
              <tr>
                <th>waktu penarikan</th>
                <th>status</th>
                <th>jumlah</th>
                <th>fee</th>
                <th>rekening tujuan</th>
                <th>atas nama</th>
                <th>bank tujuan</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>waktu penarikan</th>
                <th>status</th>
                <th>jumlah</th>
                <th>fee</th>
                <th>rekening tujuan</th>
                <th>atas nama</th>
                <th>bank tujuan</th>
              </tr>
            </tfoot>
            <tbody>
              @if (count($with)>0)
              @foreach ($with as $withs)
              <tr>
              <td>{{$withs->created_at}}</td>

              <td>
                  @if ($withs->status == 1)
                  <span class="badge badge-pill badge-primary">pending</span>
                  @elseif($withs->status == 2)
                  <span class="badge badge-pill badge-primary">success</span>

                  @else
                  <span class="badge badge-pill badge-primary">ditolak</span>
                  @endif
                  </td>
                <td>Rp.{{$withs->total}}</td>
                <td>Rp.{{$withs->fee}}</td>
                <td>{{$withs->rekening_tujuan}}</td>
                <td>{{$withs->atas_nama}}</td>
                <td>{{$withs->name}}</td>
               
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
  
  </script>
@endsection
