<?php

class GetCurrency
{
    public static function listenerCurrency()
    {
        //Забираем данные
        $xml = simplexml_load_string(file_get_contents('http://www.cbr.ru/scripts/XML_daily.asp'));

        //Возвращаем json
        $json = json_encode($xml);

        //Возвращаем массив
        $array = json_decode($json,TRUE);

        //Определяем файл с прошлыми данными
        $previousData = ROOT.'/components/lastdata.json';
        $timestamp = time();

        //Если файл не сущетсует - создаем
        //Устанавливаем дату создания
        if(!file_exists($previousData)){
            $array['@attributes']['Date'] = $timestamp;
            $json = json_encode($array);
            file_put_contents($previousData, $json);
        }

        //Забираем время когда был создан файл
        $lastData = json_decode(file_get_contents($previousData),TRUE);
        $lastTime = $lastData['@attributes']['Date'];

        //Забираем старые данные
        $previousEU = $lastData['Valute'][11]['Value'];
        $previousUSD = $lastData['Valute'][10]['Value'];

        //Забираем свежие данные
        $currentEU = $array['Valute'][11]['Value'];
        $currentUSD = $array['Valute'][10]['Value'];

        //Итоговый массив
        $result = ['USD' => array($previousUSD,$currentUSD), 'EU' => array($previousEU,$currentEU)];

        //Проверяем прошли ли 24 часа и обнавляем время
        if(($lastTime + 3600 * 24) < $timestamp){
            $array['@attributes']['Date'] = $timestamp;
            $json = json_encode($array);
            file_put_contents($previousData, $json);
        }
        return $result;
    }
}
