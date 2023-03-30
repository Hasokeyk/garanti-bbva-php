<?php

    use Hasokeyk\GarantiBBVA\GarantiBBVA;

    require (__DIR__)."/vendor/autoload.php";

    $client_id     = "xxxxxxxxxxxxxxxxxxx";
    $client_secret = "xxxxxxxxxxxxxxxxxxx";
    $redirect_uri  = "https://domain-adresiniz.com/callback.php";

    $garanti = new GarantiBBVA($client_id, $client_secret, $redirect_uri);

    $consent_id = 'xxxxxxxx-xxxxxxx-xxxxxxx-xxxxxxxxxx';
    $start_date = date('Y-m-d\TH:i:s.B');
    $end_date   = date('Y-m-d\TH:i:s.B', strtotime('+1 month',strtotime($start_date)));

    $account = $garanti->get_account_transcations($consent_id, $start_date, $end_date);
    print_r($account);