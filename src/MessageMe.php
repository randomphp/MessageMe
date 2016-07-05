<?php
/**
 * Date: 05-07-2016
 * Time: 01:43
 */

namespace RandomPhp;

class MessageMe
{

    #region Static

    public static $messageSessionName = 'messages';// name of the session the messages will be stored under.

    private static $messages = null;// placeholder for messages when switching to instance.

    /**
     * @param string $message
     * @param int|string $position
     * @param int|string $type
     */
    public static function newMessage($message, $position, $type = 0){

        self::isValidKey($position,'$position');
        self::isValidKey($type,'$type');
        self::isValidKey(self::$messageSessionName,self::class.'::$messageSessionName');

        $a = (isset($_SESSION[self::$messageSessionName]) ? $_SESSION[self::$messageSessionName] : []);

        $a[$position][$type][] = $message;

        $_SESSION[self::$messageSessionName] = $a;

    }

    /**
     * @return MessageMe
     */
    public static function loadMessages(){

        self::isValidKey(self::$messageSessionName,self::class.'::$messageSessionName');

        self::$messages = (isset($_SESSION[self::$messageSessionName]) ? $_SESSION[self::$messageSessionName] : []);
        unset($_SESSION[self::$messageSessionName]);
        return new self();

    }

    /**
     * @param mixed $key
     * @param string $name
     * @throws \UnexpectedValueException
     */
    private static function isValidKey($key, $name){

        if(!is_string($key) && !is_int($key)){
            throw new \UnexpectedValueException('"'.$name.'" must be a string or integer.');
        }

    }

    #endregion

    private $__messages = null;

    private function __construct(){

        $this->__messages = self::$messages;
        self::$messages = null;

    }

    public function getMessages($position = null){

        if(is_null($position)){
            return $this->__messages;
        }

        return $this->__messages;

    }

}