<?php

namespace Controllers;

use Requests\URLRequest;
use Models\URL;

class URLController
{
    private URL $model;

    public function __construct($db)
    {
        $this->model = new URL($db);
    }

    public function store($request)
    {
        $attributes = URLRequest::validate($request);
        if (isset($attributes['error'])) {
            return $attributes;
        }

        return [
            'success' => true,
            'short_url' => $this->model->create($attributes),
        ];
    }

    public function show($short_url)
    {
        $origin_url = $this->model->getOriginAddressByShort($short_url);

        if ($origin_url) {
            header("Location: {$origin_url['origin_address']}");
            return $origin_url['origin_address'];
        }

        return ['error' => "You've entered an invalid URL"];
    }
}
