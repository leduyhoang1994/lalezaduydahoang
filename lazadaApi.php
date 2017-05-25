<?php
class LazadaApi
{
    private $url        = "https://api.sellercenter.lazada.vn";
    private $parameters = array();
// Must be an API key associated with the UserID parameter.
    private $api_key = '2ax2-Tk9348TbzB_9yWIxe6uneCM2P4vxU20gxhtKS72HUHkOxao4qW3';
    public function getData($params)
    {
        // Pay no attention to this statement.
        // It's only needed if timezone in php.ini is not set correctly.
        date_default_timezone_set("UTC");
// The current time. Needed to create the Timestamp parameter below.
        $now = new DateTime();
// The parameters for our GET request. These will get signed.
        $this->parameters = array(
            // The user ID for which we are making the call.
            'UserID'    => 'langnhachkiem82@yahoo.com',
            // The API version. Currently must be 1.0
            'Version'   => '1.0',
            // The format of the result.
            'Format'    => 'JSON',
            // The current time formatted as ISO8601
            'Timestamp' => $now->format(DateTime::ISO8601),
        );
        $this->parameters = array_merge($this->parameters, $params);

        // Sort parameters by name.
        ksort($this->parameters);

        // URL encode the parameters.
        $encoded = array();
        foreach ($this->parameters as $name => $value) {
            $encoded[] = rawurlencode($name) . '=' . rawurlencode($value);
        }

// Concatenate the sorted and URL encoded parameters into a string.
        $concatenated = implode('&', $encoded);
// Compute signature and add it to the parameters.
        $this->parameters['Signature'] =
            rawurlencode(hash_hmac('sha256', $concatenated, $this->api_key, false));
// Build Query String
        $queryString = http_build_query($this->parameters, '', '&', PHP_QUERY_RFC3986);
// Open cURL connection
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->url . "?" . $queryString);
// Save response to the variable $data
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $data = curl_exec($ch);
// Close Curl connection
        curl_close($ch);
        header('Content-Type: application/json; charset=utf-8');
        die($data);
    }

}
