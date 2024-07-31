@extends('pages.layouts.main')

@section('title', 'Responder ' . session('data')['nama'])

@section("component-css")
<link href="{{ URL::asset('template') }}/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="{{ URL::asset('template') }}/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
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

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    {{-- <div class="x_title">
                        <h2>
                            Data @yield('title')
                        </h2>
                        <div class="clearfix"></div>
                    </div> --}}
                    <div class="x_content">
                        <table id="datatable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th class="text-center">Nomor HP</th>
                                    <th class="text-center">ID Institusi</th>
                                    <th class="text-center">ID Unique Responder</th>
                                    <th class="text-center">Waktu Registrasi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $nomer = 0;
                                @endphp
                                @foreach ($akun as $item)
                                <tr>
                                    <td class="text-center">{{ ++$nomer }}.</td>
                                    <td>{{ $item["name"] }}</td>
                                    <td>{{ $item["email"] }}</td>
                                    <td class="text-center">{{ $item['country_code'] }} {{ $item['phone_number'] }}</td>
                                    <td class="text-center">{{ $item["institution_id"] }}</td>
                                    <td class="text-center">{{ $item["unique_responder_id"] }}</td>
                                    <td class="text-center">{{ $item["register_at"] }}</td>
                                </tr>
                                @endforeach
                            </tbody>
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
<script src="{{ URL::asset('template') }}/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{ URL::asset('template') }}/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
@endsection
