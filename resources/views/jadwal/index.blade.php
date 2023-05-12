@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-12 mb-2">
        <button type="button" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah barang</button>    
    </div>        
    <div class="col-12">    
    <div class="card">
    <div class="card-header">
    <h3 class="card-title">Tabel data barang</h3>    
    <div class="card-tools">    
    <div class="input-group input-group-sm" style="width: 150px;">       
    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
    <div class="input-group-append">
    <button type="submit" class="btn btn-default">
    <i class="fas fa-search"></i>
    </button>
    </div>
    </div>
    </div>
    </div>
    
    <div class="card-body table-responsive p-0">        
    <table class="table table-hover text-nowrap">
    <thead>
    <tr>
    <th>ID</th>
    <th>Nama Permintaan</th>
    <th>Tgl jadwal</th>
    <th>Jumlah</th>
    <th>Keterangan</th>
    <th style="width: 40px">Aksi</th>
    </tr>
    </thead>
    <tbody>
    <tr>
    <td>183</td>
    <td>baju pdh</td>
    <td>17-08-2023</td>
    <td>23</td>
    <td>ukuran l</td>
    <td class="project-actions text-right">
        <a class="btn btn-primary btn-sm" href="#">
        <i class="fas fa-folder">
        </i>
        View
        </a>
        <a class="btn btn-info btn-sm" href="#">
        <i class="fas fa-pencil-alt">
        </i>
        Edit
        </a>
        <a class="btn btn-danger btn-sm" href="#">
        <i class="fas fa-trash">
        </i>
        Delete
        </a>
        </td>
    </tr>
    
    </tbody>
    </table>
    </div>
    
    </div>
    
    </div>
    </div>
@endsection