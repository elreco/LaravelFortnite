<?php

namespace elreco\LaravelFortnite\Endpoints;

class Status
{
    private $status = null;

    public function __construct($client)
    {
        $this->Client = $client;
    }

    /*
     * Server status (UP or DOWN)
     */
    public function status()
    {
        $this->fetch();

        return $this->status->status;
    }

    /*
     * Server message (Directly from Epic Games)
     */
    public function message()
    {
        $this->fetch();

        return $this->status->message;
    }

    /*
     * Fortnite version (something like v4.0, v4.1 etc.)
     */
    public function version()
    {
        $this->fetch();

        return $this->status->version;
    }

    /*
     * Get time.
     * type: since or duration
     * option: seconds
     */
    public function time($type = 'since', $option = 'seconds')
    {
        $this->fetch();

        return $this->status->time->$type->$option;
    }

    /*
     * Fetching the current server status.
     */
    public function fetch()
    {
        if ($this->status == null) {
            $return = json_decode($this->Client->httpCall('status/fortnite_server_status', []));

            if (isset($return->error)) {
                FortniteClient::Exception($return->errorMessage);
            } else {
                $this->status = $return;

                return $return;
            }
        }
    }
}
