<?php

namespace Requests;

use Configs\Database;
use Models\URL;

class URLRequest
{
    public static function validate($request)
    {
        if (empty($request['url'])) {
            return ['error' => 'Please, provide url'];
        }

        if (isset($request['custom_url'])) {
            if (empty($request['custom_url'])) {
                unset($request['custom_url']);
                return $request;
            }

            $database = new Database();
            $db = $database->getConnection();

            if ((new URL($db))->getOriginAddressByShort($request['custom_url'])) {
                return ['error' => 'This url is busy'];
            }
            if (filter_var($request['custom_url'], FILTER_VALIDATE_URL)) {
                return ['error' => 'Please, provide valid custom url'];
            }
        }

        return $request;
    }
}
