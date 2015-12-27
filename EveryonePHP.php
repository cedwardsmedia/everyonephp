<?php
class EveryonePHP {

    public $http;
    public $error; // Contains error messages

    public $sid; // EveryoneAPI Account SID
    public $token; // EveryoneAPI Account Auth Token

    public $query;  // Query Results Array

    function __construct() {
        $this->client = new \GuzzleHttp\Client();
    }

    public function query($phone, $data) {

        // Implode our $datapoints array into a comma-separated list
        if (isset($datapoints)) {
            $datapoints = implode(',', $data);
        }

        // Query EveryoneAPI and handle error-based HTTP Response Codes as exceptions
        try {
            $response = $this->client->get("http://api.everyoneapi.com/v".APIVersion."/phone/$phone?data=$datapoints&account_sid=".SID."&"."auth_token=".TOKEN."&");

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
