<?php

    use Hasokeyk\GarantiBBVA\GarantiBBVA;

    require (__DIR__)."/vendor/autoload.php";

    $client_id     = "xxxxxxxxxxxxxxxxxxx";
    $client_secret = "xxxxxxxxxxxxxxxxxxx";
    $redirect_uri  = "https://domain-adresiniz.com/callback.php";

    $garanti = new GarantiBBVA($client_id, $client_secret, $redirect_uri);

    $consent_id = 'xxxxxxxx-xxxxxxx-xxxxxxx-xxxxxxxxxx';

    $account = $garanti->get_account_information($consent_id);
    print_r($account);