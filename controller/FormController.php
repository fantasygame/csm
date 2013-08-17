<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FormController
 *
 * @author Dawid
 */
class FormController {
    public function saveAction (){
        $formRead= new FormRead();
        $formRead->getForm();    }
}

?>
