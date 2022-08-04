<?php

namespace app\components;

class Request extends \yii\web\Request
{
    private $_encodings;

    /**
     * Returns the encodings acceptable by the end user.
     * This is determined by the `Accept-Encoding` HTTP header.
     *
     * @return array the encodings
     */
    public function getAcceptableEncodings()
    {
        if (null === $this->_encodings) {
            if ($this->headers->has('Accept-Encoding')) {
                $this->_encodings = array_keys($this->parseAcceptHeader($this->headers->get('Accept-Encoding')));
            } else {
                $this->_encodings = [];
            }
        }

        return $this->_encodings;
    }

    /**
     * @param array $value the encodings that are acceptable by the end user
     */
    public function setAcceptableEncodings($value)
    {
        $this->_encodings = $value;
    }
}
