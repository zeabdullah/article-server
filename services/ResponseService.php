<?php
class ResponseService
{

    private static function jsonResponse(int $statusCode, mixed $payload)
    {
        return json_encode([
            'status' => $statusCode,
            'payload' => $payload
        ]);
    }

    /** Responds with status `200 OK` */
    public static function ok($payload)
    {
        return self::jsonResponse(200, $payload);
    }

    /** Responds with status `201 Created` */
    public static function created($payload)
    {
        return self::jsonResponse(201, $payload);
    }

    /** Responds with status `400 Bad Request` */
    public static function badRequest($payload)
    {
        return self::jsonResponse(400, $payload);
    }

    /** Responds with status `404 Not Found` */
    public static function notFound($payload)
    {
        return self::jsonResponse(404, $payload);
    }

    /** Responds with status `500 Internal Server Error` */
    public static function internalErr($payload)
    {
        return self::jsonResponse(500, $payload);
    }

}