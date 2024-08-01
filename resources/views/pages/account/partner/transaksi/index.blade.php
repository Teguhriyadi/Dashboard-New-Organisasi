@extends('pages.layouts.main')

{{-- @section('title', 'Lihat Transaksi') --}}

@section("component-css")
<link href="{{ URL::asset('template') }}/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="{{ URL::asset('template') }}/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
<link href="{{ URL::asset('template') }}/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
<link href="{{ URL::asset('template') }}/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
<link href="{{ URL::asset('template') }}/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
@endsection

{{-- @section('content-page')

    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>
                    @yield('title')
                </h3>
            </div>
        </div>

        <div class="clearfix"></div>

        @if (session('success'))
            <div class="alert alert-success text-uppercase">
                <strong>Berhasil</strong>, {!! session('success') !!}
            </div>
        @elseif(session('error'))
            <div class="alert alert-danger text-uppercase">
                <strong>Gagal</strong>, {!! session('error') !!}
            </div>
        @endif

        <a href="{{ route('pages.accounts.partner.index', ['name' => $name]) }}" class="btn btn-danger btn-sm">
            <i class="fa fa-sign-out"></i> Kembali
        </a>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>
                            Transaksi Data
                        </h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table id="datatable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">ID Institusi</th>
                                    <th>Nama</th>
                                    <th class="text-center">Nomor HP</th>
                                    <th class="text-center">Total Responder</th>
                                    <th class="text-center">ID Unique Institution</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection --}}


@section('content-page')
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>
                    @yield('title')
                </h3>
            </div>
        </div>

        <div class="clearfix"></div>

        @if (session('success'))
            <div class="alert alert-success text-uppercase">
                <strong>Berhasil</strong>, {!! session('success') !!}
            </div>
        @elseif(session('error'))
            <div class="alert alert-danger text-uppercase">
                <strong>Gagal</strong>, {!! session('error') !!}
            </div>
        @endif

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>
                            <i class="fa fa-money"></i>
                            Transaksi Pembayaran
                        </h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="" role="tabpanel" data-example-id="togglable-tabs">
                            <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                                <li role="presentation" class="active">
                                    <a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab"
                                        aria-expanded="true">
                                        Paket Umum
                                    </a>
                                </li>
                                <li role="presentation" class="">
                                    <a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab"
                                        aria-expanded="false">
                                        Paket Organisasi
                                    </a>
                                </li>
                            </ul>
                            <div id="myTabContent" class="tab-content">
                                <div role="tabpanel" class="tab-pane fade active in" id="tab_content1"
                                    aria-labelledby="home-tab">
                                    <table id="datatable1" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="text-center">No</th>
                                                <th class="text-center">External ID</th>
                                                <th>Nama Pembeli</th>
                                                <th>Nama Responder</th>
                                                <th class="text-center">Nama Paket</th>
                                                <th class="text-center">Status Transaksi</th>
                                                <th class="text-center">Harga</th>
                                                <th class="text-center">
                                                    {{session('data')['nama']}}
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $nomer = 0;
                                            @endphp
                                            @foreach ($umum as $item)
                                                <tr>
                                                    <td class="text-center">{{ ++$nomer }}.</td>
                                                    <td class="text-center">{{ $item['invoice_id'] }}</td>
                                                    <td>{{ $item['name'] }}</td>
                                                    <td>{{ $item['nama_responder'] }}</td>
                                                    <td class="text-center">{{ $item['nama_paket'] }}</td>
                                                    <td class="text-center">{{ $item['status_transaksi'] }}</td>
                                                    <td class="text-center">Rp. {{ number_format($item['amount']) }}</td>
                                                    <td class="text-center">{{ $item['nama_institusi'] }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
                                    <table id="datatable2" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="text-center">No</th>
                                                <th class="text-center">External ID</th>
                                                <th>Nama Pembeli</th>
                                                <th>Nama Responder</th>
                                                <th class="text-center">Nama Paket</th>
                                                <th class="text-center">Status Transaksi</th>
                                                <th class="text-center">Harga</th>
                                                <th class="text-center">
                                                    {{session('data')['nama']}}
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $nomerOrganisasi = 0;
                                            @endphp
                                            @foreach ($organisasi as $item)
                                                <tr>
                                                    <td class="text-center">{{ ++$nomerOrganisasi }}.</td>
                                                    <td class="text-center">{{ $item['invoice_id'] }}</td>
                                                    <td>{{ $item['name'] }}</td>
                                                    <td>{{ $item['nama_responder'] }}</td>
                                                    <td class="text-center">{{ $item['nama_paket'] }}</td>
                                                    <td class="text-center">{{ $item['status_transaksi'] }}</td>
                                                    <td class="text-center">Rp. {{ number_format($item['amount']) }}</td>
                                                    <td class="text-center">{{ $item['nama_institusi'] }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@section("component-js")
<script src="{{ URL::asset('template') }}/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="{{ URL::asset('template') }}/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="{{ URL::asset('template') }}/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
<script src="{{ URL::asset('template') }}/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{ URL::asset('template') }}/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
@endsection
