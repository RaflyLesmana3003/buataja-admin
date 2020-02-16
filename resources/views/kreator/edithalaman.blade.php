@extends('layouts.app') @section('title','edit kreator') @section('content')
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
function limit_text($text, $limit) {
    if (str_word_count($text, 0) > $limit) {
        $words = str_word_count($text, 2);
        $pos = array_keys($words);
        $text = substr($text, 0, $pos[$limit]) . '...';
    }
    return $text;
  }
?>
<script>
    function readURL(input, target) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#pp1')
                    .attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

<div class="modal fade" id="modal-pendapatan" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-body p-0">

                <div class="card bg-secondary shadow border-0">
                    <div class="card-body px-lg-5 py-lg-5">
                        <div class="text-center text-muted mb-4">
                            tambah target pendapatan
                        </div>
                        <hr>
                        <div class="form-group">
                            <label class="form-control-label" for="validationCustom01">target</label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><small class="font-weight-bold">USD</small></span>
                                </div>
                                <input class="form-control" placeholder="Payment method" type="text">
                            </div>
                            <label class="form-control-label" for="formatter">postingan anda</label>
                            <form>
                                <div data-toggle="quill1" data-quill-placeholder="pada hari minggu itu"></div>
                            </form>
                        </div>
                        <div class="text-center">
                            <a href="#" class="btn btn-primary">tambah</a>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>
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
                    <input type="hidden" id="idpaket">
                    <div class="py-3 text-center">
                        <i class="ni ni-bell-55 ni-3x"></i>
                        <h4 class="heading mt-4" id="title">You should read this!</h4>
                        <p>paket ini akan dihapus dan mungkin tidak bisa di kembalikan lagi.</p>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">gajadi</button>
                    <button type="button" class="btn btn-link text-white ml-auto" onclick="hapuspaket()">ya</button>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- Header -->
@if(count($data) > 0) @foreach ($data as $kreator) @if($kreator->cover != "")
<div class="header pb-6 d-flex align-items-center" style="min-height: 368px; background-image: url('{{ url('storage/file/pp/'.$kreator->cover) }}'); background-size: cover; background-position: center;"></div>
@else
<div class="header pb-6 d-flex align-items-center" style="min-height: 368px; background-image: url(../../assets/img/theme/profile-cover2.png); background-size: cover; background-position: center;"></div>
@endif @endforeach @endif

<!-- Page content -->
<div class="container-fluid mt--6">
    <div class="row justify-content-md-center">
        <div class="col-xl-8 order-xl-1 mt--6">
            <!-- Progress track -->
            <div class="card" style="border-radius: 25px;">
                <!-- Card header -->
                <div class="card-header">
                    <!-- Title -->
                    <button type="button" class="btn btn-sm btn-primary" id="btn1" onclick="page(1,1)">profil</button>
                    @if(count($data) > 0) @foreach ($data as $kreator) @if($kreator->level == 1)
                    <button type="button" class="btn btn-sm btn-outline-primary" id="btn2" onclick="page(2,2)">paket</button>
                    <!-- <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-outline-primary dropdown-toggle" id="btn3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">pencapaian</button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#" onclick="page(3,3)">pendapatan</a>
                            <a class="dropdown-item" href="#" onclick="page(4,4)">membership</a>
                        </div>
                    </div> -->
                    @endif @endforeach @endif
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-md-center">

        <div class="col-lg-8 col-sm-12 mb-3 order-xl-2 text-right  " id="nava1">
            <input id="cover" type="file" style="display:none;" accept="image/jpeg,image/png,image/jpg" onchange="photo();" />
            <input class="btn btn-sm btn-primary float-right" type="button" value="upload cover" onclick="document.getElementById('cover').click();" accept="image/*" />
        </div>

        <div class="col-lg-8 col-sm-12 order-xl-3 " id="tab1">

            <div class="card card-profile ">
                <div class="row justify-content-center">
                    <div class="col-lg-3 order-lg-2">

                        <div class="card-profile-image">
                            @if(count($data) > 0) @foreach ($data as $kreator) @if($kreator->photo != "")

                            <img src="{{ url('storage/file/pp/'.$kreator->photo) }}" id="pp1" alt="my_image" class="avatar avatar-xxl rounded-circle"></div>
                        @else
                        <img src="../../assets/img/theme/team-2.png" id="pp1" alt="my_image" class="avatar avatar-xxl rounded-circle"></div>
                    @endif @endforeach @endif
                </div>
            </div>
            <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                <div class="d-flex justify-content-center">
                    <label>
                        <input id="pp" type="file" accept="image/jpeg,image/png,image/jpg" style="display:none;" onchange="photo();" />
                        <input class="btn btn-sm btn-primary float-right" type="button" value="upload foto" accept='image/*' onclick="document.getElementById('pp').click();" />
                    </label>
                </div>
            </div>
            <div class="card-body pt-0">
                <div class="row"></div>
                <div class="">
                <form id="form222" class="form">

                <div class="col-md-12 mb-3">
                        <label class="form-control-label" for="">tautan</label>
                        @if(count($data) > 0) @foreach ($data as $kreator)
                        <span id="message"></span>
                        <div class="row">

                        <div class="col-8">

                        <input type="text" class="form-control form-control-muted" value="{{url($kreator->name)}}" id="link" >
                        </div>

                        <div class="col-4">

                        <button class="btn btn-outline-primary" onclick="myFunction()">
                        salin
                        </button>
                        </div>
                        </div>


                        @endforeach @else

                        <input type="text" class="form-control" id="name" placeholder="First name" value="" required> @endif
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-control-label" for="name">nama<span style="color:red;">*</span><sup>tanpa spasi</sup></label>
                        @if(count($data) > 0) @foreach ($data as $kreator)
                        <input type="text" class="form-control" id="name" pattern="^\S+$" placeholder="First name" value="{{$kreator->name}}" required> @endforeach @else

                        <input type="text" class="form-control" id="name" pattern="^\S+$" placeholder="First name" value="" required> @endif
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-control-label" for="validationCustom01">apa yang kamu buat<span style="color:red;">*</span></label>
                        @if(count($data) > 0) @foreach ($data as $kreator)
                        <input type="text" class="form-control" id="kreasi" placeholder="apa yang kamu buat" value="{{$kreator->kreasi}}" required> @endforeach @else

                        <input type="text" class="form-control" id="kreasi" placeholder="apa yang kamu buat" value="" required> @endif
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                    <!-- <div class="col-md-12 mb-3">
                            <label class="form-control-label" for="validationCustom01">buat link kamu sendiri</label>
                            <div class="form-group row">
                                <label for="example-text-input " class="col-md-2 col-form-label text-right text-muted h2 form-control-label mr--3">buataja.id/</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control d-inline col-md-5" id="validationCustom01" placeholder="markhaha" value="Mark" required="required">
                                </div>
                            </div>
                        </div> -->
                    <div class="col-md-12 mb-3">
                        <label class="form-control-label" for="quillEditor1">kenalkan diri anda</label>
                        <form>
                            <div id="desc" data-toggle="quill3" ql-editor>

                            </div>
                        </form>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label class="form-control-label" for="formatter">social media link</label>
                        <div class="col-md-12 mb-3">
                            <ul class="list-group list-group-flush list px-10">
                                <li class="list-group-item px-0">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <!-- Avatar -->
                                            <a href="#">
                                                <img alt="Image placeholder" class="avatar" src="../../assets/img/facebook.png">
                                            </a>
                                        </div>
                                        <div class="col ml--2">
                                            <h4 class="mb-0">
                          <a href="#!">Facebook</a>
                        </h4> @if(count($data) > 0) @foreach ($data as $users) @if($users->idfacebook == null)

                                            <span class="text-danger">●</span>
                                            <small>unconnected</small> @else
                                            <span class="text-success">●</span>
                                            <small>connected</small> @endif @endforeach @else
                                            <span class="text-success">●</span>
                                            <small>connected</small> @endif

                                        </div>

                                        <div class="col-auto">

                                            @if(count($data) > 0) @foreach ($data as $users) @if($users->idfacebook == null)

                                            <a href="{{ url('/connect/facebook') }}" class="btn btn-sm btn-outline-warning">connect</a> @else
                                            <a href="{{ url('/disconnect/facebook') }}" class="btn btn-sm btn-warning">disconnect</a> @endif @endforeach @else
                                            <a href="{{ url('/connect/facebook') }}" class="btn btn-sm btn-outline-warning">connect</a> @endif
                                        </div>
                                    </div>
                                </li>

                                <ul>
                        </div>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label class="form-control-label" for="formatter">konten dewasa</label>
                        <div class="custom-control custom-radio mb-3">
                            <label class="custom-toggle">
                                @if(count($data) > 0) @foreach ($data as $kreator) @if($kreator->nudity == 1)
                                <input type="checkbox" id="ya" checked> @else
                                <input type="checkbox" id="ya"> @endif @endforeach @endif
                                <span class="custom-toggle-slider rounded-circle"></span>
                            </label>
                            <!-- <label> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</label> -->
                        </div>
                    </div>
                      <a href="{{ route('password.request') }}"><label>ubah password</label></a>
                    <div class="text-center">
                        <button class="btn btn-warning" type="submit" form="form222" >ok</button>
                    </div>
                    </form>

                </div>
            </div>
        </div>

    </div>

    @if (Auth::user()->level = 1)
    <div class="col-8 mb-3 order-xl-2 text-right d-none " id="nava2">
        <a href="{{ url('edit/creator/tambahpaket') }}" class="btn btn-sm btn-primary">tambah paket</a>
    </div>
    <div class="col-12 order-xl-4 d-none" id="tab2">
        <div class="row justify-content-center">
            @if (count($paket) > 0)
            @foreach($paket as $pakets)
            <div class="card col-lg-3 col-sm-12 m-2">
                <!-- Card body -->

                <div class="card-body " style="overflow:hidden;text-overflow: ellipsis;">
                    @if($pakets->limitasi == 1)
                    <div class="d-flex justify-content-between">
                        <span class="badge badge-pill badge-danger">terbatas</span>
                    </div>
                    @endif

                    @if($pakets->photo !== null )
                    @if($pakets->photo != "")

                    <img src="{{ url('storage/file/'.$pakets->photo) }}" id="pp1" alt="my_image" class="avatar avatar-xl rounded-circle img-center img-fluid shadow shadow-lg--hover">
                    @else
                    <img src="../../assets/img/paket.png" id="pp1" alt="my_image" class="avatar avatar-xl rounded-circle img-center img-fluid shadow shadow-lg--hover">
                    @endif
                    @endif
                <div class="pt-4 text-center">
                    <h5 class="h2 title">
                            <mark class="d-block mb-1">{{$pakets->nama_paket}}</mark></h5>

                    <div class="row justify-content-center">
                        <div class="col-6">
                            <div class="h4 ">{{$pakets->harga}}</div>
                            <span class="h5 ">per bulan</span>
                        </div>
                        @if($pakets->limitasi == 1)
                        <div class="col-6">
                            <div class="h4 ">{{$pakets->jumlah_limitasi}}</div>
                            <span class="h5 ">member only</span>
                        </div>
                        @endif

                    </div>

                    @if($pakets->benefit != null)

                    <hr class="mb-2 mt-2">
                    <ul class="list-unstyled my-2">

                        <li>

                            <p>
                            <div class=" text-left">
                            <div class="accordion" id="accordionExample1">
                                <div class="card">
                            <div class="card-header" id="ba{{$pakets->id}} " data-toggle="collapse" data-target="#b{{$pakets->id}}" aria-expanded="true" aria-controls="b{{$pakets->id}}">
                                <h5 class="mb-0">benefit</h5>
                            </div>
                            <div id="b{{$pakets->id}}" class="collapse show" aria-labelledby="ba{{$pakets->id}}" data-parent="#accordionExample1">
                                <div class="card-body">
                                <div>
                                @foreach($pakets->benefit as $ben)

                                <div class="icon icon-xs icon-shape bg-white shadow rounded-circle text-muted"><i class="fas fa-circle"></i></div> {{$ben->nama_paket}}<br>
                                @endforeach

                                </div>
                                </div>
                            </div>
                    </div>
                    </div>

                                </div>

                                </p>
                        </li>
                    </ul>
                    @endif
                    <hr class="mb-2">

                    <div class="my-2   text-left">
                    <div class="accordion" id="accordionExample">
                                <div class="card">
                            <div class="card-header" id="da{{$pakets->id}}" data-toggle="collapse" data-target="#d{{$pakets->id}}" aria-expanded="true" aria-controls="d{{$pakets->id}}">
                                <h5 class="mb-0">deskripsi</h5>
                            </div>
                            <div id="d{{$pakets->id}}" class="collapse" aria-labelledby="da{{$pakets->id}}" data-parent="#accordionExample">
                                <div class="card-body">

                                {{$pakets->desc}}
                                </div>
                            </div>
                    </div>
                    </div>
                     </div>


                    <!-- <button type="button" class="btn btn-primary mb-3">edit</button> -->
                    <button type="button" class="btn btn-outline-primary mb-3 mt-5" onclick="modalhapus('{{$pakets->id}}','{{$pakets->nama_paket}}')">hapus</button>
                </div>

            </div>
        </div>
        @endforeach
        @else
        <div class="card">
        <div class="card-body">

<div class="row justify-item-center mx-1">
<div class="col-12">
<img class="thumbnail img-fluid rounded" width="100px" src="{{ asset('assets/img/empty5.png') }}"  alt="">

</div>
<div class="col-12 text-center">
<p class="text-muted"><span class="h3 text-muted">belum punya paket</p>

</div>
</div>
</div>
        </div>

@endif
    </div>
    </div>
    </div>


@endif
<script src="{{ asset('assets/vendor/jquery/dist/jquery.min.js') }}"></script>

@if(count($data) > 0)
@foreach ($data as $kreator)
<script src="{{ asset('assets/vendor/quill/dist/quill.min.js') }}"></script>
<script>
    function modalhapus(id, title) {
        $("#title").text(title);
        $("#idpaket").val(id);

        $('#modal-hapus').modal('show');
    }

    var quill = new Quill('#desc');
    quill.setContents(<?php echo $kreator->desc; ?>);
</script>
@endforeach
@endif
<script>
function myFunction() {
  var copyText = document.getElementById("link");
  copyText.select();
  copyText.setSelectionRange(0, 99999);
  document.execCommand("copy");

  $("#message").append('<div  class="aa alert alert-success alert-block"><button type="button" class="close" data-dismiss="alert">×</button> <strong>tautan telah disalin</strong></div>');
   setTimeout("$('.aa').fadeOut(1000);", 3000);
}


    function hapuspaket() {
        var formData = new FormData();

        formData.append("id", $('#idpaket').val());
        $.ajaxSetup({

            headers: {

                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

        });

        $.ajax({

            type: 'POST',
            processData: false,
            contentType: false,
            url: '/c2ac6f36a89eea3beafc493d61c6f6c6',

            data: formData,

            success: function(data) {
                location.reload();
            }

        });
    }

    var hash = window.location.hash;
    if (hash == "#paket") {
        var tab = document.getElementById("tab2");
        var button = document.getElementById("btn2");
        var nav = document.getElementById("nava2");
        var tab1 = document.getElementById("tab1");
        var button1 = document.getElementById("btn1");
        var nav1 = document.getElementById("nava1");
        tab1.classList.add("d-none");
        nav1.classList.add("d-none");
        button1.classList.remove("btn-primary");
        button1.classList.add("btn-outline-primary");
        tab.classList.remove("d-none");
        nav.classList.remove("d-none");
        button.classList.add("btn-primary");
        button.classList.remove("btn-outline-primary");
    }

    var $quill = new Quill('[data-toggle="quill3"]', {
        modules: {
            toolbar: [
                ['bold', 'italic'],
                ['link', 'blockquote', 'code', 'video', 'image'],
                [{
                    'list': 'ordered'
                }, {
                    'list': 'bullet'
                }]
            ]
        },
        placeholder: 'silahkan berkarya disini',
        theme: 'snow'
    });
    var $quill = new Quill('[data-toggle="quill1"]', {
        modules: {
            toolbar: [
                ['bold', 'italic'],
                ['link', 'blockquote', 'code', 'video', 'image'],
                [{
                    'list': 'ordered'
                }, {
                    'list': 'bullet'
                }]
            ]
        },
        placeholder: 'silahkan berkarya disini',
        theme: 'snow'
    });

    function photo() {
        var formData = new FormData();
        formData.append('pp', $('#pp')[0].files[0]);
        formData.append('cover', $('#cover')[0].files[0]);

        $.ajaxSetup({

            headers: {

                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

        });

        $.ajax({

            type: 'POST',
            processData: false,
            contentType: false,
            url: '/5cbbbf61d2c17842cdb67cb49e0601d1',

            data: formData,

            success: function(data) {
                location.reload();
            }

        });

    }
$("#form222").submit(function(e) {
e.preventDefault();
});

    $("#form222").submit(function() {
        var nudity = 0;

        if ($('#ya').is(':checked')) {
            var nudity = 1;
        }

        var content;
        var desceditor = new Quill('#desc');
        var delta = desceditor.getContents();
        content = JSON.stringify(delta);
        var formData = new FormData();

        formData.append("name", $('#name').val());
        formData.append("kreasi", $('#kreasi').val());
        formData.append("nudity", nudity);
        formData.append("desc", content);
        formData.append('pp', $('#pp')[0].files[0]);
        formData.append('cover', $('#cover')[0].files[0]);

        $.ajaxSetup({

            headers: {

                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

        });

        $.ajax({

            type: 'POST',
            processData: false,
            contentType: false,
            url: '/aebd9fb368f2e13b2b2ba624e1a2455e',

            data: formData,

            success: function(data) {
                 location.reload();

            }

        });

    });

    function page(nu, ni) {
        for (let i = 1; i <= 4; i++) {

            if (nu == i) {
                console.log(nu);
                console.log(ni);
                console.log(i);
                var tab = document.getElementById("tab" + i);
                var button = document.getElementById("btn" + ni);
                var nav = document.getElementById("nava" + ni);
                tab.classList.remove("d-none");
                nav.classList.remove("d-none");
                button.classList.add("btn-primary");
                button.classList.remove("btn-outline-primary");
            } else {
                var tab = document.getElementById("tab" + i);
                var button = document.getElementById("btn" + i);
                var nav = document.getElementById("nava" + i);
                tab.classList.add("d-none");
                nav.classList.add("d-none");
                button.classList.remove("btn-primary");
                button.classList.add("btn-outline-primary");
            }
        }

    }
</script>
@endsection
