@extends('layouts.app')

@section('title')
@foreach ($user as $users)
{{$users->name}}
@endforeach
@endsection

@section('content')
    <!-- Header -->
    <?php
    function FunctionName($data)
    {
        // if (is_array($data))
        //     {
        //     echo "found";
        //     }
        //     else
        //     {
        //     echo "not found";
        //     }
        try {
            $quill = new \DBlackborough\Quill\Render($data);
            $result = $quill->render();
        } catch (\Exception $e) {
            // echo "cok";
        }

        return $result;

    }

    function limit_text($text, $limit) {
        if (str_word_count($text, 0) > $limit) {
            $words = str_word_count($text, 2);
            $pos = array_keys($words);
            $text = substr($text, 0, $pos[$limit]) . ' <a href="javascript:void(0);" class="read-more">read more...</a>';
        }
        return $text;
      }
    ?>
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
    return $string ? implode(', ', $string) . ' lalu' : 'baru saja';
}
?>
    @foreach ($user as $kreator)
    @if($kreator->cover != "")
    <div class="header d-flex align-items-center" style="min-height: 368px; background-image: url('{{ url('storage/file/pp/'.$kreator->cover) }}'); background-size: cover; background-position: center;"></div>
    @else
    <div class="header  d-flex align-items-center" style="min-height: 368px; background-image: url(../../assets/img/theme/profile-cover2.png); background-size: cover; background-position: center;"></div>
    @endif

    @endforeach
    <!-- Page content -->
    <div class="container-fluid mt--6">

        <div class="row justify-content-center">
        <div class="col-xl-4 order-xl-1">
        @foreach ($user as $users)
            <div class="card card-profile">
           <div class="row justify-content-center">
                <div class="col-lg-3 order-lg-2">
                <div class="card-profile-image">
                @if($users->photo != "")
                    <a href="#">
                    <img src="{{ url('storage/file/pp/'.$users->photo) }}" id="pp1" alt="my_image" class="avatar avatar-xxl rounded-circle">
                    </a>

                    @else
                    <a href="#">
                    <img src="../../assets/img/theme/team-2.png" id="pp1" alt="my_image" class="avatar avatar-xxl rounded-circle">
                    </a>
                    @endif
                </div>
                </div>
            </div>
            <div class="card-header text-center border-0 pt-5 pt-md-4  pb-0 pb-md-4">
            </div>
            <div class="card-body pt-4 ">
                <div class="text-center">
                <h5 class="h3">
                {{ $users->name }}
                </h5>
                <div class="h5 font-weight-300">
                   {{ $users->kreasi }}

                </div>
            <div class="col mt--3">
                <div class="card-profile-stats d-flex justify-content-center">
                    <div>
                        <span class="heading"> {{ $users->followers }}</span>
                        <span class="description">pengikut</span>
                    </div>
                    <div>
                        <span class="heading"> {{ $users->membership }}</span>
                        <span class="description">dukungan</span>
                    </div>
                </div>
            </div>
                @if (Auth::user() != null)
                <?php $nama=$users->name; ?>

                    @if (isset($ifcreator))
                        @if ($ifcreator == 0)
                            @if ($iffollow != true)
                            <button type="button" class="btn btn-primary btn-sm" onclick="follow({{ $users->id }})">follow</button>
                            @else
                            <button type="button" class="btn btn-outline-primary btn-sm" onclick="unfollow({{ $users->id }})">unfollow</button>
                            @endif
                            <a  class="btn btn-primary btn-sm" href="{{url('1e71ac120240f553eed34209879fd6e7/'.$users->name)}}">berlangganan</a>
                        @endif
                    @endif
                @else
                    @if (isset($ifcreator))
                        @if ($ifcreator == 0)
                            @if ($iffollow != true)
                            <a  class="btn btn-primary btn-sm" href="{{url('login')}}">follow</a>
                            @else
                            <a  class="btn btn-outline-primary btn-sm" onclick="unfollow({{ $users->id }})">unfollow</a>
                            @endif
                            <a  class="btn btn-primary btn-sm" href="{{url('login')}}">berlangganan</a>
                        @endif
                    @endif
                @endif
                </div>
            </div>
            </div>

            <!-- Progress track goals -->
            <!-- <div class="card">
            <div class="card-header">
              <div class="row align-items-center">
                <div class="col-5">
                  <h5 class="h3 mb-0">pencapaian</h5>
                </div>
                <div class="col-7 text-right">
                  <a href="#!" class="btn btn-sm btn-outline-primary" data-target="#carouselExampleIndicators" data-slide-to="1">back</a>
                  <a href="#!" class="btn btn-sm btn-outline-primary" data-target="#carouselExampleIndicators" data-slide-to="2">next</a>
                </div>
              </div>
            </div>
            <div class="card-body">
                <div id="carouselExampleIndicators" class="carousel slide pointer-event" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <p>bantu mimin mencapai 10jt pengguna dong, nanti bakal sering sering mimin kasih cashback udah ko</p>
                        <b>5,7jt - 10jt</b> total pengguna</b>
                        <div class="progress progress-xs mt-3 mb-0">
                            <div class="progress-bar bg-red" role="progressbar" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100" style="width: 72%;"></div>
                        </div>
                    </div>
                    <div class="carousel-item ">
                        <p>Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...</p>
                        <b>$88 of 550$</b> total goals
                        <div class="progress progress-xs mb-0">
                            <div class="progress-bar bg-red" role="progressbar" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100" style="width: 72%;"></div>
                        </div>
                    </div>
                    <div class="carousel-item ">
                        <p>Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...</p>
                        <b>$88 of 550$</b> total goals
                        <div class="progress progress-xs mb-0">
                            <div class="progress-bar bg-red" role="progressbar" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100" style="width: 72%;"></div>
                        </div>
                    </div>
                </div>

                </div>
            </div>
            </div> -->


            <div class="accordion" id="accordionExample1">
            <div class="card">
        <div class="card-header" id="headingTwo" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
            <h5 class="mb-0">paket</h5>
        </div>
        <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionExample">
        <div class="card-body">
                <!-- List group -->
                <ul class="list-group list-group-flush list my--3">
                @if(count($paket)>0)
                @foreach ($paket as $pakets)
                <li class="list-group-item px-0">
                    <div class="row align-items-center">
                    <div class="col-auto">
                        <!-- Avatar -->
                        @if($pakets->photo !== null )
                    @if($pakets->photo != "")

                    <img src="{{ url('storage/file/'.$pakets->photo) }}" id="pp1" alt="my_image" class="avatar avatar-xl rounded-circle img-center img-fluid shadow shadow-lg--hover">
                    @else
                    <img src="../../assets/img/paket.png" id="pp1" alt="my_image" class="avatar avatar-xl rounded-circle img-center img-fluid shadow shadow-lg--hover">
                    @endif
                    @endif
                    </div>
                    <div class="col">
                        <p class="h3">{{$pakets->nama_paket}}</p>
                        <div class="mb-0">
                        </div>
                        @foreach ($user as $users)
                        <a type="button" href="{{url('1e71ac120240f553eed34209879fd6e7/'.$users->name)}}" class="btn btn-primary btn-sm">berlanggan</a>
                        @endforeach
                    </div>
                    </div>
                </li>
                @endforeach
                @else
            <div class="row justify-item-center mx-1">
            <div class="col-12">
            <img class="thumbnail img-fluid rounded" width="100px" src="{{ asset('assets/img/empty5.png') }}"  alt="">

            </div>
            <div class="col-12 text-center">
            <p class="text-muted"><span class="h3 text-muted">belum punya paket</p>

            </div>
            </div>
            @endif
                </ul>
            </div>
        </div>
    </div>
  </div>


        </div>
        @endforeach
        @foreach ($user as $users)
        <div class="col-xl-7 order-xl-2">
            <div class="row">

            </div>


            <div class="accordion" id="accordionExample">
            <div class="card">
        <div class="card-header" id="headingOne" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            <h5 class="mb-0">tentang saya</h5>
        </div>
        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">

            @if (isset($users->desc))
            <div class="card-body tentang">
            <?php
            echo FunctionName($users->desc);
            ?>
             </div>

             @else
             <div class="card-body">

            <div class="row justify-item-center mx-1">
            <div class="col-12">
            <img class="thumbnail img-fluid rounded" width="100px" src="{{ asset('assets/img/empty4.png') }}"  alt="">

            </div>
            <div class="col-12 text-center">
            <p class="text-muted"><span class="h3 text-muted">belum punya dekripsi</p>

            </div>
            </div>
            </div>

  @endif
        </div>
  </div>
  </div>




            <div class="card">
            <div class="card-header">
            <span id="message"></span>
<div class="row">
  <h5 class=" col h3 mb-0">karya saya</h5>
  <div class="col text-right">
      @foreach ($user as $users)
    <form class="" action="{{url($users->name)}}" method="get">
      @endforeach
      <select class="form-control" onchange="this.form.submit()" id="pakets" name="pakets">
        <option value="semua">pilih karya</option>

        <option  value="semua">semua</option>
        <option  value="publik">publik</option>
        <option  value="member">semua pendukung</option>
        <option  value="paket">paket</option>
      </select>
    </form>

  </div>
</div>

            </div>
            @if(count($data)>0)
            @foreach ($data as $post)
            @if($post->tipe == 1)
            <div class="card">
            <div class="card-header ">
            <div class="row align-items-center">


                    <div class="col">
                    <div class="d-flex align-items-center">
            @if($post->photo != "")
            <a href="{{ url($post->name) }}">
            <img src="{{ url('storage/file/pp/'.$post->photo) }}" class="avatar avatar-sm rounded-circle avatar-md">
            </a> @else
            <a href="{{ url($post->name) }}">
            <img src="../../assets/img/theme/team-1.png" class="avatar avatar-sm rounded-circle avatar-md">
            </a>
            @endif

                <div class="mx-3">
                <a href="{{ url($post->name) }}" class="text-dark font-weight-600 text-sm">{{$post->name}}</a>
                <small class="d-block text-muted"><?php echo time_elapsed_string($post->created_at)?></small>
                </div>

            </div>
                    </div>
                    <div class="col text-right">
                      @if($post->privilage == -1)
                      <span class="badge badge-pill badge-secondary">publik</span>
                      @elseif($post->privilage == -2)

                      @if(isset($post->statusmem) && isset($post->statuspaket))
                      @if($post->statusmem == 0 && $post->statuspaket == 0)
                      <span class="badge badge-pill badge-secondary">lock</span>
                      @endif
                      @endif
                      <span class="badge badge-pill badge-primary">pendukung</span>
                      @else
                      @if(isset($post->statusmem) && isset($post->statuspaket))
                      @if($post->statusmem == 0 && $post->statuspaket == 0)
                      <span class="badge badge-pill badge-secondary">lock</span>
                      @endif
                      @endif
                      <span class="badge badge-pill badge-warning">{{$post->nama_paket}}</span>
                      @endif
                      </div>

            </div>
            </div>
            <div class="card-body" style="padding-bottom: 0px;">
              @if(isset($post->statusmem) && isset($post->statuspaket))
              @if($post->statusmem == 0 && $post->statuspaket == 0 && $post->privilage != -1)

              <a href="{{url('1e71ac120240f553eed34209879fd6e7/'.$post->name)}}">
              @else
              <a href="{{ url('42b90196b487c54069097a68fe98ab6f/'.$post->id) }}">
              @endif
              @else
              <a href="{{ url('42b90196b487c54069097a68fe98ab6f/'.$post->id) }}">
              @endif

            <p class=" h2" >{{$post->title}}</p></a>

            @if($post->thumbnail != "")
            <ul  class="thumb1"  style="padding-left: 0px;">
            <li>
                <div class="overlay">
                  @if(isset($post->statusmem) && isset($post->statuspaket))
                  @if($post->statusmem == 0 && $post->statuspaket == 0 && $post->privilage != -1)
                  <a href="{{url('1e71ac120240f553eed34209879fd6e7/'.$post->name)}}">
                  @else
                  <a href="{{ url('42b90196b487c54069097a68fe98ab6f/'.$post->id) }}">
                  @endif
                  @else
                  <a href="{{ url('42b90196b487c54069097a68fe98ab6f/'.$post->id) }}">
                  @endif
                    <img class="thumbnail img-fluid rounded" src="{{ asset('storage/file/'.$post->thumbnail) }}"  alt=""></a>
                <span class="time"><i class="ni ni-book-bookmark    "></i></span>
                @if(isset($post->statusmem) && isset($post->statuspaket))
                @if($post->statusmem == 0 && $post->statuspaket == 0 && $post->privilage != -1)

                <a href="{{url('1e71ac120240f553eed34209879fd6e7/'.$post->name)}}" class="playWrapper">
                @else
                <a href="{{ url('42b90196b487c54069097a68fe98ab6f/'.$post->id) }}" class="playWrapper">
                @endif
                @else
                <a href="{{ url('42b90196b487c54069097a68fe98ab6f/'.$post->id) }}" class="playWrapper">
                @endif
                </a>
                </div>
            </li>
            </ul>
            @endif
            <p class="mb-2 "   id="justHtml" >

            <?php
            echo limit_text($post->caption, 30);
            ?>

            </p>
            <div class="row align-items-center my-3 pb-3  ">
                <div class="col-sm-6">
                <div class="icon-actions">
                @if(isset($post->iflikes))
               @if($post->iflikes = true)
                  <a onclick="unlikepost({{$post->id}})"  class="like  active postlikeindi{{$post->id}}">
                      <i class="ni ni-like-2"></i>
                      <span class="text-muted postlike{{$post->id}}"><?php echo ($post->like=='')?'0':$post->like;?></span>
                    </a>
                    @else
                  <a onclick="likepost({{$post->id}})"  class="like postlikeindi{{$post->id}}">
                      <i class="ni ni-like-2"></i>
                      <span class="text-muted postlike{{$post->id}}"><?php echo ($post->like=='')?'0':$post->like;?></span>
                    </a>
                  @endif
                  @else
                  <a onclick="likepost({{$post->id}})"  class="like postlikeindi{{$post->id}}"  >
                      <i class="ni ni-like-2"></i>
                      <span class="text-muted postlike{{$post->id}}"><?php echo ($post->like=='')?'0':$post->like;?></span>
                    </a>
                  @endif
                </div>
                </div>
                </div>

                </div>
                </div>
            @elseif($post->tipe == 2)
            <div class="card">
            <div class="card-header ">
            <div class="row align-items-center">


                    <div class="col">
                    <div class="d-flex align-items-center">
            @if($post->photo != "")
            <a href="{{ url($post->name) }}">
            <img src="{{ url('storage/file/pp/'.$post->photo) }}" class="avatar avatar-sm rounded-circle avatar-md">
            </a> @else
            <a href="{{ url($post->name) }}">
            <img src="../../assets/img/theme/team-1.png" class="avatar avatar-sm rounded-circle avatar-md">
            </a>
            @endif

                <div class="mx-3">
                <a href="{{ url($post->name) }}" class="text-dark font-weight-600 text-sm">{{$post->name}}</a>
                <small class="d-block text-muted"><?php echo time_elapsed_string($post->created_at)?></small>
                </div>

            </div>
                    </div>
                    <div class="col text-right">

                    @if($post->privilage == -1)
                    <span class="badge badge-pill badge-secondary">publik</span>
                    @elseif($post->privilage == -2)

                    @if(isset($post->statusmem) && isset($post->statuspaket))
                    @if($post->statusmem == 0 && $post->statuspaket == 0)

                    <span class="badge badge-pill badge-secondary">lock</span>
                    @endif
                    @endif
                    <span class="badge badge-pill badge-primary">pendukung</span>
                    @else
                    @if(isset($post->statusmem) && isset($post->statuspaket))
                    @if($post->statusmem == 0 && $post->statuspaket == 0)

                    <span class="badge badge-pill badge-secondary">lock</span>
                    @endif
                    @endif
                    <span class="badge badge-pill badge-warning">{{$post->nama_paket}}</span>
                    @endif
                    </div>

            </div>
            </div>
            <div class="card-body" style="padding-bottom: 0px;">

              @if(isset($post->statusmem) && isset($post->statuspaket))
              @if($post->statusmem == 0 && $post->statuspaket == 0 && $post->privilage != -1)

              <a href="{{url('1e71ac120240f553eed34209879fd6e7/'.$post->name)}}">
              @else
              <a href="{{ url('42b90196b487c54069097a68fe98ab6f/'.$post->id) }}">
              @endif
              @else
              <a href="{{ url('42b90196b487c54069097a68fe98ab6f/'.$post->id) }}">
              @endif

            <p class=" h2" >{{$post->title}}</p></a>

            @if($post->thumbnail != "")
            <ul class="thumb1" style="padding-left: 0px;">
            <li>
                <div class="overlay">
                  @if(isset($post->statusmem) && isset($post->statuspaket))
                  @if($post->statusmem == 0 && $post->statuspaket == 0 && $post->privilage != -1)

                  <a href="{{url('1e71ac120240f553eed34209879fd6e7/'.$post->name)}}">
                  @else
                  <a href="{{ url('42b90196b487c54069097a68fe98ab6f/'.$post->id) }}">
                  @endif
                  @else
                  <a href="{{ url('42b90196b487c54069097a68fe98ab6f/'.$post->id) }}">
                  @endif
                    <img class="thumbnail img-fluid rounded" src="{{ asset('storage/file/'.$post->thumbnail) }}"  alt=""></a>
                <span class="time"><i class="ni ni-camera-compact"></i></span>
                @if(isset($post->statusmem) && isset($post->statuspaket))
                @if($post->statusmem == 0 && $post->statuspaket == 0 && $post->privilage != -1)

                <a href="{{url('1e71ac120240f553eed34209879fd6e7/'.$post->name)}}" class="playWrapper">
                @else
                <a href="{{ url('42b90196b487c54069097a68fe98ab6f/'.$post->id) }}" class="playWrapper">
                @endif
                @else
                <a href="{{ url('42b90196b487c54069097a68fe98ab6f/'.$post->id) }}" class="playWrapper">
                @endif
                </a>
                </div>
            </li>
            </ul>
            @endif
            <p class="mb-2 "   id="justHtml" >

            <?php
            echo limit_text($post->caption, 30);
            ?>
            </p>
            <div class="row align-items-center my-3 pb-3  ">
                <div class="col-sm-6">
                <div class="icon-actions">
                @if(isset($post->iflikes))
               @if($post->iflikes = true)
                  <a onclick="unlikepost({{$post->id}})"  class="like  active postlikeindi{{$post->id}}">
                      <i class="ni ni-like-2"></i>
                      <span class="text-muted postlike{{$post->id}}"><?php echo ($post->like=='')?'0':$post->like;?></span>
                    </a>
                    @else
                  <a onclick="likepost({{$post->id}})"  class="like postlikeindi{{$post->id}}">
                      <i class="ni ni-like-2"></i>
                      <span class="text-muted postlike{{$post->id}}"><?php echo ($post->like=='')?'0':$post->like;?></span>
                    </a>
                  @endif
                  @else
                  <a onclick="likepost({{$post->id}})"  class="like postlikeindi{{$post->id}}"  >
                      <i class="ni ni-like-2"></i>
                      <span class="text-muted postlike{{$post->id}}"><?php echo ($post->like=='')?'0':$post->like;?></span>
                    </a>
                  @endif
                </div>
                </div>
                </div>

                </div>
                </div>
                @elseif($post->tipe == 3)
            <div class="card">
            <div class="card-header ">
            <div class="row align-items-center">


                    <div class="col">
                    <div class="d-flex align-items-center">
            @if($post->photo != "")
            <a href="{{ url($post->name) }}">
            <img src="{{ url('storage/file/pp/'.$post->photo) }}" class="avatar avatar-sm rounded-circle avatar-md">
            </a> @else
            <a href="{{ url($post->name) }}">
            <img src="../../assets/img/theme/team-1.png" class="avatar avatar-sm rounded-circle avatar-md">
            </a>
            @endif

                <div class="mx-3">
                <a href="{{ url($post->name) }}" class="text-dark font-weight-600 text-sm">{{$post->name}}</a>
                <small class="d-block text-muted"><?php echo time_elapsed_string($post->created_at)?></small>
                </div>

            </div>
                    </div>
                    <div class="col text-right">  @if($post->privilage == -1)
                      <span class="badge badge-pill badge-secondary">publik</span>
                      @elseif($post->privilage == -2)

                      @if(isset($post->statusmem) && isset($post->statuspaket))
                      @if($post->statusmem == 0 && $post->statuspaket == 0)
                      <span class="badge badge-pill badge-secondary">lock</span>
                      @endif
                      @endif
                      <span class="badge badge-pill badge-primary">pendukung</span>
                      @else
                      @if(isset($post->statusmem) && isset($post->statuspaket))
                      @if($post->statusmem == 0 && $post->statuspaket == 0)
                      <span class="badge badge-pill badge-secondary">lock</span>
                      @endif
                      @endif
                      <span class="badge badge-pill badge-warning">{{$post->nama_paket}}</span>
                      @endif
                      </div>

            </div>
            </div>
            <div class="card-body" style="padding-bottom: 0px;">

              @if(isset($post->statusmem) && isset($post->statuspaket))
              @if($post->statusmem == 0 && $post->statuspaket == 0 && $post->privilage != -1)

              <a href="{{url('1e71ac120240f553eed34209879fd6e7/'.$post->name)}}">
              @else
              <a href="{{ url('42b90196b487c54069097a68fe98ab6f/'.$post->id) }}">
              @endif
              @else
              <a href="{{ url('42b90196b487c54069097a68fe98ab6f/'.$post->id) }}">
              @endif

            <p class=" h2" >{{$post->title}}</p></a>


            @if($post->thumbnail != "")
            <ul class="thumb" style="padding-left: 0px;">
            <li>
                <div class="overlay">
                  @if(isset($post->statusmem) && isset($post->statuspaket))
                  @if($post->statusmem == 0 && $post->statuspaket == 0 && $post->privilage != -1)

                  <a href="{{url('1e71ac120240f553eed34209879fd6e7/'.$post->name)}}">
                  @else
                  <a href="{{ url('42b90196b487c54069097a68fe98ab6f/'.$post->id) }}">
                  @endif
                  @else
                  <a href="{{ url('42b90196b487c54069097a68fe98ab6f/'.$post->id) }}">
                  @endif

                    <img class="thumbnail img-fluid rounded" src="{{ asset('storage/file/'.$post->thumbnail) }}"  alt=""></a>
                <span class="time"><i class="fa fa-play"></i></span>
                @if(isset($post->statusmem) && isset($post->statuspaket))
                @if($post->statusmem == 0 && $post->statuspaket == 0 && $post->privilage != -1)

                <a href="{{url('1e71ac120240f553eed34209879fd6e7/'.$post->name)}}" class="playWrapper">
                @else
                <a href="{{ url('42b90196b487c54069097a68fe98ab6f/'.$post->id) }}" class="playWrapper">
                @endif
                @else
                <a href="{{ url('42b90196b487c54069097a68fe98ab6f/'.$post->id) }}" class="playWrapper">
                @endif
                </a>
                </div>
            </li>
            </ul>
            @endif
            <p class="mb-2 "   id="justHtml" >
            <?php
            echo limit_text($post->caption, 30);
            ?>


            </p>
            <div class="row align-items-center my-3 pb-3  ">
                <div class="col-sm-6">
                <div class="icon-actions">
                @if(isset($post->iflikes))
               @if($post->iflikes = true)
                  <a onclick="unlikepost({{$post->id}})"  class="like  active postlikeindi{{$post->id}}">
                      <i class="ni ni-like-2"></i>
                      <span class="text-muted postlike{{$post->id}}"><?php echo ($post->like=='')?'0':$post->like;?></span>
                    </a>
                    @else
                  <a onclick="likepost({{$post->id}})"  class="like postlikeindi{{$post->id}}">
                      <i class="ni ni-like-2"></i>
                      <span class="text-muted postlike{{$post->id}}"><?php echo ($post->like=='')?'0':$post->like;?></span>
                    </a>
                  @endif
                  @else
                  <a onclick="likepost({{$post->id}})"  class="like postlikeindi{{$post->id}}"  >
                      <i class="ni ni-like-2"></i>
                      <span class="text-muted postlike{{$post->id}}"><?php echo ($post->like=='')?'0':$post->like;?></span>
                    </a>
                  @endif
                </div>
                </div>
                </div>

                </div>
                </div>
                @elseif($post->tipe == 4)
            <div class="card">
            <div class="card-header ">
            <div class="row align-items-center">


                    <div class="col">
                    <div class="d-flex align-items-center">
            @if($post->photo != "")
            <a href="{{ url($post->name) }}">
            <img src="{{ url('storage/file/pp/'.$post->photo) }}" class="avatar avatar-sm rounded-circle avatar-md">
            </a> @else
            <a href="{{ url($post->name) }}">
            <img src="../../assets/img/theme/team-1.png" class="avatar avatar-sm rounded-circle avatar-md">
            </a>
            @endif

                <div class="mx-3">
                <a href="{{ url($post->name) }}" class="text-dark font-weight-600 text-sm">{{$post->name}}</a>
                <small class="d-block text-muted"><?php echo time_elapsed_string($post->created_at)?></small>
                </div>

            </div>
                    </div>
                    <div class="col text-right">  @if($post->privilage == -1)
                      <span class="badge badge-pill badge-secondary">publik</span>
                      @elseif($post->privilage == -2)
                      @if(isset($post->statusmem) && isset($post->statuspaket))
                      @if($post->statusmem == 0 && $post->statuspaket == 0)
                      <span class="badge badge-pill badge-secondary">lock</span>
                      @endif
                      @endif
                      <span class="badge badge-pill badge-primary">pendukung</span>
                      @else
                      @if(isset($post->statusmem) && isset($post->statuspaket))
                      @if($post->statusmem == 0 && $post->statuspaket == 0)
                      <span class="badge badge-pill badge-secondary">lock</span>
                      @endif
                      @endif
                      <span class="badge badge-pill badge-warning">{{$post->nama_paket}}</span>
                      @endif
                      </div>

            </div>
            </div>
            <div class="card-body" style="padding-bottom: 0px;">

            <div class="row" >
                <div class="col-5">
                @if($post->thumbnail != "")
            <ul class="thumb1" style="padding-left: 0px;">
            <li>
                <div class="overlay">
                  @if(isset($post->statusmem) && isset($post->statuspaket))
                  @if($post->statusmem == 0 && $post->statuspaket == 0 && $post->privilage != -1)

                  <a href="{{url('1e71ac120240f553eed34209879fd6e7/'.$post->name)}}">
                  @else
                  <a href="{{ url('42b90196b487c54069097a68fe98ab6f/'.$post->id) }}">
                  @endif
                  @else
                  <a href="{{ url('42b90196b487c54069097a68fe98ab6f/'.$post->id) }}">
                  @endif
                    <img class="thumbnail img-fluid rounded" src="{{ asset('storage/file/'.$post->thumbnail) }}"  alt=""></a>
                <span class="time"><i class="fa fa-headphones"></i></span>
                @if(isset($post->statusmem) && isset($post->statuspaket))
                @if($post->statusmem == 0 && $post->statuspaket == 0 && $post->privilage != -1)

                <a href="{{url('1e71ac120240f553eed34209879fd6e7/'.$post->name)}}" class="playWrapper">
                @else
                <a href="{{ url('42b90196b487c54069097a68fe98ab6f/'.$post->id) }}" class="playWrapper">
                @endif
                @else
                <a href="{{ url('42b90196b487c54069097a68fe98ab6f/'.$post->id) }}" class="playWrapper">
                @endif
                </a>
                </div>
            </li>
            </ul>
            @endif
                </div>
                <div class="col-7">
                  @if(isset($post->statusmem) && isset($post->statuspaket))
                  @if($post->statusmem == 0 && $post->statuspaket == 0 && $post->privilage != -1)

                  <a href="{{url('1e71ac120240f553eed34209879fd6e7/'.$post->name)}}">
                  @else
                  <a href="{{ url('42b90196b487c54069097a68fe98ab6f/'.$post->id) }}">
                  @endif
                  @else
                  <a href="{{ url('42b90196b487c54069097a68fe98ab6f/'.$post->id) }}">
                  @endif

                <h3 class="card-title text-default">{{$post->title}}</h3></a>

            </div>

          </div>


            <p class="mb-2 "   id="justHtml" >

            <?php
            echo limit_text($post->caption, 30);
            ?>


            </p>
            <div class="row align-items-center my-3 pb-3  ">
                <div class="col-sm-6">
                <div class="icon-actions">
                @if(isset($post->iflikes))
               @if($post->iflikes = true)
                  <a onclick="unlikepost({{$post->id}})"  class="like  active postlikeindi{{$post->id}}">
                      <i class="ni ni-like-2"></i>
                      <span class="text-muted postlike{{$post->id}}"><?php echo ($post->like=='')?'0':$post->like;?></span>
                    </a>
                    @else
                  <a onclick="likepost({{$post->id}})"  class="like postlikeindi{{$post->id}}">
                      <i class="ni ni-like-2"></i>
                      <span class="text-muted postlike{{$post->id}}"><?php echo ($post->like=='')?'0':$post->like;?></span>
                    </a>
                  @endif
                  @else
                  <a onclick="likepost({{$post->id}})"  class="like postlikeindi{{$post->id}}"  >
                      <i class="ni ni-like-2"></i>
                      <span class="text-muted postlike{{$post->id}}"><?php echo ($post->like=='')?'0':$post->like;?></span>
                    </a>
                  @endif
                </div>
                </div>
                </div>

                </div>
                </div>
            @endif

            @endforeach
            @else
            <div class="row justify-item-center mx-1">
            <div class="col-12">
            <img class="thumbnail img-fluid rounded" width="300px" src="{{ asset('assets/img/empty1.png') }}"  alt="">

            </div>
            <div class="col-12 text-center">
            <p class="text-muted"><span class="h3 text-muted">sorry nih...</span><br>belum ada postingan keren</p>

            </div>
            </div>
            @endif
            @if($data)
            <div class="row justify-content-md-center">
            {{ $data->links() }}
            </div>
            @endif
            </div>

        </div>
        @endforeach
        </div>
    <script src="{{ asset('assets/vendor/jquery/dist/jquery.min.js') }}"></script>

        <script>
$(document).ready(function(){
	var maxLength = 300;
	$(".show-read-more").each(function(){
		var myStr = $(this).text();
		if($.trim(myStr).length > maxLength){
			var newStr = myStr.substring(0, maxLength);
			var removedStr = myStr.substring(maxLength, $.trim(myStr).length);
			$(this).empty().html(newStr);
			$(this).append(' <a href="javascript:void(0);" class="read-more">read more...</a>');
			$(this).append('<span class="more-text">' + removedStr + '</span>');
		}
	});
	$(".read-more").click(function(){
		$(this).siblings(".more-text").contents().unwrap();
		$(this).remove();
	});
});

function paket(nu) {

}
</script>
@endsection
