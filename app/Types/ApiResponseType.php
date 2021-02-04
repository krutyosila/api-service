<?php

namespace App\Types;

/**
 * Class ApiResponseType
 * @package App\Types
 */
class ApiResponseType extends BaseType
{
    /**
     * @var bool
     */
    public $status = true;
    /**
     * @var string|null
     */
    public $message = null;
    /**
     * @var array
     */
    public $data = [];

    /**
     * @return bool
     */
    public function isStatus()
    {
        return $this->status;
    }

    /**
     * @param bool $status
     * @return ApiResponseType
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param string|null $message
     * @return ApiResponseType
     */
    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param array $data
     * @return ApiResponseType
     */
    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }

}
