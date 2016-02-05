<?php
//namespace Dongky;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined("BASEPATH"))
    exit("No direct script access allowed");

class Html {
    
    /**
    * the base url of js file
    * @var string
    */
    public $_jsBaseUrl;
    /**
    * the base url of css file
    * @var string
    */
    public $_cssBaseUrl;

    private $_jsText = array();
    private $_jsSingleFile = array();
    private $_stylesheet = array();
    
    /**
    * Add Stylesheet
    *
    * @param string $file. Link to file
    * @param array $media. Stylesheet Media style
    */
    public function _addCss($file, $media = array()) {
            $this->_stylesheet[$file] = $media;
    }
        
        
    /**
    * Add javascript file
    * 
    * @param string	$file
    * @param string	$position the position of js file, support TOP|BOTTOM 
    * @param array		$option
    */
    public function _addJs($file, $position = 'BOTTOM', $option = array()) {
        if (is_array($file)) {
            for ($i = 0, $size = sizeof($file); $i < $size; ++$i) {
                $this->addJs($file[$i], $position, $option);
            }
        } else {
            $position = strtoupper($position);
            $this->_javascript[$position][$file] = $option;
        }
    }
    
    public function _addJsVar($name, $value, $position = 'TOP') {
        $position = strtoupper($position);
        $this->_jsVar[$position][$name] = $value;
    }
    
    protected $_jsVar = array(
        'TOP' => array(),
        'BOTTOM' => array()
    );
    
    
        /**
        * render js link
        * @param string	$pos
        * @return string
        */
	public function _js($pos = 'BOTTOM') {

        $jsv = '1234';

        $pos = strtoupper($pos);

        if (!empty($this->_jsVar[$pos])) {
            foreach ($this->_jsVar[$pos] as $name => $value) {
                $code = "var {$name} = ".json_encode($value) .';';
                $this->_addJsCode($code, $pos, 'standard');
            }
        }

		$jsCode = '';
		if (isset($this->_jsText[$pos])) {
			foreach ($this->_jsText[$pos] as $lib=>$code) {
				if ('standard' == $lib) {
					$jsCode .= implode("\n", $code) ."\n";				
				} else {
					$open = constant(strtoupper('self::' .$lib) .'_OPEN');
					$close = constant(strtoupper('self::' .$lib) .'_CLOSE');
					$jsCode .= $open .implode("\n", $code) .$close;
				}				
			}
			$jsCode = "<script type=\"text/javascript\">\n" .$jsCode ."\n</script>";						
		}		
		$js = '';
		if (isset($this->_javascript[$pos])) {
            foreach($this->_javascript[$pos] as $file=>$option) {
                $js .= '<script type="text/javascript" src="'
                    .$this->_jsBaseUrl .$file .'?v=' .$jsv .'"></script>';
            }
		}
		
		if ('TOP' == $pos) {
			$js .= $jsCode;			
		} else {
			$js = $jsCode .$js;
		}
		
		//single file
		if (isset($this->_jsSingleFile[$pos])) {
			foreach ($this->_jsSingleFile[$pos] as $file=>$option) {
                $jsv = (isset($option['version']))? $option['version']: $jsv;
                $js .= '<script type="text/javascript" src="'
                        .(isset($option['base_url'])? $option['base_url']: $this->jsBaseUrl) .
                        $file.'?v=' .$jsv .'">
                </script>';
			}
		}
		
		return $js ."\n";
	}
        
        /**
	 * render css link
	 * 
	 * @return string
	 */
	public function _css() {
            if (count($this->_stylesheet) === 0) {
                    return null;
            }
                    $css = '';
                    foreach ($this->_stylesheet as $file=>$media) {
                            $media = ((is_array($media))? implode(', ', $media) : 'screen') .'"';
                            if (null != $media) {
                                    $media = 'screen';				
                            }
                            $css .= '<link rel="stylesheet" type="text/css" href="'
                                            . $this->_cssBaseUrl .$file .'"'
                                            .' media="' .$media .'" />' ."\n";						
                    }

                    return $css;
            }
	
        
        public function _addJsCode($code, $position = 'BOTTOM', $lib = 'jQuery') {
		$position = strtoupper($position);
		$this->_jsText[$position][$lib][] = $code;
	}
          
        function _update_item($item, $value)
	{
            $config = new \CI_Config();
            $config->config[$item] .= $value;                
	}
        
}