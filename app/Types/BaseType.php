<?php

namespace App\Types;

use Illuminate\Support\Str;

/**
 * Class BaseType
 * @package App\Types
 */
class BaseType
{
    /**
     * @param array $data
     */
    public function arrayToType(array $data)
    {
        foreach ($data as $key => $value) {
            $setKey = 'set' . Str::ucfirst($key);
            if (method_exists($this, $setKey)) {
                if (!empty($value)) {
                    $this->$setKey($value);
                }
            }
        }
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $return = [];
        foreach ((array)$this as $key => $value) {
            if (!empty($value)) {
                $return[$key] = $value;
            }
        }
        return $return;
    }
}
