<?php

namespace Elreco\LaravelFortnite;

use Elreco\LaravelFortnite\Endpoints as Endpoints;

class LaravelFortnite
{
    private $client_version = 3.1;
    private $api_endpoint = 'https://fortnite-public-api.theapinetwork.com/prod09/';
    private $api_version = 'v1.1';
    private $pem_path;
    protected $ch;
    public $auth;
    public $challenges;
    public $items;
    public $leaderboard;
    public $news;
    public $patchnotes;
    public $pve;
    public $status;
    public $user;
    public $weapons;

    public function __construct()
    {
        $this->auth = new Endpoints\Auth($this);
        $this->challenges = new Endpoints\Challenges($this);
        $this->items = new Endpoints\Items($this);
        $this->leaderboard = new Endpoints\Leaderboard($this);
        $this->news = new Endpoints\News($this);
        $this->patchnotes = new Endpoints\PatchNotes($this);
        $this->pve = new Endpoints\PVE($this);
        $this->status = new Endpoints\Status($this);
        $this->user = new Endpoints\User($this);
        $this->weapons = new Endpoints\Weapons($this);

        $this->pem_path = realpath(__DIR__.'/../cacert.pem');
    }

    public function setKey($key = '')
    {
        $this->auth->setKey($key);
    }

    public static function Exception($err = '')
    {
        die($err);
    }

    public function httpCall($method = '', $fields = '', $custom = false)
    {
        if (empty($this->auth->auth)) {
            // API key is not needed anymore.
            $this->auth->auth = '';
            //FortniteClient::Exception('You have not set an API key. Use setKey() to set the API key.');
        }
        if (empty($this->ch) || ! function_exists('curl_reset')) {
            $this->ch = curl_init();
        } else {
            curl_reset($this->ch);
        }
        if ($custom == false) {
            $url = $this->api_endpoint.$method;
        } else {
            $url = $method;
        }
        curl_setopt($this->ch, CURLOPT_URL, $url);
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->ch, CURLOPT_TIMEOUT, 30);
        $headers = [
            'Authorization: '.$this->auth->auth,
            'X-Fortnite-API-Version: '.$this->api_version,
            'X-Fortnite-Client-Info: '.php_uname(),
            'X-Fortnite-Client-Version: '.$this->client_version,
        ];
        curl_setopt($this->ch, CURLOPT_POST, 1);
        curl_setopt($this->ch, CURLOPT_POSTFIELDS, http_build_query($fields));
        curl_setopt($this->ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($this->ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($this->ch, CURLOPT_CAINFO, $this->pem_path);
        $body = curl_exec($this->ch);
        $this->response_code = curl_getinfo($this->ch, CURLINFO_HTTP_CODE);
        if (curl_errno($this->ch)) {
            $msg = 'Unable to communicate with Fortnite API ('.curl_errno($this->ch).'): '.curl_error($this->ch).'.';
            $this->unsetHttpCall();
            FortniteClient::Exception($msg);
        }
        if (! function_exists('curl_reset')) {
            $this->unsetHttpCall();
        }
        if ($this->response_code != 200) {
            FortniteClient::Exception('Something wen\'t wrong. We couldn\'t give you an 200 header back. - '.$this->response_code);
        }

        return $body;
    }

    private function unsetHttpCall()
    {
        if (is_resource($this->ch)) {
            curl_close($this->ch);
            $this->ch = null;
        }
    }

    public function __destruct()
    {
        $this->unsetHttpCall();
    }
}
