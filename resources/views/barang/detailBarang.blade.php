@extends('layouts.app')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="invoice p-3 mb-3">
                        <div class="row">
                            <div class="col-12">
                                <h4>
                                    <b>{{ $barang->nama_barang }}</b>
                                    <small class="float-right">Tanggal barang ditambahkan :
                                        {{ $barang->created_at->format('Y-m-d') }}</small>
                                </h4>
                            </div>
                        </div>
                        <div class="row invoice-info">
                            <div class="col-sm-4 invoice-col">
                                Penyimpanan :
                                <address>
                                    <strong>{{ $barang->gudang->nama_gudang }}</strong><br>
                                    {{ $barang->gudang->keterangan }}<br>
                                </address>
                            </div>

                            <div class="col-sm-4 invoice-col">
                                Lokasi :
                                <address>
                                    <strong>{{ $barang->gudang->lokasi->nama_jalan }}</strong><br>
                                    {{ $barang->gudang->lokasi->alamat }}<br>
                                </address>
                            </div>



                            <div class="col-sm-4 invoice-col">
                                <b>Jenis :</b> {{ $barang->jenis->nama_jenis }}<br>
                                <b>Satuan :</b> {{ $barang->jenis->nama_satuan }}<br>
                            </div>

                        </div>


                        <div class="row">
                            <div class="col-12 table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Id barang</th>
                                            <th>Nama Barang</th>
                                            <th>Jenis</th>
                                            <th>penyimpanan</th>
                                            <th>Jumlah barang</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{ $barang->id_barang }}</td>
                                            <td>{{ $barang->nama_barang }}</td>
                                            <td>{{ $barang->jenis->nama_jenis }}</td>
                                            <td>{{ $barang->gudang->nama_gudang }}</td>
                                            <td>{{ $barang->jumlah }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-6">
                                <p class="lead">Payment Methods:</p>

                                <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                                    Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya
                                    handango imeem
                                    plugg
                                    dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
                                </p>
                            </div>

                            <div class="col-6">
                                <p class="lead">Amount Due 2/22/2014</p>
                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th style="width:50%">Subtotal:</th>
                                            <td>$250.30</td>
                                        </tr>
                                        <tr>
                                            <th>Tax (9.3%)</th>
                                            <td>$10.34</td>
                                        </tr>
                                        <tr>
                                            <th>Shipping:</th>
                                            <td>$5.80</td>
                                        </tr>
                                        <tr>
                                            <th>Total:</th>
                                            <td>$265.24</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                        </div>


                        <div class="row no-print">
                            <div class="col-12">
                                <a href="invoice-print.html" rel="noopener" target="_blank" class="btn btn-default"><i
                                        class="fas fa-print"></i> Print</a>
                                <button type="button" class="btn btn-success float-right"><i
                                        class="far fa-credit-card"></i> Submit
                                    Payment
                                </button>
                                <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                                    <i class="fas fa-download"></i> Generate PDF
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
