<?php
class ResponseService
{
    /** Responds with status `200 OK` */
    public static function ok($payload)
    {
        return json_encode([
            'status' => 200,
            'payload' => $payload
        ]);
    }

    /** Responds with status `201 Created` */
    public static function created($payload)
    {
        return json_encode([
            'status' => 201,
            'payload' => $payload
        ]);
    }

    /** Responds with status `404 Created` */
    public static function notFound($payload)
    {
        return json_encode([
            'status' => 404,
            'payload' => $payload
        ]);
    }
}