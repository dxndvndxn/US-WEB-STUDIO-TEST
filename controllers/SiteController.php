<?php
include_once (ROOT.'/model/GetCurrency.php');

class SiteController
{
    public function actionIndex()
    {
        $valueCurrency = GetCurrency::listenerCurrency();
        include_once (ROOT.'/views/index.php');
        return true;
    }
}