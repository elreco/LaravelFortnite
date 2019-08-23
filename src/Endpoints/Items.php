<?php

namespace elreco\LaravelFortnite\Endpoints;

class Items
{
    public function __construct($client)
    {
        $this->Client = $client;
    }

    /*
     * Get the current store (BR)
     */
    public function store()
    {
        $return = json_decode($this->Client->httpCall('store/get', ['language' => 'en']));

        if (isset($return->error)) {
            return $return->errorMessage;
        } else {
            return $return;
        }
    }

    /*
     * Get the upcoming items (BR)
     */
    public function upcoming()
    {
        $return = json_decode($this->Client->httpCall('upcoming/get', ['language' => 'en']));

        if (isset($return->error)) {
            return $return->errorMessage;
        } else {
            return $return;
        }
    }

    /*
     * Search for Fortnite BR items.
     * Note: This is not connected with your Authorization key. It's free to use and doesn't have any limits.
     */
    public function search($name = '')
    {
        $return = json_decode($this->Client->httpCall('https://fortnite-public-files.theapinetwork.com/search?query='.urlencode($name), [], true));

        if (isset($return->error)) {
            return $return->msg;
        } else {
            return $return;
        }
    }
}
