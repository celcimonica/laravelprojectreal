@extends('layouts.template')
@section('judulh1','Admin - layanan')
@section('konten')
<div class="col-md-6">
    @if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your
        input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Data layanan</h3>
        </div>
        <!-- /.card-header -->
        <div class=" card-body">
            <table>
                <tr>
                    <th>Nama layanan</th>
                    <td>:</td>
                    <td>{{ $data[0]->name }}</td>
                </tr>
                <tr>
                    <th>harga</th>
                    <td>:</td>
                    <td>@money($data[0]->price)</td>
                </tr>
                <tr>
                    <th>Stock</th>
                    <td>:</td>
                    <td>{{ $data[0]->stock }}</td>
                </tr>
                <tr>
                    <th>Jenis</th>
                    <td>:</td>
                    <td>{{ $data[0]->jenis }}</td>
                </tr>
                <tr>
                    <th>Deskripsi</th>
                    <td>:</td>
                    <td>{{ $data[0]->description}}</td>
                </tr>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
</div>
@endsection