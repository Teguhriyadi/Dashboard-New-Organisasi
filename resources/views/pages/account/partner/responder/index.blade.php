@extends('pages.layouts.main')

@section('title', 'Detail Akun POLSEK')

@section("component-css")
<link href="{{ URL::asset('template') }}/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="{{ URL::asset('template') }}/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
<link href="{{ URL::asset('template') }}/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
<link href="{{ URL::asset('template') }}/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
<link href="{{ URL::asset('template') }}/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
@endsection

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

        <a href="" class="btn btn-danger btn-sm">
            <i class="fa fa-sign-out"></i> Kembali
        </a>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>
                            Data POLSEK
                        </h2>
                        <button type="button" class="btn btn-primary pull-right" data-toggle="modal"
                            data-target=".bs-example-modal-lg">
                            <i class="fa fa-plus"></i> Tambah
                        </button>
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

@endsection

@section("component-js")
<script src="{{ URL::asset('template') }}/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="{{ URL::asset('template') }}/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="{{ URL::asset('template') }}/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
<script src="{{ URL::asset('template') }}/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{ URL::asset('template') }}/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
@endsection
