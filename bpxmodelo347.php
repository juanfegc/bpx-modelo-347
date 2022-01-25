<?php
/**                                                                                       
*
*  ██████  ██  ██████  ██████  ██████   ██████  ██   ██ 
*  ██   ██ ██ ██    ██ ██   ██ ██   ██ ██    ██  ██ ██  
*  ██████  ██ ██    ██ ██████  ██████  ██    ██   ███   
*  ██   ██ ██ ██    ██ ██      ██   ██ ██    ██  ██ ██  
*  ██████  ██  ██████  ██      ██   ██  ██████  ██   ██ 
*
* 2022 Bioprox Laboratorios S.C.A. 
*
*
* NOTICE OF LICENSE
*
* This product is licensed for one customer to use on one installation (test stores and multishop included).
* Site developer has the right to modify this module to suit their needs, but can not redistribute the module in
* whole or in part. Any other use of this module constitues a violation of the user agreement.
*
*
* DISCLAIMER
*
* NO WARRANTIES OF DATA SAFETY OR MODULE SECURITY
* ARE EXPRESSED OR IMPLIED. USE THIS MODULE IN ACCORDANCE
* WITH YOUR MERCHANT AGREEMENT, KNOWING THAT VIOLATIONS OF
* PCI COMPLIANCY OR A DATA BREACH CAN COST THOUSANDS OF DOLLARS
* IN FINES AND DAMAGE A STORES REPUTATION. USE AT YOUR OWN RISK.
*
*  @author    BIOPROX <juanfer@bioprox.es>
*  @copyright 2022 BIOPROX LABORATORIOS S.C.A.
*  @license   See above
*/

if (!defined('_PS_VERSION_')) {
    exit;
}

class Bpxmodelo347 extends Module
{

    public function __construct()
    {
        $this->name = 'bpxmodelo347';
        $this->tab = 'administration';
        $this->version = '1.0.0';
        $this->author = 'juanfer@bioprox.es';
        $this->need_instance = 0;
        $this->ps_versions_compliancy = array('min' => '1.7', 'max' => _PS_VERSION_);
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('BPX Modelo 347');
        $this->description = $this->l('Obten información de la facturación de todos los clientes que han comprado mas de 3005€ al año para presentar el Modelo 347 ante la Agencia Tributaria');

        
    }

    public function install()
    {
        if (Shop::isFeatureActive()) {
			Shop::setContext(Shop::CONTEXT_ALL);
		}

        Configuration::updateValue('BPXMODELO347', true);

        return parent::install();
    }

    public function uninstall()
    {
        Configuration::deleteByName('BPXMODELO347');

        return parent::uninstall();
    }

    //-----------------------------------------------------
    // Menu Configuracion del Modulo
    //-----------------------------------------------------
    public function getContent()
    {
        $this->calcularModelo347();
        return $this->display(__FILE__, 'views/templates/admin/configure347.tpl');
    }

    public function calcularModelo347()
    {
        if (Tools::isSubmit('modelo347_form')){
            $annio = (int)Tools::getValue('annio');
            $this->context->smarty->assign('annio', $annio);

            //obtener registro de datos ventas anuales por cliente
            $ventas = Db::getInstance()->executeS('SELECT o.id_customer, c.firstname, c.lastname, o.id_address_invoice, COUNT(o.id_order) AS num_pedidos, ROUND(SUM(o.total_paid),2) AS total_347 FROM '._DB_PREFIX_.'orders o INNER JOIN '._DB_PREFIX_.'customer c ON o.id_customer = c.id_customer WHERE  YEAR(o.invoice_date) = '.$annio.' AND o.current_state!=6 AND o.id_customer!=4  GROUP BY id_customer HAVING SUM(o.total_paid) > 3005');
            //dump($ventas);
            if(!empty($ventas)){
                $this->context->smarty->assign('ventas', $ventas);
            }
        }

    }


}
