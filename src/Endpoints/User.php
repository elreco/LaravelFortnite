<?php

namespace elreco\LaravelFortnite\Endpoints;

class User
{
    private $windows = ['alltime', 'season4', 'season5', 'season6', 'season7'];
    public $uid = null;

    public function __construct($client)
    {
        $this->Client = $client;
    }

    /*
     * Get user id out of an username.
     */
    public function id($username = '')
    {
        if (! empty($username)) {
            $return = json_decode($this->Client->httpCall('users/id', ['username' => urlencode($username)]));

            if (isset($return->error)) {
                return $return->errorMessage;
            } else {
                $this->uid = $return->uid;

                return $return;
            }
        }

        return 'Invalid username.';
    }

    /*
     * Get user devices - returns an array.
     */
    public function getDevices($username = '')
    {
        if (! empty($username)) {
            $return = json_decode($this->Client->httpCall('users/id', ['username' => urlencode($username)]));

            if (isset($return->error)) {
                return $return->errorMessage;
            } else {
                return $return->platforms;
            }
        }

        return 'Invalid username.';
    }

    /*
     * Get username out of an user id (can be multiple in an array)
     */
    public function getUsernameFromId($ids = null)
    {
        if (! empty($ids) && is_array($ids)) {
            $return = json_decode($this->Client->httpCall('users/username%20out%20of%20id', ['ids' => $ids]));

            if (isset($return->error)) {
                return $return->errorMessage;
            } else {
                return $return;
            }
        }

        return 'Usernames are invalid.';
    }

    /*
     * Get the user stats.
     */
    public function stats($platform = 'pc', $window = 'alltime')
    {
        (empty($user_id) && ! empty($this->uid)) ? $user_id = $this->uid : '';
        (! in_array($window, $this->windows)) ? $window = 'alltime' : '';

        if (! empty($user_id) && ! empty($platform)) {
            $return = json_decode($this->Client->httpCall('users/public/br_stats_v2', ['user_id' => $user_id, 'platform' => $platform, 'window' => $window]));

            if (isset($return->error)) {
                return $return->errorMessage;
            } else {
                return $return;
            }
        }

        return 'Invalid user id.';
    }

    /*
     * Match tracking - We can only show cached matches that are cached by using stats(). The first time asking for user matches can take a while because we are calculating all matches.
     */
    public function matches($platform = 'pc', $window = 'alltime', $rows = 15)
    {
        (empty($user_id) && ! empty($this->uid)) ? $user_id = $this->uid : '';
        (! in_array($window, $this->windows)) ? $window = 'alltime' : '';
        (! is_numeric($rows)) ? $rows = 15 : '';

        if (! empty($user_id) && ! empty($platform) && ! empty($rows)) {
            $return = json_decode($this->Client->httpCall('users/public/matches', ['user_id' => $user_id, 'platform' => $platform, 'window' => $window, 'rows' => $rows]));

            if (isset($return->error)) {
                return $return->errorMessage;
            } else {
                return $return;
            }
        }

        return 'Invalid user id.';
    }
}
