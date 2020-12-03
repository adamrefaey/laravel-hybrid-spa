<?php

namespace MustafaRefaey\LaravelHybridSpa;

use Illuminate\Http\Response;

/**
 * This class is used to format and send the JSON response
 * Its json response doesn't escape unicode characters, so it can handle different languages well
 */
class ApiResponse
{
    /**
     * Make success response
     *
     * @param array $data = []
     * @param array $messages = []
     * @param int $code = 200
     *
     * @return Response
     */
    public static function success(array $data = [], array $messages = [], int $code = 200): Response
    {
        $responseBody = [
            'status' => true,
            'data' => $data,
            'success_messages' => $messages,
        ];

        return self::buildResponse($responseBody, $code);
    }

    /**
     * Make failure response
     *
     * @param array $data = []
     * @param array $messages = []
     * @param int $code = 400
     *
     * @return Response
     */
    public static function fail(array $data = [], array $messages = [], int $code = 400): Response
    {
        $responseBody = [
            'status' => false,
            'data' => $data,
            'error_messages' => $messages,
        ];

        return self::buildResponse($responseBody, $code);
    }

    /**
     * Make custom response
     *
     * @param bool $status
     * @param int $code
     * @param array $data = []
     * @param array $messages = [] // possible keys: 'success_messages', 'error_messages',
     *                                                  'info_messages', 'warn_messages'
     *
     * @return Response
     */
    public static function custom(bool $status, int $code, array $data = [], array $messages = []): Response
    {
        $responseBody = ['status' => $status];

        if (! empty($data)) {
            $responseBody['data'] = $data;
        }

        if (! empty($messages['success_messages'])) {
            $responseBody['success_messages'] = $messages['success_messages'];
        }

        if (! empty($messages['error_messages'])) {
            $responseBody['error_messages'] = $messages['error_messages'];
        }

        if (! empty($messages['info_messages'])) {
            $responseBody['info_messages'] = $messages['info_messages'];
        }

        if (! empty($messages['warn_messages'])) {
            $responseBody['warn_messages'] = $messages['warn_messages'];
        }

        return self::buildResponse($responseBody, $code);
    }

    /**
     * Build a json response with the provided body and status code,
     * The response json doesn't escape unicode characters, so it can handle different languages well
     *
     * @param array $data = []
     * @param array $messages = []
     * @param int $code = 400
     *
     * @return Response
     */
    protected static function buildResponse(array $responseBody, int $code): Response
    {
        return response()
            ->make(
                json_encode($responseBody, JSON_UNESCAPED_UNICODE),
                $code,
                ['Content-Type' => 'application/json']
            );
    }
}
