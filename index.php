<?php

    use Hasokeyk\GarantiBBVA\GarantiBBVA;

    require (__DIR__)."/vendor/autoload.php";

    $client_id     = "l73f53e7e4b4b54f6aa7e49d825d79f8b7";
    $client_secret = "feae7d0338d34a4a91775e1198cd7574";
    $redirect_uri  = "https://hayatikodla.net/garanti-callback.php";

    $garanti = new GarantiBBVA($client_id, $client_secret, $redirect_uri);

    $consent_id = '3e09da8a-ae9c-50bc-b34a-c61531729dbe';
    $start_date = date('Y-m-d\TH:i:s.B');
    $end_date   = date('Y-m-d\TH:i:s.B', strtotime('+1 month',strtotime($start_date)));

    $start_date = '2023-12-25T12:53:07.867';
    $end_date   = '2020-12-25T17:53:07.867';

    $account = $garanti->get_account_transcations($consent_id, $start_date, $end_date);
    print_r($account);