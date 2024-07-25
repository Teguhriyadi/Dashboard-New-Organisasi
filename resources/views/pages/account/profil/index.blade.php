@extends('pages.layouts.main')

@section('title', 'Profil Saya')

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
            @foreach ($currentPaket as $item)
                <div class="col-md-4 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_content">
                            <form
                                action="{{ route('pages.account.profil.upgradePaket', ['member_account_code' => session('data.member_account_code')]) }}"
                                method="POST">
                                @csrf
                                @method("PUT")
                                <input type="hidden" name="id_master_paket_organization" id="id_master_paket_organization" value="{{ $item["id_master_paket_organization"] }}">
                                <center>
                                    <div class="x_title">
                                        <h2>
                                            {{ $item["nama_paket"] == "Video Call" ? "GOLD" : "SILVER" }}
                                        </h2>
                                        <div class="clearfix"></div>
                                    </div>
                                </center>
                                <p>
                                    Nama Paket : {{ $item["nama_paket"] }}
                                    <br>
                                    Limit User : {{ $item["limit_user"] }}
                                    <br>
                                    Limit Kontak : {{ $item["limit_contact"] }}
                                    <br>
                                    Harga : Rp. {{ number_format($item["amount"]) }}
                                    <br>
                                    Mengikuti : {{ $item["durationDate"] }} Hari
                                </p>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success btn-sm btn-block">
                                        <i class="fa fa-edit"></i> Upgrade Paket
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="row">
            <div class="col-md-7 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>
                            Data @yield('title')
                        </h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <form
                            action="{{ route('pages.account.profil.update', ['member_account_code' => session('data.member_account_code')]) }}"
                            method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="nama" class="form-label"> Nama </label>
                                <input type="text" class="form-control" name="nama" id="nama"
                                    placeholder="Masukkan Nama" value="{{ old('nama', $detail['nama']) }}">
                            </div>
                            <div class="form-group">
                                <label for="username" class="form-label"> Username </label>
                                <input type="username" class="form-control" name="username" id="username"
                                    placeholder="Masukkan Username" value="{{ old('username', $detail['username']) }}"
                                    readonly>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="member_account_code" class="form-label"> Kode Member Akun </label>
                                        <input type="number" class="form-control" name="member_account_code"
                                            id="member_account_code" placeholder="Masukkan Kode Member Akun" min="1"
                                            value="{{ old('member_account_code', $detail['member_account_code']) }}"
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="phone_number" class="form-label"> Nomor HP </label>
                                        <input type="number" class="form-control" name="phone_number" id="phone_number"
                                            placeholder="Masukkan Nomor HP"
                                            value="{{ old('phone_number', $detail['phone_number']) }}">
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group">
                                <button type="reset" class="btn btn-danger btn-sm">
                                    <i class="fa fa-times"></i> Batal
                                </button>
                                <button type="submit" class="btn btn-success btn-sm">
                                    <i class="fa fa-save"></i> Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-5 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>
                            <i class="fa fa-edit"></i> Ganti Password
                        </h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <form
                            action="{{ route('pages.account.profil.change-password', ['member_acccount_code' => session('data.member_account_code')]) }}"
                            method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="form-group">
                                <label for="old_password" class="form-label"> Password Lama </label>
                                <input type="password" class="form-control" name="old_password" id="old_password"
                                    placeholder="Masukkan Password Lama">
                            </div>
                            <div class="form-group">
                                <label for="new_password" class="form-label"> Password Baru </label>
                                <input type="password" class="form-control" name="new_password" id="new_password"
                                    placeholder="Masukkan Password Baru">
                            </div>
                            <div class="form-group">
                                <label for="confirm_password" class="form-label"> Konfirmasi Password </label>
                                <input type="password" class="form-control" name="confirm_password" id="confirm_password"
                                    placeholder="Masukkan Konfirmasi Password">
                            </div>
                            <hr>
                            <div class="form-group">
                                <button type="reset" class="btn btn-danger btn-sm">
                                    <i class="fa fa-times"></i> Batal
                                </button>
                                <button type="submit" class="btn btn-success btn-sm">
                                    <i class="fa fa-save"></i> Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
