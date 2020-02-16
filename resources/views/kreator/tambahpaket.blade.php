@extends('layouts.app')

@section('title','buat paket')

@section('content')
<script>

</script>
<div class="modal fade" id="modal-benefitedit" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-body p-0">


<div class="card bg-secondary shadow border-0">
    <div class="card-body px-lg-5 py-lg-5">
        <div class="text-center text-muted mb-4">
             edit benefit
        </div>
        <hr>
        <input type="hidden" class="form-control" id="idbenefit1">
        <label class="form-control-label" for="nama">nama benefit</label>
        <input type="text" class="form-control" id="namabenefit1" placeholder="nama benefit" value="oleh berkat IV" required="required">

                                <label class="form-control-label" for="nama">tipe benefit</label>
                  <div class="col-md-6">
                  <div class="custom-control custom-radio mb-3">
                    <input name="custom-radio-21"  class="custom-control-input" id="customRadio51" value="1" type="radio">
                    <label class="custom-control-label" for="customRadio51">sekali</label>
                  </div>
                  </div>
                  <div class="col-md-6">
                  <div class="custom-control custom-radio mb-3">
                    <input name="custom-radio-21"  class="custom-control-input" id="customRadio11" value="2" type="radio">
                    <label class="custom-control-label" for="customRadio11">sebulan</label>
                  </div>
                  </div>
          <div class="text-center">
              <a href="#" class="btn btn-primary" onclick="editbenefitdb()">edit</a>
            </div>
    </div>
</div>



            </div>

        </div>
    </div>
</div>
<div class="modal fade" id="modal-benefit" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-body p-0">


<div class="card bg-secondary shadow border-0">
    <div class="card-body px-lg-5 py-lg-5">
        <div class="text-center text-muted mb-4">
             tambah benefit
        </div>
        <hr>
        <input type="hidden" class="form-control" id="idbenefit">
        <label class="form-control-label" for="nama">nama benefit</label>
        <input type="text" class="form-control" id="namabenefit" placeholder="nama benefit" value="oleh berkat IV" required="required">

                                <label class="form-control-label" for="nama">tipe benefit</label>
                  <div class="col-md-6">
                  <div class="custom-control custom-radio mb-3">
                    <input name="custom-radio-2"  class="custom-control-input" id="customRadio5" value="1" type="radio">
                    <label class="custom-control-label" for="customRadio5">sekali</label>
                  </div>
                  </div>
                  <div class="col-md-6">
                  <div class="custom-control custom-radio mb-3">
                    <input name="custom-radio-2"  class="custom-control-input" id="customRadio1" value="2" type="radio">
                    <label class="custom-control-label" for="customRadio1">sebulan</label>
                  </div>
                  </div>
          <div class="text-center">
              <a href="#" class="btn btn-primary" onclick="tambahbenefit()">tambah</a>
            </div>
    </div>
</div>



            </div>

        </div>
    </div>
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
    <span id="message"></span>

</div>

    <!-- Page content -->
    <div class="container-fluid mt--6">
              <span id="message"></span>

    <div class="row justify-content-center">

            <div class="col-lg-8 col-sm-12 order-xl-3 " id="tab1">

                <div class="card card-profile ">
                    <div class="row justify-content-center">
                        <div class="col-lg-3 order-lg-2">

                            <div class="card-profile-image">
                            <img src="../../assets/img/paket.png" id="pp1" alt="my_image" class="avatar avatar-xxl rounded-circle"></div>

                        </div>
                    </div>
                    <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                        <div class="d-flex justify-content-center">
                        <label>
                            <input id="pp" type="file" accept="image/jpeg,image/png,image/jpg" style="display:none;" />
                            <input class="btn btn-sm btn-primary float-right" type="button" value="upload foto" accept='image/*'  onclick="document.getElementById('pp').click();" />
                        </label>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="row"></div>
                        <div class="">
                            <div class="col-md-12 mb-3">
                                <label class="form-control-label" for="nama">nama paket</label>
                                <input type="text" class="form-control" id="namapaket" placeholder="ex : vip" required="required">
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                <label class="form-control-label" for="validationCustom02">harga</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text"><small class="font-weight-bold">Rp.</small></span>
                                    </div>
                                    <input class="form-control uang" placeholder="15.000" id="price" type="text">
                                </div>
                                </div>

                            </div>
                            <div class="col-md-12 mb-3">
                            <div class="form-group">
                    <label class="form-control-label" for="caption">deskripsi<span class="text-danger">*</span></label>
                    <textarea class="form-control"  id="caption" rows="2" resize="none" placeholder="hallo guys...." required></textarea>
                  </div>
                            </div>
                            <br>
                            <div class="col-md-12 mb-1">

                            <div class="row mb-1">
                            <div class="col-1">
                            <label class="form-control-label" for="exampleFormControlSelect1">benefit</label>

                            </div>
                                <div class="col-9">
                                <div class="form-group">
                                    <select class="form-control" id="exampleFormControlSelect1" onchange="select(this)" >
                                    <option  >pilih benefit</option>

                                    @if(count($benefit) > 0)
                                    @foreach ($benefit as $benefits)
                                    <option  id="{{$benefits->id}}"  value="{{$benefits->id}}" name="{{$benefits->nama_paket}}" type="{{$benefits->tipe}}">{{$benefits->nama_paket}}</option>
                                    @endforeach
                                    @else
                                    <option disable>anda belum punya benefit</option>
                                    @endif
                                    </select>
                                </div>
                                </div>
                                <div class="col-2">
                                <div class="form-group">
                                <button class="btn btn-warning" type="submit" data-toggle="modal" data-target="#modal-benefit" onclick="tambahbtn();">tambah</button>

                                </div>
                                </div>

                            </div>
                            </div>
                            <div class="row row-grid justify-content-center">
        <div class="col-lg-10 mb-3">
          <div class="table-responsive">
            <table class="table table ">
              <thead>
                <tr>
                  <th class="px-0 bg-transparent" scope="col">
                    <span class="text-light font-weight-700">benefit</span>
                  </th>
                  <th class="text-center text-light bg-transparent" scope="col">tipe</th>
                  <th class="text-right text-light bg-transparent" scope="col">action</th>
                </tr>
              </thead>
              <tbody id="tbbenefit">
              </tbody>
            </table>
          </div>
        </div>
      </div>


                            <!-- <div class="col-md-12 mb-3">
                                <label class="form-control-label" for="formatter">paket terbatas</label>
                                <div class="custom-control custom-radio mb-3">
                                    <label class="custom-toggle">
                                        <input type="checkbox" id="limit" onclick="check()">
                                        <span class="custom-toggle-slider rounded-circle"></span>
                                    </label>
                                 </div>
                                 <div class="form-group d-none" id="inpu1">
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text"><small class="font-weight-bold">member</small></span>
                                    </div>
                                    <input class="form-control" id="limitasi" placeholder="10" type="text">
                                </div>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-control-label" for="formatter">tanyakan alamat</label>
                                <div class="custom-control custom-radio mb-3">
                                    <label class="custom-toggle">
                                        <input type="checkbox" id="check2" >
                                        <span class="custom-toggle-slider rounded-circle"></span>
                                    </label>
                                 </div>
                                 </div> -->
                            <div class="text-center">
                                <button class="btn btn-warning" type="submit" onclick="tambahpaket()">Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
         </div>
         <script src="{{ asset('assets/vendor/quill/dist/quill.min.js') }}"></script>
         <script src="{{ asset('assets/vendor/jquery/dist/jquery.min.js') }}"></script>

       <script>
       function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      $('#pp1').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
  }
}

$("#pp").change(function() {
  readURL(this);
});



       var optionValues = [];

       function tambahpaket() {
        var lim = 0;
        // var alamat=0;
        //     if($('#check2').is(':checked')){
        //         alamat = 1;
        //     }
        $.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

        });
        // if($('#limit').is(':checked')){
        //         lim = 1;
        //     }

        var formData = new FormData();
            formData.append('namapaket',$("#namapaket").val());
            formData.append('harga', $("#price").val());
            formData.append('desc', $("#caption").val());
            formData.append('benefit', optionValues.toString());
            // formData.append('limit', lim);
            // formData.append('limitasi', $("#limitasi").val());
            // formData.append('alamat', alamat);
            formData.append('photo',$('#pp')[0].files[0]);


        $.ajax({

        type:'POST',

        url:'/f34d39276fcb35adf8943528a023984a',
        processData: false,
        contentType: false,
        data:formData,

        success:function(data){
            window.location.href = "{{url('de95b43bceeb4b998aed4aed5cef1ae7#paket')}}";
        },
          error: function(file, response)
          {

            $("#message").append('<div  class="aa alert alert-'+file.responseJSON.tipe+' alert-block"><button type="button" class="close" data-dismiss="alert">×</button> <strong>'+file.responseJSON.data+'</strong></div>');
            setTimeout("$('.aa').fadeOut(1000);", 3000);
            $("html, body").animate({ scrollTop: 0 }, "slow");
             return false;
          }

        });
       }

       function tambahbtn(params) {
        $('#modal-benefit')
            .find("input,textarea,select")
            .val('')
            .end()
            .find("input[type=checkbox], input[type=radio]")
            .prop("checked", "")
            .end();
       }
       function editbenefit(params) {
        $.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

        });

        $.ajax({

        type:'GET',

        url:'/8373f10aa6ee53aeae7dd77fa9a66fd4',

        data:{id:params},

        success:function(data){
            $("#idbenefit1").val( data[0]["id"] );
            $("#namabenefit1").val( data[0]["nama_paket"] );
            if (data[0]["tipe"] == 1) {
                $("#customRadio51").prop('checked',true);
            } if (data[0]["tipe"] == 2) {
                $("#customRadio11").prop( "checked", true );
            }
            $('#modal-benefitedit').modal('show');
        }

        });
       }

       function editbenefitdb(params) {
        var tipe;
        if ($('#customRadio51').is(':checked')) {
            tipe = 1;
        }
        if ($('#customRadio11').is(':checked')) {
            tipe = 2;
        }
        $.ajaxSetup({

            headers: {

                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

            });

        var Data = {
            id: $("#idbenefit1").val(),
            namabenefit : $("#namabenefit1").val(),
            tipe : tipe

        };

    $.ajax({

    type:'POST',

    url:'/48dc4d8d68cf1eb740249c19c4cc7304',

    data:{Data:Data},

    success:function(data){
        location.reload();

    }

    });
       }

       function hapusbenefit(params) {
        $('#'+params).removeAttr('disabled');
        console.log(params);

        $( "#benefit"+params ).remove();

       }
       function select(nu){
// alert();
        $('#exampleFormControlSelect1 option:selected').prop('disabled', true);
            var value = $('#exampleFormControlSelect1 option:selected').val();

            var name = $('#exampleFormControlSelect1 option:selected').attr("name");
            var id = $('#exampleFormControlSelect1 option:selected').attr("id");
            var tipe = $('#exampleFormControlSelect1 option:selected').attr("type");
            var type;
            if (tipe == 1) {
                type = "sekali";
            }else {
                type = "sebulan";
            }
            if (name) {
                $('#exampleFormControlSelect1 option:selected').each(function() {
                optionValues.push($(this).val());
                $("#tbbenefit").append('<tr id="benefit'+id+'"><td class="px-0">'+name+'</td><td class="text-center">'+type+'</i></td><td class="text-right"><a href="#" class="btn btn-sm btn-primary" onclick="editbenefit('+id+');" >edit</a><a href="#" class="btn btn-sm btn-outline-primary" onclick="hapusbenefit('+id+');">hapus</a></i></td></tr>');

            });



            }
             };



    function tambahbenefit() {
        var tipe;
        if ($('#customRadio5').is(':checked')) {
            tipe = 1;
        }
        if ($('#customRadio1').is(':checked')) {
            tipe = 2;
        }
        $.ajaxSetup({

            headers: {

                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

            });

        var Data = {
            namabenefit : $("#namabenefit").val(),
            tipe : tipe

        };

    $.ajax({

    type:'POST',

    url:'/a84c5795d94986ff2dfd1a5907b211a6',

    data:{Data:Data},

    success:function(data){
        location.reload();

    }

    });



    };

           function check() {

            var text = document.getElementById("inpu1");
            if($('#limit').is(':checked')){
                    text.classList.add("d-block");

            } else {
                text.classList.remove("d-block");
                text.classList.add("d-none");

            }
            }
       function page(nu,ni) {
           for (let i = 1; i <= 4; i++) {

               if (nu == i) {
                    console.log(nu);
                    console.log(ni);
                    console.log(i);
                    var tab = document.getElementById("tab"+i);
                    var button = document.getElementById("btn"+ni);
                    var nav = document.getElementById("nava"+ni);
                    tab.classList.remove("d-none");
                    nav.classList.remove("d-none");
                    button.classList.add("btn-primary");
                    button.classList.remove("btn-outline-primary");
                } else {
                    var tab = document.getElementById("tab"+i);
                    var button = document.getElementById("btn"+i);
                    var nav = document.getElementById("nava"+i);
                    tab.classList.add("d-none");
                    nav.classList.add("d-none");
                    button.classList.remove("btn-primary");
                    button.classList.add("btn-outline-primary");
                }
           }


       }
       </script>
@endsection
