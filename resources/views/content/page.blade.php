
@extends('layouts.app')

@section('title','Buataja - platform dukungan kreator')

@section('content')

<?php
 function FunctionName($data)
 {
     try {
         $quill = new \DBlackborough\Quill\Render($data);
         $result = $quill->render();
     } catch (\Exception $e) {
         echo $e->getMessage();
     }

     return $result;
 }
function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}
?>
    <div class="header bg-warning pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">

          </div>
          <div class="row">
          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
    @if(count($data) > 0)
    @foreach ($data as $post)
    @if($post->tipe == 1)
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-7">
        <div class="card">
            <div class="card-header d-flex align-items-center">
              <div class="d-flex align-items-center">
              @if($post->photo != "")
            <a href="#">
            <img src="{{ url('storage/file/pp/'.$post->photo) }}" class="avatar avatar-md">
            </a> @else
            <a href="#">
            <img src="../../assets/img/theme/team-1.png" class="avatar avatar-md">
            </a>
            @endif
                <div class="mx-3">
                  <a href="#" class="text-dark font-weight-600 text-sm">{{$post->name}}</a>
                  <small class="d-block text-muted"><?php echo time_elapsed_string($post->created_at)?></small>
                </div>
              </div>
            </div>
            <div class="card-body">
            <p class=" h1" >{{$post->title}}</p>

            @if($post->thumbnail != "")
                    <img class="thumbnail img-fluid image-xxl rounded" src="{{ asset('storage/file/'.$post->thumbnail) }}"  alt="">
            @endif
            <br>
            <p class="mb-2 "   id="justHtml" >
            <div class="tentang">
            <?php
            echo FunctionName($post->desc);
            ?>
            </div>

            </p><br>
            <br>
            <br>
            <br>
            <div class="row align-items-center my-3 pb-3 border-bottom">
                <div class="col-sm-6">
                  <div class="icon-actions">
                  @if($likes == true)
                  <a href="{{url('unlikepost/'.$post->id)}}" class="like active">
                      <i class="ni ni-like-2"></i>
                      <span class="text-muted">{{$post->like}}</span>
                    </a>
                  @else
                  <a href="{{url('likepost/'.$post->id)}}" class="like">
                      <i class="ni ni-like-2"></i>
                      <span class="text-muted">{{$post->like}}</span>
                    </a>
                  @endif

                    <a href="#">
                      <i class="ni ni-chat-round"></i>
                      <span class="text-muted">36</span>
                    </a>
                  </div>
                </div>

              </div>
    @elseif($post->tipe == 2)
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-7">
        <div class="card">
            <div class="card-header d-flex align-items-center">
              <div class="d-flex align-items-center">
              @if($post->photo != "")
            <a href="#">
            <img src="{{ url('storage/file/pp/'.$post->photo) }}" class="avatar avatar-md">
            </a> @else
            <a href="#">
            <img src="../../assets/img/theme/team-1.png" class="avatar avatar-md">
            </a>

            @endif

                <div class="mx-3">
                  <a href="#" class="text-dark font-weight-600 text-sm">{{$post->name}}</a>
                  <small class="d-block text-muted"><?php echo time_elapsed_string($post->created_at)?></small>
                </div>
              </div>
            </div>
            <div class="card-body pl-lg-5 pr-lg-5 pr-sm-0 pl-sm-0">

            <div class="row">
              <!-- <div class="col-3">
              @if($post->thumbnail != "")
                    <img class="thumbnail rounded"  width="150" height="150" src="{{ asset('storage/file/'.$post->thumbnail) }}"  alt="">
              @endif
              </div> -->
              <div class="col-12 ml-lg--4">
              <p class="display-3" style="max-width: -moz-available;">


            {{$post->title}}

            </p><span class="font-weight-400 text-sm  " >
            {{$post->caption}}
          </span>
              </div>
            </div>


            <hr>
            <p class="mb-2 "   id="justHtml" >

            <?php
            $arr = explode(",", $post->file);
            ?>
    @foreach ($arr as $image)
    <img class="img-fluid" width="600" height="100" src="{{ asset('storage/file/'.$image) }}"  alt="">
    @endforeach
            </p>
            <br>
    <br>
    <br>
    <br>
            <div class="row align-items-center my-3 pb-3 border-bottom">
                <div class="col-sm-6">
                  <div class="icon-actions">
                    <a href="{{url('likepost/'.$post->id)}}" class="like active">
                      <i class="ni ni-like-2"></i>
                      <span class="text-muted">150</span>
                    </a>
                    <a href="#">
                      <i class="ni ni-chat-round"></i>
                      <span class="text-muted">36</span>
                    </a>
                  </div>
                </div>

              </div>
    @elseif($post->tipe == 3)
   <div class="row justify-content-center">
        <div class="col-lg-8 col-md-7">
        <div class="card">
            <div class="card-header d-flex align-items-center">
              <div class="d-flex align-items-center">
              @if($post->photo != "")
            <a href="#">
            <img src="{{ url('storage/file/pp/'.$post->photo) }}" class="avatar avatar-md">
            </a> @else
            <a href="#">
            <img src="../../assets/img/theme/team-1.png" class="avatar avatar-md">
            </a>
            @endif
                <div class="mx-3">
                  <a href="#" class="text-dark font-weight-600 text-sm">{{$post->name}}</a>
                  <small class="d-block text-muted"><?php echo time_elapsed_string($post->created_at)?></small>
                </div>
              </div>
            </div>
            <div class="card-body pl-lg-5 pr-lg-5 pr-sm-0 pl-sm-0">
            <p class=" h1" >{{$post->title}}</p>

            <!-- <video controls crossorigin playsinline poster="{{ asset('storage/file/'.$post->thumbnail) }}">
		  <source src="{{ asset('storage/file/'.$post->file) }}" type="video/mp4">
  </video> -->
   <br>
   <div class="tentang">
            <?php
            echo FunctionName($post->desc);
            ?>
            </div>
    <br>
    <br>
            <div class="row align-items-center my-3 pb-3 border-bottom">
                <div class="col-sm-6">
                  <div class="icon-actions">
                    <a href="{{url('likepost/'.$post->id)}}" class="like active">
                      <i class="ni ni-like-2"></i>
                      <span class="text-muted">150</span>
                    </a>
                    <a href="#">
                      <i class="ni ni-chat-round"></i>
                      <span class="text-muted">36</span>
                    </a>
                  </div>
                </div>

              </div>
    @elseif($post->tipe == 4)
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-7">
        <div class="card">
            <div class="card-header d-flex align-items-center">
              <div class="d-flex align-items-center">
              @if($post->photo != "")
            <a href="#">
            <img src="{{ url('storage/file/pp/'.$post->photo) }}" class="avatar avatar-md">
            </a> @else
            <a href="#">
            <img src="../../assets/img/theme/team-1.png" class="avatar avatar-md">
            </a>
            @endif
                <div class="mx-3">
                  <a href="#" class="text-dark font-weight-600 text-sm">{{$post->name}}</a>
                  <small class="d-block text-muted"><?php echo time_elapsed_string($post->created_at)?></small>
                </div>
              </div>
            </div>
            <div class="card-body">

            <p class=" h1" >{{$post->title}}</p>

            @if($post->thumbnail != "")
                    <img class="thumbnail img-fluid image-xxl rounded" src="{{ asset('storage/file/'.$post->thumbnail) }}"  alt="">
            @endif
            <br>
            <div style="width: 750px;display: block;margin: auto;">
            <audio id="player"  controls>
              <source src="{{ asset('storage/file/'.$post->file) }}" type="audio/mp3" />
           </audio>
            </div>

            <br>
            <div class="tentang">
            <?php
            echo FunctionName($post->desc);
            ?>
            </div>
    <br>
    <br>
    <br>
            <!-- <div class="row align-items-center my-3 pb-3 border-bottom">
                <div class="col-sm-6">
                  <div class="icon-actions">
                    <a href="{{url('likepost/'.$post->id)}}" class="like active">
                      <i class="ni ni-like-2"></i>
                      <span class="text-muted">150</span>
                    </a>
                    <a href="#">
                      <i class="ni ni-chat-round"></i>
                      <span class="text-muted">36</span>
                    </a>
                  </div>
                </div>

              </div> -->
    @endif
    @endforeach
    @endif

    @if($data != "")
    @foreach ($data as $post)

              <!-- Comments -->
              <!-- <div class="mb-1">
                <div class="media media-comment">
                  <img alt="Image placeholder" class="avatar avatar-md media-comment-avatar rounded-circle" src="../../assets/img/theme/team-1.png">
                  <div class="media-body">
                    <div class="media-comment-text">
                      <h6 class="h5 mt-0">Michael Lewis</h6>
                      <p class="text-sm lh-160">Cras sit amet nibh libero nulla vel metus scelerisque ante sollicitudin. Cras purus odio vestibulum in vulputate viverra turpis.</p>
                      <div class="icon-actions">
                        <a href="#" class="like active">
                          <i class="ni ni-like-2"></i>
                          <span class="text-muted">3 likes</span>
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="media media-comment">
                  <img alt="Image placeholder" class="avatar avatar-md media-comment-avatar rounded-circle" src="../../assets/img/theme/team-1.png">
                  <div class="media-body">
                    <div class="media-comment-text">
                      <h6 class="h5 mt-0">Jessica Stones</h6>
                      <p class="text-sm lh-160">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis.</p>
                      <div class="icon-actions">
                        <a href="#" class="like active">
                          <i class="ni ni-like-2"></i>
                          <span class="text-muted">10 likes</span>
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
                <hr />
                <div class="media align-items-center">
                <div class="media-body">
                    <form action="/comment/{{$post->id}}" method="post"  enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="row">
                    <div class="col-lg-9 col-sm-12 mb-2" >
                    <input class="form-control" type="text" name="comment" placeholder="Write your comment" id="comment" required>
                    </div>
                    <div class="col-lg-3 col-sm-12">
                    <button type="submit"  class="form-control btn btn-primary text-sm" >komentar</button>

                      </div>
                    </div>
                    </form>
                  </div>
                </div>
              </div> -->
            </div>
          </div>
        </div>
        </div>


@endforeach

@endif
<script src="https://cdn.plyr.io/3.5.6/plyr.js"></script>
 <script>

 // Change the second argument to your options:
// https://github.com/sampotts/plyr/#options
const player = new Plyr('video', {
    quality: { default: 576, options: [4320, 2880, 2160, 1440, 1080, 720, 576, 480, 360, 240] }
    });

    const playera = new Plyr('audio');

// Expose player so it can be used from the console
window.player = player;
window.player = playera;

 </script>

 @endsection
