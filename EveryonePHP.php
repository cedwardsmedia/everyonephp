<?php

/*
 *  Copyright (c) 2015-2017, Corey Edwards
 *  All rights reserved.
 *
 *  Redistribution and use in source and binary forms, with or without modification, are permitted provided that the following conditions are met:
 *
 *  1. Redistributions of source code must retain the above copyright notice, this list of conditions and the following disclaimer.
 *
 *  2. Redistributions in binary form must reproduce the above copyright notice, this list of conditions and the following disclaimer in the documentation and/or other materials provided with the distribution.
 *
 *  3. Neither the name of the copyright holder nor the names of its contributors may be used to endorse or promote products derived from this software without specific prior written permission.
 *
 *  THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
*/

class EveryonePHP {

    public $sid; // EveryoneAPI account SID
    public $token; // EveryoneAPI account auth token
    private $query;  // Query function
    public $error; // Contains error messages
    public $results; // Contains results stdClass object


    function __construct() {
        $this->client = new \GuzzleHttp\Client();

        // Set which version of EveryoneAPI to use.
        define("APIVersion", "1");
    }

    public function query($phone, $data) {

        // Implode our $datapoints array into a comma-separated list
        if (isset($data)) {
            $datapoints = implode(',', $data);
        }

        // Query EveryoneAPI and handle error-based HTTP Response Codes as exceptions
        try {
            $response = $this->client->get("https://api.everyoneapi.com/v".APIVersion."/phone/$phone?data=$datapoints", ['auth' => [$this->sid, $this->token]]);

        } catch (Exception $exception) {
            if (strstr($exception->getMessage(), '400')) {
             $this->error = "HTTP 400 Bad Request: Invalid phone number.";
            } elseif (strstr($exception->getMessage(), '401')) {
             $this->error = "HTTP 401 Unauthorized: Check API credentials.";
            } elseif (strstr($exception->getMessage(), '402')) {
             $this->error = "HTTP 402 Payment Required: Check EveryoneAPI account balance.";
            } elseif (strstr($exception->getMessage(), '403')) {
             $this->error = "HTTP 403 Forbidden: You've been rate-limited.";
            } elseif (strstr($exception->getMessage(), '404')) {
             $this->error = "HTTP 404 Not Found: Phone number not found in EveryoneAPI database.";
            } elseif (strstr($exception->getMessage(), '500')) {
                $this->error = "HTTP 500 Internal Server Error: EveryoneAPI is currently experiencing technical difficulties.";
            } elseif (strstr($exception->getMessage(), '503')) {
                $this->error = "HTTP 503 Service Unavailable: EveryoneAPI is currently experiencing service outages.";
            } elseif (strstr($exception->getMessage(), 'cURL error 6')) {
		$this->error = "cURL error 6 - Could not resolve host api.everyoneapi.com";
            } elseif (strstr($exception->getMessage(), 'cURL error 5')) {
		$this->error = "cURL error 5 - Could not resolve proxy";
            } else {
                $this->error = "An error as occurred. GuzzleHttp said: " . $exception->getMessage();
            }

            return null;
        }

        // Convert the EveryoneAPI JSON response to a PHP Array
        $this->results = json_decode($response->getBody());

        // Return the Query Results Array
        return $this->results;
    }
}
