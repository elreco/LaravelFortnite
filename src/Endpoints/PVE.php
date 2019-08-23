<?php

namespace elreco\LaravelFortnite\Endpoints;

class PVE
{
	public function __construct($client)
	{
		$this->Client = $client;
	}

	/*
	 * Get the current PVE info.
	 */
	public function info()
	{
		$return = json_decode($this->Client->httpCall('pveinfo/get', []));

		if(isset($return->error))
		{
			return $return->errorMessage;
		}
		else
		{
			return $return;
		}
	}
}

?>
