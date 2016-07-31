<?php
/**
 * Date: 05-07-2016
 * Time: 02:34
 */

namespace RandomPhp;


class Message
{

    private
        $__message = null,
        $__position = null,
        $__attributes = array();

    public static function start($message,$position,Array $attributes){
        return new self($message,$position,$attributes);
    }

    private function __construct($message,$position,Array $attributes){
        $this->__message = $message;
        $this->__position = $position;
        $this->__atributes = $attributes;
    }

    public function message(){
        return $this->__message;
    }

    public function position(){
        return $this->__position;
    }

    public function attributes(){
        return $this->__attributes;
    }

    private function hasAttribute($name){
        return (isset($this->__attributes[$name]) || array_key_exists($name,$this->__attributes));
    }

    public function getAttribute($name){
        return ($this->hasAttribute($name) ? $this->__attributes[$name] : null);
    }

}