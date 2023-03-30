<?php

    namespace Hasokeyk\GarantiBBVA;

    use GuzzleHttp\Client;
    use GuzzleHttp\Exception\GuzzleException;

    class GarantiBBVARequest{

        private $client;

        public $client_id;
        public $client_secret;
        public $redirect_uri;
        public $user_agent = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36';

        function __construct($client_id, $client_secret, $redirect_uri){

            $this->client_id     = $client_id;
            $this->client_secret = $client_secret;
            $this->redirect_uri  = $redirect_uri;

            $this->client = new Client([
                'verify' => false,
            ]);
        }

        public function get_default_header($auth = false,$token = null){

            $headers = [
                'User-Agent' => $this->user_agent,
                'Accept'     => 'application/json',
            ];

            if($auth){
                $headers['Authorization'] = 'Bearer '.($token);
            }

            return $headers;
        }

        public function post($url = null, $post_data = null, $headers = null, $cookie = [], $proxy_use = true){
            try{

                $headers = $headers ?? $this->get_default_header();
                $options = [
                    'headers' => $headers,
                    'version' => 2,
                ];

                if(isset($post_data['body']) and is_array($post_data['body'])){
                    $options['json'] = ($post_data['body']);
                }
                else{
                    $options['form_params'] = ($post_data ?? null);
                }
                
                $res = $this->client->post($url, $options);
                return [
                    'status'  => 'ok',
                    'headers' => $res->getHeaders() ?? null,
                    'body'    => $res->getBody()->getContents(),
                ];
            }catch(GuzzleException $exception){
                return [
                    'status'  => 'fail',
                    'message' => $exception->getMessage() ?? 'Empty',
                    'headers' => $exception->getResponse()->getHeaders() ?? null,
                    'body'    => $exception->getResponse()->getBody()->getContents() ?? null,
                ];
            }
        }

        public function get($url = null, $headers = null, $cookie = [], $proxy_use = true){
            try{
                $headers = $headers ?? $this->get_default_header();
                $options = [
                    'headers' => $headers,
                    'version' => 2,
                ];

                $res = $this->client->get($url, $options);
                return [
                    'status'  => 'ok',
                    'headers' => $res->getHeaders() ?? null,
                    'body'    => $res->getBody()->getContents(),
                ];
            }catch(GuzzleException $exception){
                return [
                    'status'  => 'fail',
                    'message' => $exception->getMessage() ?? 'Empty',
                    'headers' => $exception->getResponse()->getHeaders() ?? null,
                    'body'    => $exception->getResponse()->getBody()->getContents() ?? null,
                ];
            }
        }

    }