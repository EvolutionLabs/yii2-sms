<?php

namespace evo\sms;

use wadeshuler\sms\BaseSms;
use yii\base\InvalidConfigException;

/**
 *
 * @property-read mixed $client
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
