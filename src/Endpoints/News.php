<?php

namespace elreco\LaravelFortnite\Endpoints;

class News
{
	public function __construct($client)
	{
		$this->Client = $client;
	}

	/*
	 * Last 15 news messages.
	 */
	public function get($type = 'br', $language = 'en')
	{
		$type = ((empty($type)) ? 'br' : $type);

		$return = json_decode($this->Client->httpCall($type . '_motd/get', ['language' => $language]));

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
