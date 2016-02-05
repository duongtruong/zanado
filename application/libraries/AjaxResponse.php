<?php

class AjaxResponse extends stdClass {
    const SUCCESS = 1,
        WARNING = 2,
        ERROR = 0;



    /**
     * response type SUCCESS|WARNING|ERROR
     * @var string
     */
    public $type;

    /**
     * response message
     * @var string
     */
    public $message;

    /**
     * response system message
     * @var string
     */
    public $sysMessage;

    /**
     * destination element to resporn
     * @var string
     */
    public $element;
    /**
     * @var
     */ 

    public $data;
    
    function __construct($type = null, $message = null)
    {        
        $this->message = $message;
        $this->type = $type;
    }

    public function toString() {
        return json_encode($this);
    }
    
}
