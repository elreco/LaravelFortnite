<?php

namespace elreco\LaravelFortnite\Endpoints;

class Weapons
{
	public function __construct($client)
	{
		$this->Client = $client;
	}

	public function get()
	{
		$return = json_decode($this->Client->httpCall('weapons/get', []));

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
