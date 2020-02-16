@extends('layouts.app')

@section('title','list dukungan')
<?php
function tenggatwaktu($datetime, $full = false) {
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
    return $string ? implode(', ', $string) . ' lagi' : 'just now';
}
?>
@section('content')
@foreach ($user as $kreator)
    @if($kreator->cover != "")
    <div class="header d-flex align-items-center" style="min-height: 368px; background-image: url('{{ url('storage/file/pp/'.$kreator->cover) }}'); background-size: cover; background-position: center;"></div>
    @else
    <div class="header  d-flex align-items-center" style="min-height: 368px; background-image: url(../../assets/img/theme/profile-cover2.png); background-size: cover; background-position: center;"></div>
    @endif

    @endforeach
    <div class="container-fluid" style="margin-top: -200px;">
        <div class="row justify-content-center">
        <div class="col-xl-8">
          <!-- Members list group card -->
          <div class="card">
            <!-- Card header -->
            <div class="card-header">
              <!-- Title -->
              <h5 class="h3 mb-0">dukungan</h5>
            </div>
            <!-- Card body -->
            <div class="card-body">
              <!-- List group -->
              <ul class="list-group list-group-flush list my--3">
              @if(count($follow) > 0)
            @foreach ($follow as $follows)
                <li class="list-group-item px-0">
                  <div class="row align-items-center">
                    <div class="col-auto">
                    @if($follows->photo != "")
                        <a href="{{ url($follows->name) }}">
                        <img src="{{ url('storage/file/pp/'.$follows->photo) }}" class="avatar avatar-xs rounded-circle avatar-md">
                        </a> @else
                        <a href="{{ url($follows->name) }}">
                        <img src="../../assets/img/theme/team-1.png" class="avatar avatar-xs rounded-circle avatar-md">
                        </a>
                        @endif
                    </div>
                    <div class="col ml--2">
                      <h4 class="mb-0">
                        <a href="#!">{{$follows->name}}</a>
                      </h4>
                      <p class="text-sm text-muted mb-0">selesai dalam <?php echo tenggatwaktu($follows->tenggatwaktu)?></p>
                    </div>
                    <div class="col-auto">
                      <button type="button" class="btn btn-sm btn-primary" onclick="unfollow({{ $follows->id_creator }})">berhenti</button>
                    </div>
                  </div>
                </li>
                @endforeach
                @else
            <div class="row justify-item-center mx-1">
            <div class="col-12">
            <img class="thumbnail img-fluid rounded" src="{{ asset('assets/img/empty3.png') }}"  alt="">

            </div>
            <div class="col-12 text-center">
            <p class="text-muted"><span class="h3 text-muted">sorry nih...</span><br>anda belum terhubung dengan creator manapun</p>

            </div>
            </div>
                @endif
              </ul>
            </div>
            @if(count($follow) > 0)
            <div class="row justify-content-md-center">
            {{ $follow->links() }}
            </div>
            @endif
          </div>
        </div>
        </div>
@endsection
