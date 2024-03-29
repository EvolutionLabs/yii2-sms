<?php

namespace evo\sms;

use evo\sms\base\BaseMessage;
use evo\sms\base\MessageInterface;

/**
 * TODO - left as abstract as may be required to add some abstract functions
 * Class AbstractBaseMessage
 * @package evo\sms
 */
abstract class AbstractBaseMessage extends BaseMessage
{
    /**
     * Nicename function for getTextBody()
     */
    public function getMessage()
    {
        return $this->getTextBody();
    }

    /**
     * Nicename function for setTextBody()
     * @param $text
     * @return MessageInterface
     */
    public function setMessage($text)
    {
        $this->setTextBody($text);

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function toString()
    {
        return $this->getTextBody();
    }

}
