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
     * @param $message
     * @param int $position
     * @param array $attributes
     */
    public static function addMessage($message, $position = 0, Array $attributes = array()){

        self::isValidKey($position,'$position');
        self::isValidKey(self::$messageSessionName,self::class.'::$messageSessionName');

        $a = (isset($_SESSION[self::$messageSessionName]) ? $_SESSION[self::$messageSessionName] : []);

        $a[$position][] = ['message' => $message, 'attributes' => $attributes];

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

        $this->__messages = $this->processMessages(self::$messages);
        self::$messages = null;

    }

    private function processMessages(Array $messageArray){
        $a = array();
        foreach ($messageArray as $positionName => $positionValues){
            foreach($positionValues as $messageNumber => $messageValues){
                $a[$positionName][$messageNumber] = Message::start($messageValues['message'],$positionName,$messageValues['attributes']);
            }
        }
        return $a;
    }

    public function getMessages($position = null){
        return (!is_null($position) ? (isset($this->__messages[$position]) && is_array($this->__messages[$position]) ? $this->__messages[$position] : []) : $this->__messages);
    }

}