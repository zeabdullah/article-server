<?php
trait ResponseTrait
{

    private function jsonResponse(int $statusCode, mixed $payload)
    {
        return json_encode([
            'status' => $statusCode,
            'payload' => $payload
        ]);
    }

    /** Responds with status `200 OK` */
    public function okResponse($payload)
    {
        return self::jsonResponse(200, $payload);
    }

    /** Responds with status `201 Created` */
    public function createdResponse($payload)
    {
        return self::jsonResponse(201, $payload);
    }

    /** Responds with status `400 Bad Request` */
    public function badRequestResponse($payload)
    {
        return self::jsonResponse(400, $payload);
    }

    /** Responds with status `404 Not Found` */
    public function notFoundResponse($payload)
    {
        return self::jsonResponse(404, $payload);
    }

    /** Responds with status `500 Internal Server Error` */
    public function internalErrResponse($payload)
    {
        return self::jsonResponse(500, $payload);
    }

}