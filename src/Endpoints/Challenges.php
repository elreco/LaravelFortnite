<?php

namespace elreco\LaravelFortnite\Endpoints;

class Challenges
{
	public function __construct($client)
	{
		$this->Client = $client;
	}

	public function get($season = 'season4', $language = 'en')
	{
		if(empty($season) || empty($language))
		{
			return 'Please enter a season and language.';
		}
		else
		{
			$return = json_decode($this->Client->httpCall('challenges/get', ['season' => $season, 'language' => $language]));

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
}

?>
