<?php

namespace elreco\LaravelFortnite\Endpoints;

class PatchNotes
{
	public function __construct($client)
	{
		$this->Client = $client;
	}

	/*
	 * Patchnotes
	 */
	public function get()
	{
		$return = json_decode($this->Client->httpCall('patchnotes/get', []));

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
