<?php

    namespace Hasokeyk\GarantiBBVA;

    class GarantiBBVA{

        public $base_url = 'https://apis.garantibbva.com.tr';

        public $client_id;
        public $client_secret;
        public $redirect_uri;

        function __construct($client_id, $client_secret, $redirect_uri){
            $this->client_id     = $client_id;
            $this->client_secret = $client_secret;
            $this->redirect_uri  = $redirect_uri;
        }

        public function request(){
            return new GarantiBBVARequest($this->client_id, $this->client_secret, $this->redirect_uri);
        }

        public function get_token(){

            $url = $this->base_url.'/auth/oauth/v2/token';

            $post_data = [
                'grant_type'    => 'client_credentials',
                'client_id'     => $this->client_id,
                'client_secret' => $this->client_secret,
                'redirect_uri'  => $this->redirect_uri,
                //                'scope'         => 'accounts',
            ];

            $url = $url.'?'.http_build_query($post_data);

            $request = $this->request()->get($url);

            if($request['status'] == 'ok'){
                return json_decode($request['body']);
            }

            return $request;

        }

        public function get_account_information($consent_id){

            $url = $this->base_url.'/balancesandmovements/accountinformation/account/v1/getaccountinformation';

            $post_data['body'] = [
                'consentId' => $consent_id,
            ];

            $get_token = $this->get_token();

            $headers = $this->request()->get_default_header(true, $get_token->access_token);

            $request = $this->request()->post($url, $post_data, $headers);

            if($request['status'] == 'ok'){
                return json_decode($request['body']);
            }

            return $request;

        }

        public function get_account_transcations($consent_id, $start_date, $end_date){

            $url = $this->base_url.'/balancesandmovements/accountinformation/transaction/v1/gettransactions';

            $post_data['body'] = [
                'consentId' => $consent_id,
                'startDate' => $start_date,
                'endDate'   => $end_date,
            ];

            $get_token = $this->get_token();

            $headers = $this->request()->get_default_header(true, $get_token->access_token);

            $request = $this->request()->post($url, $post_data, $headers);

            if($request['status'] == 'ok'){
                return json_decode($request['body']);
            }

            return $request;

        }

    }