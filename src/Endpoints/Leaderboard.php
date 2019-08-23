<?php

namespace elreco\LaravelFortnite\Endpoints;

class Leaderboard
{
    private $windows = ['kills', 'wins', 'matches', 'score'];

    public function __construct($client)
    {
        $this->Client = $client;
    }

    /*
     * Top 20.000.000 most wins, kills, score, or matches played.
     */
    public function worldwide($users_per_page = 100, $offset = 0, $window = 'kills')
    {
        if (in_array($window, $this->windows)) {
            $return = json_decode($this->Client->httpCall('leaderboards/worldwide', ['users_per_page' => $users_per_page, 'offset' => $offset, 'window' => $window]));

            if (isset($return->error)) {
                return $return->errorMessage;
            } else {
                return $return;
            }
        }

        return 'Invalid window.';
    }
}
