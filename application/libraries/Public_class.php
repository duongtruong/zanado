<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Public_class {

    const SUCCESS = 1,
        WARNING = 2,
        ERROR = 0;
    
    public function redirect($path) {       
        header("Location: " . base_url($path));
    }
   
    public function redirBack($path) {        
        if(isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] != ""){
            header("Location: {$_SERVER['HTTP_REFERER']}");
        }else{
            header("Location: " . base_url($path));
        }
    }
    
    /**
     * Returns whether this is a POST request.
     * @return boolean whether this is a POST request.
     */
    public function isPostRequest()
    {
        return isset($_SERVER['REQUEST_METHOD']) && !strcasecmp($_SERVER['REQUEST_METHOD'],'POST');
    }

    /**
     * Returns whether this is a PUT request.
     * @return boolean whether this is a PUT request.
     */
    public function isPutRequest()
    {
        return (isset($_SERVER['REQUEST_METHOD']) && !strcasecmp($_SERVER['REQUEST_METHOD'],'PUT')) || $this->_getIsPutViaPostRequest();
    }
    




    public static function isEmpty($value, $trim = false) {
        return $value===null || $value===array() || $value==='' || $trim && is_scalar($value) && trim($value)==='';
    }
    public static function isValidEmail($email){
        return preg_match('/^([a-z0-9]+([_\.\-]{1}[a-z0-9]+)*){1}([@]){1}([a-z0-9]+([_\-]{1}[a-z0-9]+)*)+(([\.]{1}[a-z]{2,6}){0,3}){1}$/i', $email);
    }

    public static function isValidPriceFormat($value) {
        return preg_match("/^-?[0-9]+(?:\.[0-9]{1,2})?$/", $value);
    }
    public static function isValidUsername($name){
        return preg_match("/^[A-Za-z0-9_-]{3,16}$/",$name);
    }
    public static function isValidPassword($password){
        return preg_match("/^[a-z0-9_-]{6,18}$/",$password);
    }
    public static function isValidUrl($url){
        return preg_match("/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/",$url);
    }
    public static function isValidIPAddress($ip){
        return preg_match("/^(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/",$ip);
    }
    public static function isValidHtmlTag($tag){
        return preg_match("/^<([a-z]+)([^<]+)*(?:>(.*)<\/\1>|\s+\/>)$/",$tag);
    }
    public static function isValidHexValue($value){
        return preg_match("/^#?([a-f0-9]{6}|[a-f0-9]{3})$/",$value);
    }

    public static function isValidPhoneNumber($phone) {
        return preg_match("/^([0-9\(\)\/\+ \-]*)$/", $phone);
    }
    
}
