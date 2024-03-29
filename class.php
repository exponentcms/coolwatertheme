<?php

##################################################
#
# Copyright (c) 2004-2023 OIC Group, Inc.
#
# This file is part of Exponent
#
# Exponent is free software; you can redistribute
# it and/or modify it under the terms of the GNU
# General Public License as published by the Free
# Software Foundation; either version 2 of the
# License, or (at your option) any later version.
#
# GPL: http://www.gnu.org/licenses/gpl.txt
#
##################################################

if (class_exists('coolwatertheme')) return;

class coolwatertheme extends theme {
    public $user_configured = true;
    public $stock_theme = true;

	function name() { return "Coolwater Theme"; }
	function author() { return "Erwin Aligam - ealigam@gmail.com"; }
	function description() { return "A simple, clean design from the kids at <a href=\"http://styleshout.com/\" target=\"_blank\">Style Shout</a>"; }

    function configureTheme() {
        if (!empty($this->params['sv'])) {
            if (strtolower($this->params['sv'])=='default') $this->params['sv']='';
            $settings = expSettings::parseFile(BASE."themes/".$this->params['theme']."/config_".$this->params['sv'].".php");
        } else {
            $settings = expSettings::parseFile(BASE."themes/".$this->params['theme']."/config.php");
        }
   		$form = new form();
   		$form->meta('controller','administration');
   		$form->meta('action','update_theme');
   		$form->meta('theme',$this->params['theme']);
        if (!empty($this->params['sv'])) $form->meta('sv',$this->params['sv']);
        $form->register('logo_text_main',gt('Main Site Title').': ',new textcontrol($settings['LOGO_TEXT_MAIN'],20));
        $form->register('logo_text_superscript',gt('Site Sub Title').': ',new textcontrol($settings['LOGO_TEXT_SUPERSCRIPT'],20));
        $form->register('link1_text',gt('Link #1 Text (blank to disable)').' : ',new textcontrol($settings['LINK1_TEXT'],20));
        $form->register('link1_section',gt('Link #1 Page'),new dropdowncontrol($settings['LINK1_SECTION'],section::levelDropdownControlArray(0,0,array(),false,'manage',true)));
        $form->register('link2_text',gt('Link #2 Text (blank to disable)').' : ',new textcontrol($settings['LINK2_TEXT'],20));
        $form->register('link2_section',gt('Link #2 Page'),new dropdowncontrol($settings['LINK2_SECTION'],section::levelDropdownControlArray(0,0,array(),false,'manage',true)));
        $form->register('link3_text',gt('Link #3 Text (blank to disable)').' : ',new textcontrol($settings['LINK3_TEXT'],20));
        $form->register('link3_section',gt('Link #3 Page'),new dropdowncontrol($settings['LINK3_SECTION'],section::levelDropdownControlArray(0,0,array(),false,'manage',true)));
        $form->register('menu_bounce_off',gt('Disable Menu Bounce'),new checkboxcontrol((!empty($settings['MENU_BOUNCE_OFF'])?$settings['MENU_BOUNCE_OFF']:0)));
//   		$form->register(null,'',new htmlcontrol('<br>'));
   		$form->register('submit','',new buttongroupcontrol(gt('Save'),'',gt('Cancel')));
   		assign_to_template(array(
            'name'=>$this->name().(!empty($this->params['sv'])?' '.$this->params['sv']:''),
            'form_html'=>$form->tohtml()
        ));
   	}

}

?>