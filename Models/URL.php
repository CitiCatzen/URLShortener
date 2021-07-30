<?php

namespace Models;

use PDO;

class URL
{
    private $conn;
    private string $table_name = '';

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getOriginAddressByShort($short_url)
    {
        $query = "
            SELECT $this->table_name.origin_address
            FROM $this->table_name
            WHERE $this->table_name.short_address = '" . htmlspecialchars(strip_tags($short_url)) . "'
        ";

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt->fetch();
    }

    function create($attributes)
    {
        $origin_url = filter_var($attributes['url'], FILTER_VALIDATE_URL) ?
            htmlspecialchars(strip_tags($attributes['url'])) :
            'http://' . htmlspecialchars(strip_tags($attributes['url']));

        $short_url = $attributes['custom_url'] ?? bin2hex(random_bytes(5));
        $query = "
            INSERT $this->table_name(origin_address, short_address)
            VALUES (
                '" . $origin_url . "',
                '" . $short_url . "'
            )
        ";

        $stmt = $this->conn->prepare($query);

        if ($stmt->execute()) {
            return $short_url;
        }

        return false;
    }
}
