<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

function cke_initialize($data = array()) {
    
    $return = '';
    
    if(!defined('CI_CKEDITOR_HELPER_LOADED')) {
        
        define('CI_CKEDITOR_HELPER_LOADED', TRUE);
        $return =  '<script type="text/javascript" src="'.base_url(). $data['path'] . '/ckeditor.js"></script>';
        $return .=  "<script type=\"text/javascript\">CKEDITOR_BASEPATH = '" . base_url() . $data['path'] . "/';</script>";
    } 
    
    return $return;
    
}

function cke_create_instance($data = array()) {
    
    $return = "<script type=\"text/javascript\">
        CKEDITOR.replace('" . $data['id'] . "', {";
    
            //Adding config values
            if(isset($data['config'])) {
                foreach($data['config'] as $k=>$v) {
                    
                    // Support for extra config parameters
                    if (is_array($v)) {
                        $return .= $k . " : [";
                        $return .= config_data($v);
                        $return .= "]";
                        
                    }
                    else {
                        $return .= $k . " : '" . $v . "'";
                    }

                    //if($k !== end(array_keys($data['config']))) {
                    $endkeys = (array_keys($data['config']));
                    if($k !== end($endkeys)) {
                        $return .= ",";
                    }                       
                } 
            }               
                    
    $return .= '});</script>';  
    
    return $return;
    
}

/**
 * This function displays an instance of CKEditor inside a view
 * @author Samuel Sanchez 
 * @access public
 * @param array $data (default: array())
 * @return string
 */
function display_ckeditor($data = array())
{
    // Initialization
    $return = cke_initialize($data);
    
    // Creating a Ckeditor instance
    $return .= cke_create_instance($data);
    

    // Adding styles values
    if(isset($data['styles'])) {
        
        $return .= "<script type=\"text/javascript\">CKEDITOR.addStylesSet( 'my_styles_" . $data['id'] . "', [";
   
        
        foreach($data['styles'] as $k=>$v) {
            
            $return .= "{ name : '" . $k . "', element : '" . $v['element'] . "', styles : { ";

            if(isset($v['styles'])) {
                foreach($v['styles'] as $k2=>$v2) {
                    
                    $return .= "'" . $k2 . "' : '" . $v2 . "'";
                    
                    //if($k2 !== end(array_keys($v['styles']))) {
                    $endkeys2 = array_keys($v['styles']);
                    if($k2 !== end($endkeys2)) {
                         $return .= ",";
                    }
                } 
            } 
        
            $return .= '} }';
            
            //if($k !== end(array_keys($data['styles']))) {
            $endkeys3 = array_keys($data['styles']);
            if($k !== end($endkeys3)) {
                $return .= ',';
            }           
            

        } 
        
        $return .= ']);';
        
        $return .= "CKEDITOR.instances['" . $data['id'] . "'].config.stylesCombo_stylesSet = 'my_styles_" . $data['id'] . "';
        </script>";     
    }   

    return $return;
}


function config_data($data = array())
{
    $return = '';
    foreach ($data as $key)
    {
        if (is_array($key)) {
            $return .= "[";
            foreach ($key as $string) {
                $return .= "'" . $string . "'";
                //if ($string != end(array_values($key))) $return .= ",";
                
                $endkeys = array_values($key);
                if($string !== end($endkeys)) $return .= ",";

            }
            $return .= "]";
        }
        else {
            $return .= "'".$key."'";
        }
        //if ($key != end(array_values($data))) $return .= ",";

        $endkeys = array_values($data);
        if ($key != end($endkeys)) $return .= ",";

    }
    return $return;
}