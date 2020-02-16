@extends('layouts.app')

@section('title','User Home')

@section('content')
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
            $result1 = limit_text($result, 50);
        } catch (\Exception $e) {
            // echo "cok";
        }

        return $result1;
    }

    function limit_text($text, $limit) {
        if (str_word_count($text, 0) > $limit) {
            $words = str_word_count($text, 2);
            $pos = array_keys($words);
            $text = substr($text, 0, $pos[$limit]) . '...';
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
    <!-- Header -->
    @if(isset($user))
    @foreach ($user as $kreator)
    @if(isset($kreator->cover))
    <div class="header d-flex align-items-center" style="min-height: 368px; background-image: url('{{ url('storage/file/pp/'.$kreator->cover) }}'); background-size: cover; background-position: center;"></div>
    @else
    <div class="header  d-flex align-items-center" style="min-height: 368px; background-image: url(../../assets/img/theme/profile-cover.png); background-size: cover; background-position: center;"></div>
    @endif


    @endforeach
    @endif
    <!-- <div class="header  bg-gradient-warning pb-6 d-flex align-items-center" style="min-height: 100px;">
    </div> -->
    <!-- Page content -->
    <div class="container-fluid" style="margin-top: -300px;">
        <div class="row justify-content-center">

        <div class="col-xl-3  order-xl-1 d-none d-lg-block">
        @foreach ($user as $users)

            <div class="card card-profile">
            <div class="card">
            <!-- Card header -->
            <div class="card-header">
                <!-- Title -->
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="mb-0">dukungan</h3>
                    </div>
                    <div class="col text-right">
                    <a href="{{url('b84dc340d0bd103ac5a157ce6387ee21/')}}" class="btn btn-sm btn-outline-primary">lihat</a>

                    </div>
                </div>
            </div>
            <!-- Card body -->
            <div class="card-body " >
                <!-- List group -->
                <ul class="list-group list-group-flush list my--3">
                @if(count($member) > 0)
            @foreach ($member as $follows)
                <li class="list-group-item ">
                    <div class="row align-items-center">
                    <div class="col-auto">
                        <!-- Avatar -->
                        @if($follows->photo != "")
                        <a href="{{ url($follows->name) }}">
                        <img src="{{ url('storage/file/pp/'.$follows->photo) }}" class="avatar avatar-xs rounded-circle avatar-md">
                        </a> @else
                        <a href="{{ url($follows->name) }}">
                        <img src="../../assets/img/theme/team-1.png" class="avatar avatar-xs rounded-circle avatar-md">
                        </a>
                        @endif
                    </div>
                    <div class="col">
                    <a href="{{ url($follows->name) }}">


                        <h4 class="mb-0">
                            <a href="#!">{{$follows->name}}</a>
                        </h4>
                        </a>
                        <p class="text-sm text-muted mb-0">selesai dalam <?php echo tenggatwaktu($follows->tenggatwaktu)?></p>
                    </div>
                    </div>
                </li>
                @endforeach
                @else
            <div class="row justify-item-center mx-1">
            <div class="col-12">
            <img class="thumbnail img-fluid rounded" width="100px" src="{{ asset('assets/img/empty3.png') }}"  alt="">

            </div>
            <div class="col-12 text-center">
            <p class="text-muted"><span class="h3 text-muted">sorry nih...</span><br>anda belum terhubung dengan creator manapun</p>

            </div>
            </div>
                @endif

                </ul>

            </div>

            </div>
            </div>
            <div class="card card-profile">

            <div class="card">
            <!-- Card header -->
            <div class="card-header">
                <!-- Title -->
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="mb-0">diikuti</h3>
                    </div>
                    <div class="col text-right">
                        <a href="{{url('6d2f2f9fc3eb0b0d0ebf36653ad7015e/')}}" class="btn btn-sm btn-outline-primary">lihat</a>
                    </div>
                </div>
            </div>
            <!-- Card body -->
            <div class="card-body" >
                <!-- List group -->
                <ul class="list-group list-group-flush list my--3">
                @if(count($follow) > 0)
            @foreach ($follow as $follows)
                <li class="list-group-item px-0">
                    <div class="row align-items-center">
                    <div class="col-auto">
                        <!-- Avatar -->
                        @if($follows->photo != "")
                        <a href="{{ url($follows->name) }}">
                        <img src="{{ url('storage/file/pp/'.$follows->photo) }}" class="avatar avatar-xs rounded-circle avatar-md">
                        </a> @else
                        <a href="{{ url($follows->name) }}">
                        <img src="../../assets/img/theme/team-1.png" class="avatar avatar-xs rounded-circle avatar-md">
                        </a>
                        @endif
                    </div>
                    <div class="col">
                    <a href="{{ url($follows->name) }}">

                        <h5>{{$follows->name}}</h5>
                        </a>
                    </div>
                    </div>
                </li>
                @endforeach
                @else
            <div class="row justify-item-center mx-1">
            <div class="col-12">
            <img class="thumbnail img-fluid rounded" width="100px"  src="{{ asset('assets/img/empty2.png') }}"  alt="">

            </div>
            <div class="col-12 text-center">
            <p class="text-muted"><span class="h3 text-muted">sorry nih...</span><br>anda belum ngikutin kreator sama sekali</p>

            </div>
            </div>
                @endif

                </ul>
            </div>
            </div>
            </div>
            @endforeach
            <!-- Progress track -->

        </div>


        <div class="col-xl-7 order-xl-2">
            <div class="row">

            </div>

            <div class="card">
            <div class="card-header">
            <h5 class="h3 mb-0">postingan terbaru</h5>
            </div>

            @if(count($data) > 0)
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
                    <span class="badge badge-pill badge-primary">pendukung</span>
                    @else
                    <span class="badge badge-pill badge-warning">paket</span>
                    @endif
                    </div>

            </div>
            </div>
            <div class="card-body" style="padding-bottom: 0px;">
            <p class=" h2" >{{$post->title}}</p>
            @if($post->thumbnail != "")
            <ul  class="thumb1"  style="padding-left: 0px;">
            <li>
                <div class="overlay">
                <a href="{{ url('42b90196b487c54069097a68fe98ab6f/'.$post->id) }}">
                    <img class="thumbnail img-fluid rounded" src="{{ asset('storage/file/'.$post->thumbnail) }}"  alt=""></a>
                <span class="time"><i class="ni ni-book-bookmark    "></i></span>
                <a href="{{ url('42b90196b487c54069097a68fe98ab6f/'.$post->id) }}" class="playWrapper">
                </a>
                </div>
            </li>
            </ul>
            @endif
            <p class="mb-2 "   id="justHtml" >

            <!-- {{$post->caption}} -->
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
                    <span class="badge badge-pill badge-primary">pendukung</span>
                    @else
                    <span class="badge badge-pill badge-warning">paket</span>
                    @endif
                    </div>

            </div>
            </div>
            <div class="card-body" style="padding-bottom: 0px;">

            <p class=" h2" >{{$post->title}}</p>
            <?php
            // echo FunctionName($post->desc);
            ?>
            @if($post->thumbnail != "")
            <ul class="thumb1" style="padding-left: 0px;">
            <li>
                <div class="overlay">
                <a href="{{ url('42b90196b487c54069097a68fe98ab6f/'.$post->id) }}">
                    <img class="thumbnail img-fluid rounded" src="{{ asset('storage/file/'.$post->thumbnail) }}"  alt=""></a>
                <span class="time"><i class="ni ni-camera-compact"></i></span>
                <a href="{{ url('42b90196b487c54069097a68fe98ab6f/'.$post->id) }}" class="playWrapper">
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
                    <div class="col text-right">
                    @if($post->privilage == -1)
                    <span class="badge badge-pill badge-secondary">publik</span>
                    @elseif($post->privilage == -2)
                    <span class="badge badge-pill badge-primary">pendukung</span>
                    @else
                    <span class="badge badge-pill badge-warning">paket</span>
                    @endif
                    </div>

            </div>
            </div>
            <div class="card-body" style="padding-bottom: 0px;">

            <p class=" h2" >{{$post->title}}</p>



            @if($post->thumbnail != "")
            <ul class="thumb" style="padding-left: 0px;">
            <li>
                <div class="overlay">
                <a href="#">
                    <img class="thumbnail img-fluid rounded" src="{{ asset('storage/file/'.$post->thumbnail) }}"  alt=""></a>
                <span class="time"><i class="fa fa-play"></i></span>
                <a href="{{ url('42b90196b487c54069097a68fe98ab6f/'.$post->id) }}" class="playWrapper">
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
                    <div class="col text-right">
                    @if($post->privilage == -1)
                    <span class="badge badge-pill badge-secondary">publik</span>
                    @elseif($post->privilage == -2)
                    <span class="badge badge-pill badge-primary">pendukung</span>
                    @else
                    <span class="badge badge-pill badge-warning">paket</span>
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
                <a href="{{ url('42b90196b487c54069097a68fe98ab6f/'.$post->id) }}">
                    <img class="thumbnail img-fluid rounded" src="{{ asset('storage/file/'.$post->thumbnail) }}"  alt=""></a>
                <span class="time"><i class="fa fa-headphones"></i></span>
                <a href="{{ url('42b90196b487c54069097a68fe98ab6f/'.$post->id) }}" class="playWrapper">
                </a>
                </div>
            </li>
            </ul>
            @endif
                </div>
                <div class="col-7">
              <h3 class="card-title text-default">{{$post->title}}</h3>

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
            <p class="text-muted"><span class="h3 text-muted">sorry nih...</span><br>anda belum memiliki postingan terbaru</p>

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
        </div>


    <!-- Argon Scripts -->
    <!-- Core -->

@endsection
