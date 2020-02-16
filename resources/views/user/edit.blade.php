@extends('layouts.app')
@section('title','edit user')
@section('content')

<script>
  function readURL(input,target) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#pp1')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
</script>




<!-- Header -->


@if(count($user) > 0)
@foreach ($user as $users)
@if($users->cover != "")
<div class="header pb-6 d-flex align-items-center" style="min-height: 368px; background-image: url('{{ url('storage/file/pp/'.$users->cover) }}'); background-size: cover; background-position: center;"></div>
@else
<div class="header pb-6 d-flex align-items-center" style="min-height: 368px; background-image: url(../../assets/img/theme/profile-cover.png); background-size: cover; background-position: center;"></div>
@endif

@endforeach

@endif

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

                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-md-center">


        <div class="col-lg-8 col-sm-12 mb-3 order-xl-2 text-right  " id="nava1">
        <input id="cover"  type="file" style="display:none;" accept="image/jpeg,image/png,image/jpg" onchange="photo();"/>
            <input class="btn btn-sm btn-primary float-right" type="button" value="upload cover" onclick="document.getElementById('cover').click();" accept="image/*"/>
        </div>

        <div class="col-lg-8 col-sm-12 order-xl-3 " id="tab1">

            <div class="card card-profile ">
                <div class="row justify-content-center">
                    <div class="col-lg-3 order-lg-2">

                        <div class="card-profile-image">


                            @if(count($user) > 0)
                            @foreach ($user as $users)
                            @if($users->photo != "")

                            <img src="{{ url('storage/file/pp/'.$users->photo) }}" id="pp1" alt="my_image" class="avatar avatar-xxl rounded-circle">
                            @else
                            <img src="../../assets/img/theme/team-1.png" id="pp1" alt="my_image" class="avatar avatar-xxl rounded-circle">
                            @endif

                                @endforeach



                            @endif
                            </div>
                    </div>
                </div>
                <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                    <div class="d-flex justify-content-center">
                        <label>
                            <input id="pp" type="file" accept="image/jpeg,image/png,image/jpg" style="display:none;" onchange="photo();" />
                            <input class="btn btn-sm btn-primary float-right" type="button" value="upload foto" accept='image/*'  onclick="document.getElementById('pp').click();" />
                        </label>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="row"></div>
                    <div class="">
                        <div class="col-md-12 mb-3">
                            <label class="form-control-label" for="name">nama</label>
                            @if(count($user) > 0)
                            @foreach ($user as $users)
                                <input type="text" class="form-control" id="name" placeholder="First name" value="{{$users->name}}" required>
                                @endforeach

                            @else

                            <input type="text" class="form-control" id="name" placeholder="First name" value="" required>
                            @endif
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-control-label" for="quillEditor1" >kenalkan diri anda</label>
                            <form >
                                <div  id="desc" data-toggle="quill"  data-quill-placeholder="halo halo" ql-editor>

                                </div>
                            </form>
                        </div>

                        <a href="{{ route('password.request') }}"><label>ubah password</label></a>
                        </div>
                        <div class="text-center">
                        <button class="btn btn-warning" id="btn1" onclick="tambah()" >ok</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>



    </div>
    </div>

    @if(count($user) > 0)
    @foreach ($user as $users)
    <script src="{{ asset('assets/vendor/quill/dist/quill.min.js') }}"></script>
    <script>
    var quill = new Quill('#desc');
    quill.setContents(<?php echo $users->desc; ?>);
    </script>
    @endforeach
    @endif
    <script>

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

            type:'POST',
            processData: false,
            contentType: false,
            url:'/d33e9b922fce690cfbb1e761fc52d9c7',

            data:formData,

            success:function(data){
                location.reload();
            }

            });

        }
        var $quill = new Quill('[data-toggle="quill"]', {
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

    function tambah() {
        var nudity = 0;


        if($('#ya').is(':checked')) { var nudity = 1; }

        var content;
        var desceditor = new Quill('#desc');
        var delta = desceditor.getContents();
        content = JSON.stringify(delta);
        var formData = new FormData();

        formData.append("name",$('#name').val());
        formData.append("kreasi",$('#kreasi').val());
        formData.append("nudity",nudity);
        formData.append("desc",content);
        formData.append('pp', $('#pp')[0].files[0]);
        formData.append('cover', $('#cover')[0].files[0]);

        $.ajaxSetup({

            headers: {

                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

            });

    $.ajax({

    type:'POST',
    processData: false,
    contentType: false,
    url:'/aebd9fb368f2e13b2b2ba624e1a2455e',

    data:formData,

    success:function(data){

    }

    });



    };



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
