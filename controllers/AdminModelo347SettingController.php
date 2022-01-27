<?php

class AdminModelo347SettingController extends ModuleAdminController{
    
    public function __construct()
	{
		//Redirect your admin controller to module configuration
		Tools::redirectAdmin(Context::getContext()->link->getAdminLink('AdminModules').'&configure=bpxmodelo347');
	}
}