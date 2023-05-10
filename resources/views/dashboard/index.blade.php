@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-lg-3 col-6">    
        <div class="small-box bg-info">
            <div class="inner">
                <h3>150</h3>
                <p>Stok Barang</p>
            </div>
        <div class="icon">
            <i class="ion ion-bag"></i>
        </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    
    <div class="col-lg-3 col-6">    
        <div class="small-box bg-success">
            <div class="inner">
                <h3>53</h3>
                <p>Barang Masuk</p>
            </div>
        <div class="icon">
            <i class="ion ion-stats-bars"></i>
        </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    
    <div class="col-lg-3 col-6">    
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>44</h3>
                <p>Barang Keluar</p>
            </div>
        <div class="icon">
            <i class="ion ion-person-add"></i>
        </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    
    <div class="col-lg-3 col-6">    
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>65</h3>
                <p>Permintaan</p>
            </div>
        <div class="icon">
            <i class="ion ion-pie-graph"></i>
        </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>    
</div>
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>

                    <p class="card-text">
                        Some quick example text to build on the card title and make up the bulk of the
                        card's
                        content.
                    </p>

                    <a href="#" class="card-link">Card link</a>
                    <a href="#" class="card-link">Another link</a>
                </div>
            </div>

            <div class="card card-primary card-outline">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>

                    <p class="card-text">
                        Some quick example text to build on the card title and make up the bulk of the
                        card's
                        content.
                    </p>
                    <a href="#" class="card-link">Card link</a>
                    <a href="#" class="card-link">Another link</a>
                </div>
            </div><!-- /.card -->
        </div>
        <!-- /.col-md-6 -->
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="m-0">Featured</h5>
                </div>
                <div class="card-body">
                    <h6 class="card-title">Special title treatment</h6>

                    <p class="card-text">With supporting text below as a natural lead-in to additional
                        content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>

            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h5 class="m-0">Featured</h5>
                </div>
                <div class="card-body">
                    <h6 class="card-title">Special title treatment</h6>

                    <p class="card-text">With supporting text below as a natural lead-in to additional
                        content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        </div>
        <!-- /.col-md-6 -->
    </div>
@endsection