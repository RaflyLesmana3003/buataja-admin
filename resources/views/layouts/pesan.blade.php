@extends('layouts.master')

@section('content')
 <div class="container">
  <div class="row">
   <div class="col-md-6">
    <a href="{{ url('get-pesan') }}" class="btn btn-danger btn-sm">
        Klik Disini
    </a>
    

    <table class="table table-striped">
    <tr>
        <th>#</th>
        <th>Nama</th>
        <th>Perusahaan</th>
    </tr>
    <tr>
        <td>1</td>
        <td>Anugrah Sandi</td>
        <td>Codepolitan</td>
    </tr>
    </table>
  </div>
 </div>
</div>
@endsection