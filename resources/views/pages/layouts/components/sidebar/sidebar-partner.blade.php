@php
    use App\Http\Helper\ApiHelper;
    use GuzzleHttp\Client;

    $client = new Client([
        'timeout' => 10,
    ]);

    $data = [];

    $responder = $client->post(
        ApiHelper::apiUrl('/organization/partner/' . session('data')['username'] . '/check_add_institution'),
    );

    $responderBody = json_decode($responder->getBody(), true);

    $listmenu = $responderBody['data'];

@endphp


<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        <h3>Menu</h3>
        <ul class="nav side-menu">
            <li>
                <a href="{{ route('pages.dashboard') }}">
                    <i class="fa fa-home"></i> Dashboard
                </a>
            </li>
            @if (session('data')['account_category'] == 'PARTNER')
                <li>
                    <a>
                        <i class="fa fa-money"></i> Transaksi
                        <span class="fa fa-chevron-down"></span>
                    </a>
                    <ul class="nav child_menu">
                        <li>
                            <a href="{{ route('pages.transaction.history-payment.index') }}"> Riwayat </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a>
                        <i class="fa fa-money"></i> Responder
                        <span class="fa fa-chevron-down"></span>
                    </a>
                    <ul class="nav child_menu">
                        <li>
                            <a href="{{ route('pages.transaction.history-payment.index') }}"> Akun </a>
                        </li>
                    </ul>
                </li>
            @endif
            <li>
                <a>
                    <i class="fa fa-users"></i> Akun
                    <span class="fa fa-chevron-down"></span>
                </a>
                <ul class="nav child_menu">
                    @foreach ($listmenu as $item)
                        <li>
                            <a href="{{ route('pages.accounts.partner.index', ['name' => $item['menu']]) }}">
                                {{ $item['menu'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </li>
            <li>
                <a>
                    <i class="fa fa-gears"></i> Pengaturan
                    <span class="fa fa-chevron-down"></span>
                </a>
                <ul class="nav child_menu">
                    <li>
                        <a href="{{ route('pages.account.profil.index') }}">Profil Saya</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>

</div>
