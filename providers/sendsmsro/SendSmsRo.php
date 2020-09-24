<?php

namespace evo\sms\providers\sendsmsro;

use Yii;
use yii\base\InvalidConfigException;
use yii\db\Exception;
use evo\sms\AbstractSms;
use evo\sms\providers\sendsmsro\vendor\SendSmsApi;

/**
 * Class SendSmsRo
 * @package evo\sms\providers\sendsmsro
 *
 * @property-read SendSmsApi $client
 */
class SendSmsRo extends AbstractSms
{
    /**
     * @var string
     */
    public $username;

    /**
     * @var string
     */
    public $password;

    /**
     * @var SendSmsApi
     */
    private $_client;

    /**
     * @inheritDoc
     */
    public function checkCredentials()
    {
        if (!isset($this->username) || empty($this->username)) {
            return false;
        }

        if (!isset($this->password) || empty($this->password)) {
            return false;
        }

        //TODO - Maybe more checks with the api endpoint
        return true;
    }

    /**
     * @inheritDoc
     */
    protected function sendMessage($message)
    {
        $success = false;

        /* @var $message Message */
        $from = $message->getFrom();
        $to   = $message->getTo();

        try {
            if (!isset($from) || empty($from)) {
                throw new InvalidConfigException(self::class . ": Invalid 'from' phone number!");
            }

            if (!isset($to) || empty($to)) {
                throw new InvalidConfigException(self::class . ": Invalid 'to' phone number!");
            }

            $result = $this->getClient()->message_send($to, $message->toString(), $from);

            if (!$this->getClient()->ok($result)) {
                throw new Exception($this->getClient()->getError());
            }

            $success = true;

        } catch (Exception $e) {
            file_put_contents(Yii::getAlias('@runtime') . '/logs/sms-exception.log', '[' . date('m-d-Y h:i:s a', time()) . '] SMS Failed - Phone: ' . $to . PHP_EOL . $e->getMessage() . PHP_EOL . '---' . PHP_EOL, FILE_APPEND | LOCK_EX);
        }

        return $success;
    }

    /**
     * @return SendSmsApi
     */
    public function getClient(): SendSmsApi
    {
        if ($this->_client) {
            return $this->_client;
        }

        $client = new SendSmsApi();
        $client->setPassword($this->password);
        $client->setUsername($this->username);

        return $this->_client = $client;
    }
}
