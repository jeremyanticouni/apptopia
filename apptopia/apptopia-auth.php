<?php

    function getToken($args)
    {
        $token = get_option('apptopia_token');
        $expires = get_option('apptopia_expires');
        $err;

        if (!empty($token) && !empty($expires) && $expires - time() > 0) {
            syslog(LOG_DEBUG, "Using cached token: $token");
            syslog(LOG_DEBUG, "Expires: ".secondsToTime($expires - time()));
        } else {
            if (!empty($token) && !empty($expires) && $expires - time() <= 0) {
                syslog(LOG_INFO, "Apptopia token expired; retrieving new token");
            } else {
                syslog(LOG_INFO, "No cached Apptopia token was found; retrieving new token");
            }
            $response = getNewToken($args);
            $err = "Error: Apptopia authentication failed: ".$response['headers']['http_code'];
            if ($response['code'] != 200) {
                syslog(LOG_ERR, $err);
            } else {
                $token = json_decode($response['body'])->{'token'};
                preg_match("/\"exp\":(\d+),/", base64_decode($token), $matches);
                $expires = intval($matches[1]);
                if (!empty($token)) {
                    update_option('apptopia_token', $token);
                    update_option('apptopia_expires', $expires);
                }
                syslog(LOG_INFO, "Got new token: $token");
                syslog(LOG_INFO, "Saved it: ".(get_option('apptopia_token')));
                syslog(LOG_INFO, "Expires: ".secondsToTime($expires - time()));
            }
        }

        return !empty($token) ? $token : $err;
    }

    function getNewToken($args) {
        $ch = curl_init();

        $url = $args['url'];
        $client_id = $args['client_id'];
        $client_secret = $args['client_secret'];

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "client=$client_id&secret=$client_secret");
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec ($ch);
        $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $code = $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $headers = parseHeaders(substr($response, 0, $header_size));
        $body = substr($response, $header_size);

        curl_close ($ch);

        return array('body' => $body, 'code' => $code, 'headers' => $headers);
    }

    function parseHeaders($response)
    {
        $headers = array();
        $header_text = substr($response, 0, strpos($response, "\r\n\r\n"));

        foreach (explode("\r\n", $header_text) as $i => $line)
            if ($i === 0) {
                $headers['http_code'] = $line;
            } else {
                list ($key, $value) = explode(': ', $line);

                $headers[$key] = $value;
            }
        return $headers;
    }

    function secondsToTime($seconds) {
        $dtF = new \DateTime('@0');
        $dtT = new \DateTime("@$seconds");
        return $dtF->diff($dtT)->format('%a days, %h hours, %i minutes and %s seconds');
    }

?>