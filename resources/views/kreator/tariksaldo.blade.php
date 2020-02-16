@extends('layouts.app')

@section('title','penarikan')

@section('content')


<div class="header bg-warning pb-6">
  <div class="container-fluid">
    <div class="header-body">
      <div class="row align-items-center py-4">
        <div class="col-lg-6 col-7">
          <h6 class="display-2 text-white d-inline-block mb-0">penarikan!🚀</h6>
        </div>
      </div>
      <!-- Card stats -->
      <div class="row">
      
      </div>
    </div>
  </div>
</div>

<div class="container-fluid mt--6">
    <div class="row justify-content-center">
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
                
              </div>
            </div>
          </div>
        </div>
      </div>

<div class="row justify-content-center">
<div class="card col-8">
        <!-- Card body -->
        <div class="card-body">
          <span id="message"></span>

          <div class="form-row">
            <div class="col-md-12 mb-3">
            <form id="form" name="form">

              <label class="form-control-label" for="nama">atas nama<span class="text-danger">*</span></label>
                @if(count($creator) > 0) @foreach ($creator as $kreator)
              <input type="text" class="form-control" id="nama" value="{{$kreator->atasnama}}" placeholder="ex: mimin suamin" required>
                @endforeach @else
<input type="text" class="form-control" id="nama"  placeholder="ex: mimin suamin" required>
                @endif
              <br>
              @if(count($creator) > 0) @foreach ($creator as $kreator)
            <input type="hidden" class="form-control" id="banks" value="{{$kreator->bank}}">
              @endforeach @else
<input type="hidden" class="form-control" id="banks">
              @endif
              <label class="form-control-label" for="bank">bank<span class="text-danger">*</span></label>

              <select name="bank" class="form-control" id="bank" required>
                <option value="002">BANK BRI</option>
                <option value="003">BANK EKSPOR INDONESIA</option>
                <option value="008">BANK MANDIRI</option>
                <option value="009">BANK BNI</option>
                <option value="011">BANK DANAMON</option>
                <option value="013">PERMATA BANK</option>
                <option value="014">BANK BCA</option>
                <option value="016">BANK BII</option>
                <option value="019">BANK PANIN</option>
                <option value="020">BANK ARTA NIAGA KENCANA</option>
                <option value="022">BANK NIAGA</option>
                <option value="023">BANK BUANA IND</option>
                <option value="026">BANK LIPPO</option>
                <option value="028">BANK NISP</option>
                <option value="030">AMERICAN EXPRESS BANK LTD</option>
                <option value="031">CITIBANK N.A.</option>
                <option value="032">JP. MORGAN CHASE BANK, N.A.</option>
                <option value="033">BANK OF AMERICA, N.A</option>
                <option value="034">ING INDONESIA BANK</option>
                <option value="036">BANK MULTICOR TBK.</option>
                <option value="037">BANK ARTHA GRAHA</option>
                <option value="039">BANK CREDIT AGRICOLE INDOSUEZ</option>
                <option value="040">THE BANGKOK BANK COMP. LTD</option>
                <option value="041">THE HONGKONG & SHANGHAI B.C.</option>
                <option value="042">THE BANK OF TOKYO MITSUBISHI UFJ LTD</option>
                <option value="045">BANK SUMITOMO MITSUI INDONESIA</option>
                <option value="046">BANK DBS INDONESIA</option>
                <option value="047">BANK RESONA PERDANIA</option>
                <option value="048">BANK MIZUHO INDONESIA</option>
                <option value="050">STANDARD CHARTERED BANK</option>
                <option value="052">BANK ABN AMRO</option>
                <option value="053">BANK KEPPEL TATLEE BUANA</option>
                <option value="054">BANK CAPITAL INDONESIA, TBK.</option>
                <option value="057">BANK BNP PARIBAS INDONESIA</option>
                <option value="058">BANK UOB INDONESIA</option>
                <option value="059">KOREA EXCHANGE BANK DANAMON</option>
                <option value="060">RABOBANK INTERNASIONAL INDONESIA</option>
                <option value="061">ANZ PANIN BANK</option>
                <option value="067">DEUTSCHE BANK AG.</option>
                <option value="068">BANK WOORI INDONESIA</option>
                <option value="069">BANK OF CHINA LIMITED</option>
                <option value="076">BANK BUMI ARTA</option>
                <option value="087">BANK EKONOMI</option>
                <option value="088">BANK ANTARDAERAH</option>
                <option value="089">BANK HAGA</option>
                <option value="093">BANK IFI</option>
                <option value="095">BANK CENTURY, TBK.</option>
                <option value="097">BANK MAYAPADA</option>
                <option value="110">BANK JABAR</option>
                <option value="111">BANK DKI</option>
                <option value="112">BPD DIY</option>
                <option value="113">BANK JATENG</option>
                <option value="114">BANK JATIM</option>
                <option value="115">BPD JAMBI</option>
                <option value="116">BPD ACEH</option>
                <option value="117">BANK SUMUT</option>
                <option value="118">BANK NAGARI</option>
                <option value="119">BANK RIAU</option>
                <option value="120">BANK SUMSEL</option>
                <option value="121">BANK LAMPUNG</option>
                <option value="122">BPD KALSEL</option>
                <option value="123">BPD KALIMANTAN BARAT</option>
                <option value="124">BPD KALTIM</option>
                <option value="125">BPD KALTENG</option>
                <option value="126">BPD SULSEL</option>
                <option value="127">BANK SULUT</option>
                <option value="128">BPD NTB</option>
                <option value="129">BPD BALI</option>
                <option value="130">BANK NTT</option>
                <option value="131">BANK MALUKU</option>
                <option value="132">BPD PAPUA</option>
                <option value="133">BANK BENGKULU</option>
                <option value="134">BPD SULAWESI TENGAH</option>
                <option value="135">BANK SULTRA</option>
                <option value="145">BANK NUSANTARA PARAHYANGAN</option>
                <option value="146">BANK SWADESI</option>
                <option value="147">BANK MUAMALAT</option>
                <option value="151">BANK MESTIKA</option>
                <option value="152">BANK METRO EXPRESS</option>
                <option value="153">BANK SHINTA INDONESIA</option>
                <option value="157">BANK MASPION</option>
                <option value="159">BANK HAGAKITA</option>
                <option value="161">BANK GANESHA</option>
                <option value="162">BANK WINDU KENTJANA</option>
                <option value="164">HALIM INDONESIA BANK</option>
                <option value="166">BANK HARMONI INTERNATIONAL</option>
                <option value="167">BANK KESAWAN</option>
                <option value="200">BANK TABUNGAN NEGARA (PERSERO)</option>
                <option value="212">BANK HIMPUNAN SAUDARA 1906, TBK .</option>
                <option value="213">BANK TABUNGAN PENSIUNAN NASIONAL</option>
                <option value="405">BANK SWAGUNA</option>
                <option value="422">BANK JASA ARTA</option>
                <option value="426">BANK MEGA</option>
                <option value="427">BANK JASA JAKARTA</option>
                <option value="441">BANK BUKOPIN</option>
                <option value="451">BANK SYARIAH MANDIRI</option>
                <option value="459">BANK BISNIS INTERNASIONAL</option>
                <option value="466">BANK SRI PARTHA</option>
                <option value="472">BANK JASA JAKARTA</option>
                <option value="484">BANK BINTANG MANUNGGAL</option>
                <option value="485">BANK BUMIPUTERA</option>
                <option value="490">BANK YUDHA BHAKTI</option>
                <option value="491">BANK MITRANIAGA</option>
                <option value="494">BANK AGRO NIAGA</option>
                <option value="498">BANK INDOMONEX</option>
                <option value="501">BANK ROYAL INDONESIA</option>
                <option value="503">BANK ALFINDO</option>
                <option value="506">BANK SYARIAH MEGA</option>
                <option value="513">BANK INA PERDANA</option>
                <option value="517">BANK HARFA</option>
                <option value="520">PRIMA MASTER BANK</option>
                <option value="521">BANK PERSYARIKATAN INDONESIA</option>
                <option value="525">BANK AKITA</option>
                <option value="526">LIMAN INTERNATIONAL BANK</option>
                <option value="531">ANGLOMAS INTERNASIONAL BANK</option>
                <option value="523">BANK DIPO INTERNATIONAL</option>
                <option value="535">BANK KESEJAHTERAAN EKONOMI</option>
                <option value="536">BANK UIB</option>
                <option value="542">BANK ARTOS IND</option>
                <option value="547">BANK PURBA DANARTA</option>
                <option value="548">BANK MULTI ARTA SENTOSA</option>
                <option value="553">BANK MAYORA</option>
                <option value="555">BANK INDEX SELINDO</option>
                <option value="566">BANK VICTORIA INTERNATIONAL</option>
                <option value="558">BANK EKSEKUTIF</option>
                <option value="559">CENTRATAMA NASIONAL BANK</option>
                <option value="562">BANK FAMA INTERNASIONAL</option>
                <option value="564">BANK SINAR HARAPAN BALI</option>
                <option value="567">BANK HARDA</option>
                <option value="945">BANK FINCONESIA</option>
                <option value="946">BANK MERINCORP</option>
                <option value="947">BANK MAYBANK INDOCORP</option>
                <option value="948">BANK OCBC – INDONESIA</option>
                <option value="949">BANK CHINA TRUST INDONESIA</option>
                <option value="950">BANK COMMONWEALTH</option>
              </select>
                  <br>
                  <label class="form-control-label" for="rekening">nomor rekening<span class="text-danger">*</span></label>
                  @if(count($creator) > 0) @foreach ($creator as $kreator)
                <input type="text" class="form-control" id="rekening" value="{{$kreator->norekening}}" placeholder="ex: 12345678" required>
                  @endforeach @else
  <input type="text" class="form-control" id="rekening"  placeholder="ex: 12345678" required>
                  @endif
                  <br>
                <div class="align-right">  <button class="btn btn-warning ld-ext-right" onclick="data();" > simpan </button>
                </div>

            </div>

        </div>
      </div>
      </div>
      <div class="card col-8">

      <div class="card-body mt-2">
        <span id="message"></span>

        <div class="form-row">
          <div class="col-md-12 mb-3">

            <div class="col-md-12 mb-3">
                <div class="form-group">
                <label class="form-control-label" for="validationCustom02">total penarikan</label>
                <div class="input-group input-group-merge">
                    <div class="input-group-prepend">
                    <span class="input-group-text"><small class="font-weight-bold">Rp.</small></span>
                    </div>
                    <input class="form-control uang" placeholder="15.000" id="jumlah" type="text" required>
                </div>
                </div>

            </div>
            <label class="form-control-label text-muted" for="validationCustom02">potongan 10% dari total penarikan anda</label>

                <br>
              <div class="align-right"> 
              
              </div>

              </form> <button class="btn btn-warning ld-ext-right" onclick="modalhapus()"> ajukan penarikan </button>
            </div>
          </div>

      </div>
    </div>
    </div>
    </div>
    <div class="col-md-4">
    <div class="modal fade" id="modal-hapus" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
        <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
            <div class="modal-content bg-gradient-warning">

                <div class="modal-header">
                    <h6 class="modal-title" id="modal-title-notification">masukkan password anda?</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body">
          <span id="message1"></span>

                    <input type="hidden" id="idpost">
                    <div class="py-3 text-center">
                        <!-- <h4 class="heading mt-4" id="title">You should read this!</h4> -->
                        <label for="password">password</label>
                        <input type="password" form="form" required id="password" class="form-control">
                    </div>

                </div>

                <div class="modal-footer">
                    <!-- <button type="button" class="btn btn-link text-white ml-auto" onclick="hapuspost()">batal</button> -->
                    <!-- <button type="button" form="form" type="submit" class="btn btn-white" >ajukan penarikan</button> -->
                  <button class="btn btn-white ld-ext-right " id="btn1" form="form" type="submit" >ajukan penarikan</button>
                    
                </div>

            </div>
        </div>
    </div>
</div>
    <script src="{{ asset('assets/vendor/jquery/dist/jquery.min.js') }}"></script>
    <script type="text/javascript">
    function modalhapus() {
          $('#modal-hapus').modal('show');
      }

    $("select option[value='"+$('#banks').val()+"']").attr("selected","selected");
    </script>
    <script type="text/javascript">
    $(document).ready(function() {
           //option A
           $("#form").submit(function(e){
               e.preventDefault(e);
           });
       });
    $(".custom-file-input").on("change", function() {
var fileName = $(this).val().split("\\").pop();
$(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});

function data()  {
  var formData = new FormData();
  formData.append('atasnama', $('#nama').val());
  formData.append('bank', $('#bank').val());
  formData.append('norekening', $('#rekening').val());

  $.ajaxSetup({

  headers: {

      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

  }

  });



  $.ajax({

  type:'POST',
  processData: false,
  contentType: false,
  fileElementId: "customFile",
  url: "/data/bank",
  data:formData,
  success:function(data){
    $("#message").append('<div  class="aa alert alert-success alert-block"><button type="button" class="close" data-dismiss="alert">×</button> <strong>data anda telah diupdate</strong></div>');
      setTimeout("$('.aa').fadeOut(1000);", 3000);
      $("html, body").animate({ scrollTop: 0 }, "slow");
      setTimeout("window.location.href = '{{url('f27fc78ffa140e97e0c535374a2a2213')}}';", 3000);


  },
    error: function(file, response)
    {

      $("#message").append('<div  class="aa alert alert-'+file.responseJSON.tipe+' alert-block"><button type="button" class="close" data-dismiss="alert">×</button> <strong>'+file.responseJSON.data+'</strong></div>');
      setTimeout("$('.aa').fadeOut(1000);", 3000);
      $("html, body").animate({ scrollTop: 0 }, "slow");
      setTimeout("location.reload();", 3000);

       return false;
    }

  });

};

$('#form').submit(function() {
  data();

  var formData = new FormData();
  formData.append('password', $('#password').val());
  formData.append('jumlah', $('#jumlah').val());
  formData.append('atasnama', $('#nama').val());
  formData.append('bank', $('#bank').val());
  formData.append('norekening', $('#rekening').val());
  $.ajaxSetup({

  headers: {

      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

  }

  });



  $.ajax({

  type:'POST',
  processData: false,
  contentType: false,
  fileElementId: "customFile",
  url: "/data/penarikan",
  data:formData,
  success:function(data){
    $("#message").append('<div  class="aa alert alert-success alert-block"><button type="button" class="close" data-dismiss="alert">×</button> <strong>data anda telah diupdate</strong></div>');
      setTimeout("$('.aa').fadeOut(1000);", 3000);
      $("html, body").animate({ scrollTop: 0 }, "slow");
      setTimeout("window.location.href = '{{url('f27fc78ffa140e97e0c535374a2a2213')}}';", 3000);


  },
    error: function(file, response)
    {

      $("#message1").append('<div  class="aa alert alert-'+file.responseJSON.tipe+' alert-block"><button type="button" class="close" data-dismiss="alert">×</button> <strong>'+file.responseJSON.data+'</strong></div>');
      setTimeout("$('.aa').fadeOut(1000);", 3000);
      $("html, body").animate({ scrollTop: 0 }, "slow");
      setTimeout("location.reload();", 3000);

       return false;
    }

  });

});
    </script>
@endsection
