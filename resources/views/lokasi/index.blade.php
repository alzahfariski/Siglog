@extends('layouts.app')
@section('content')
    <div class="row">

        <div class="col-12">
            <a href="{{ route('lokasi.create') }}">
                <button type="button" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Lokasi</button>
            </a>
            <a href="{{ route('lokasi.daftar') }}">
                <button type="button" class="btn btn-primary"><i class="fas fa-list"></i> Daftar Lokasi</button>
            </a>
        </div>
    </div>
@endsection
