<?php

namespace App\Responses;

/**
 * Response class that handles all axios return values in json.
 */
class AxiosResponse
{
    /**
     * Any data to be sent with the request.
     *
     * @var [mixed]
     */
    protected $data;

    /**
     * HTTP code to be sent with the request.
     * default: 200.
     *
     * @var [int]
     */
    protected $http_code;

    /**
     * Message to send along with the request.
     *
     * @var [string]
     */
    protected $message;

    /**
     * Should the request redirect on the response
     * default: false.
     *
     * @var [bool]
     */
    protected $redirect;

    /**
     * Whether the action requested succeeded.
     *
     * @var [bool]
     */
    protected $result;

    /**
     * Create Axios Response.
     *
     * @return string Users guard name
     */
    public function __construct(bool $result = false, mixed $data = null, string $message = '', bool $redirect = false)
    {
        $this->result = $result;
        $this->data = $data;
        $this->message = $message;
        $this->redirect = $redirect;
    }

    /**
     * Statically build a Axios Response.
     *
     * @return string Users guard name
     */
    public static function create(bool $result, mixed $data, string $message, bool $redirect = false): self
    {
        return new static($result, $data, $message,$redirect);
    }

    /**
     * Send JSON Response.
     *
     * @return string Users guard name
     */
    public function respond(int $httpCode = 200)
    {
        return \Response::json(
            [
                'result' => $this->result,
                'data' => $this->data,
                'message' => $this->message,
            ],
            $httpCode
        );
    }
}
