<?php

namespace evo\sms;

use evo\sms\base\BaseSms;
use yii\base\InvalidConfigException;

/**
 * Class AbstractSms
 * @package evo\sms
 */
abstract class AbstractSms extends BaseSms
{
    /**
     * @return mixed
     */
    abstract public function getClient();

    /**
     * @return bool
     */
    abstract public function checkCredentials();

    /**
     * @inheritDoc
     * @throws InvalidConfigException
     */
    public function init()
    {
        if ($this->useFileTransport === false) {
            if (!$this->checkCredentials()) {
                throw new InvalidConfigException(self::class . ": Credentials are required!");
            }
        }

        parent::init();
    }
}
