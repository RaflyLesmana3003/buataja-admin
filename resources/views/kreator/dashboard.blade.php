@extends('layouts.app')

@section('title','dashboard')

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
          <h6 class="h2 text-white d-inline-block mb-0">dashboard kreator</h6>
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
        <div class="col-xl-4 col-md-6">
          <div class="card card-stats">
            <!-- Card body -->
              <div class="card-body">
                <div class="row">
                  <div class="col">
                    <h5 class="card-title text-uppercase text-muted mb-0">Total pendapatan</h5>
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
                <!-- <p class="mt-3 mb-0 text-sm">
                  <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                  <span class="text-nowrap">Since last month</span>
                </p> -->
              </div>
          </div>
        </div>
        <div class="col-xl-4 col-md-6">
          <div class="card card-stats">
            <!-- Card body -->
            <div class="card-body">
              <div class="row">
                <div class="col">
                  <h5 class="card-title text-uppercase text-muted mb-0">Total pengikut</h5>
                  @if(count($creator)>0)
                  @foreach($creator as $creators)
                  <span class="h2 font-weight-bold mb-0">{{$creators->followers}}</span>
                  @endforeach
                  @endif
                </div>
                <div class="col-auto">
                  <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                    <i class="fa fa-user"></i>
                  </div>
                </div>
              </div>
              <!-- <p class="mt-3 mb-0 text-sm">
                <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                <span class="text-nowrap">Since last month</span>
              </p> -->
            </div>
          </div>
        </div>
        <div class="col-xl-4 col-md-12">
          <div class="card card-stats">
            <!-- Card body -->
            <div class="card-body">
              <div class="row">
                <div class="col">
                  <h5 class="card-title text-uppercase text-muted mb-0">Total pendukung</h5>
                  @if(count($creator)>0)
                  @foreach($creator as $creators)
                  <span class="h2 font-weight-bold mb-0">{{$creators->membership}}</span>
                  @endforeach
                  @endif
                </div>
                <div class="col-auto">
                  <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                    <i class="ni ni-money-coins"></i>
                  </div>
                </div>
              </div>
              <!-- <p class="mt-3 mb-0 text-sm">
                <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                <span class="text-nowrap">Since last month</span>
              </p> -->
            </div>
          </div>
        </div>
        <!-- <div class="col-xl-3 col-md-6">
          <div class="card card-stats">
            <div class="card-body">
              <div class="row">
                <div class="col">
                  <h5 class="card-title text-uppercase text-muted mb-0">view rate</h5>
                  @if($view)
                  <span class="h2 font-weight-bold mb-0">{{$view}}</span>
                  @else
                  <span class="h2 font-weight-bold mb-0">0</span>

                  @endif
                </div>
                <div class="col-auto">
                  <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                    <i class="fa fa-filter"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div> -->
      </div>
    </div>
  </div>
</div>
<div class="container-fluid mt--6">
  <div class="row">
    <div class="col-xl-7">
      <div class="card">
        <!-- Card header -->
        <div class="card-header">
          <h3 class="mb-0">daftar pendukung anda</h3>
          <!-- <p class="text-sm mb-0">
            This is an exmaple of datatable using the well known datatables.net plugin. This is a minimal setup in order to get started fast.
          </p> -->
        </div>
        <div class="table-responsive py-4">
          <table class="table table-flush" id="datatable-basic3">
            <thead class="thead-light">
              <tr>
                <th>photo</th>
                <th>nama</th>
                <th>email</th>
                <th>paket</th>
                <th>tenggat waktu</th>
                <th>sisa waktu</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>photo</th>
                <th>nama</th>
                <th>email</th>
                <th>paket</th>
                <th>tenggat waktu</th>
                <th>sisa waktu</th>
              </tr>
            </tfoot>
            <tbody>
              @if (isset($member))
              @foreach ($member as $members)
              <tr>

                <td>

                  @if($members[0]->user->photo != '')
                      <a href="#">
                      <img src="{{ url('storage/file/pp/'.$members[0]->user->photo) }}"  class="avatar avatar-md rounded-circle">
                      </a>

                      @else
                      <a href="#">
                      <img src="../../assets/img/theme/team-1.png"  class="avatar avatar-md rounded-circle">
                      </a>
                      @endif
                    </td>
                <td>{{$members[0]->user->name}}</td>
                <td>{{$members[0]->user->email}}</td>
                <td>{{$members[0]->paket}}</td>
                <td>{{$members[0]->tenggatwaktu}}</td>
                <td><?php echo time_elapsed_string($members[0]->tenggatwaktu) ?></td>
              </tr>
              @endforeach
              @endif
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="col-xl-5">
      <div class="card">
        <!-- Card header -->
        <div class="card-header">
          <h3 class="mb-0">daftar follower anda</h3>
          <!-- <p class="text-sm mb-0">
            This is an exmaple of datatable using the well known datatables.net plugin. This is a minimal setup in order to get started fast.
          </p> -->
        </div>
        <div class="table-responsive py-4">
          <table class="table table-flush" id="datatable-basic4">
            <thead class="thead-light">
              <tr>
                <th>photo</th>
                <th>nama</th>
                <th>email</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>photo</th>
                <th>nama</th>
                <th>email</th>
              </tr>
            </tfoot>
            <tbody>
            @if (isset($follow))
              @foreach ($follow as $follows)
              <tr>

                <td>

                  @if($follows[0]->photo != "")
                      <a href="#">
                      <img src="{{ url('storage/file/pp/'.$follows[0]->photo) }}"  class="avatar avatar-md rounded-circle">
                      </a>

                      @else
                      <a href="#">
                      <img src="../../assets/img/theme/team-1.png"  class="avatar avatar-md rounded-circle">
                      </a>
                      @endif
                    </td>
                <td>{{$follows[0]->name}}</td>
                <td>{{$follows[0]->email}}</td>
              </tr>
              @endforeach
              @endif
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection
