@extends('layouts.app')
@section('title','list paket')
@section('content')
@if(count($data) > 0) @foreach ($data as $kreator) @if($kreator->cover != "")
<div class="header pb-6 d-flex align-items-center" style="min-height: 368px; background-image: url('{{ url('storage/file/pp/'.$kreator->cover) }}'); background-size: cover; background-position: center;"></div>
@else
<div class="header pb-6 d-flex align-items-center" style="min-height: 368px; background-image: url(../../assets/img/theme/profile-cover2.png); background-size: cover; background-position: center;"></div>
@endif @endforeach @endif
<div class="container-fluid mt--6">
    <div class="col-12 order-xl-4 " id="tab2">
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
                    <hr class="mb-2 mt-2">

                    @if($pakets->benefit != null)

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
                    <button type="button" class="btn btn-primary mb-3 mt-5" onclick="return submitForm('{{$pakets->id}}','{{$pakets->harga}}','{{$pakets->ID_CREATOR}}')">berlangganan</button>
                </div>

            </div>
        </div>
        @endforeach
@endif
    </div>
    </div>
    <script
        src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous"></script>
    <script src="{{ !config('services.midtrans.isProduction') ? 'https://app.sandbox.midtrans.com/snap/snap.js' : 'https://app.midtrans.com/snap/snap.js' }}" data-client-key="{{ config('services.midtrans.clientKey') }}"></script>
    <script>
    function submitForm(id,harga,idkreators) {
        var currentdate = new Date(); 
    var datetime = "Now:" + currentdate.getDate() + "/"
                + (currentdate.getMonth()+1)  + "/" 
                + currentdate.getFullYear() + "@"  
                + currentdate.getHours() + ":"  
                + currentdate.getMinutes() + ":" 
                + currentdate.getSeconds();
        // Kirim request ajax
        $.post("http://127.0.0.1:8000/transaksi/store",
        {
            _method: 'POST',
            _token: '{{ csrf_token() }}',
            now: datetime,
            harga: harga,
            idpaket: id,
            idkreator: idkreators,
        },
        function (data, status) {
            snap.pay(data.snap_token, {
                // Optional
                onSuccess: function (result) {
                    location.reload();
                },
                // Optional
                onPending: function (result) {
                    location.reload();
                },
                // Optional
                onError: function (result) {
                    location.reload();
                }
            });
        });
        return false;
    }
    </script>
@endsection
