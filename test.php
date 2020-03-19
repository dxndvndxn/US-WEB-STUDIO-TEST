<?php
function CBR_XML_Daily_Ru() {
    $json_daily_file = __DIR__.'/daily.json';
    if (!is_file($json_daily_file) || filemtime($json_daily_file) < time() - 3600) {
        if ($json_daily = file_get_contents('https://www.cbr-xml-daily.ru/daily_json.js')) {
            file_put_contents($json_daily_file, $json_daily);
        }
    }

    return json_decode(file_get_contents($json_daily_file));
}

$data = CBR_XML_Daily_Ru();


//USD
if($data->Valute->USD->Value > $data->Valute->USD->Previous){
    echo "Обменный курс USD по ЦБ РФ на сегодня: {$data->Valute->USD->Value}" ."&and;"."<br>";
}else{
    echo "Обменный курс USD по ЦБ РФ на сегодня: {$data->Valute->USD->Value}" ."&or;"."<br>";
}
//EUR
if($data->Valute->EUR->Value > $data->Valute->EUR->Previous){
    echo "Обменный курс USD по ЦБ РФ на сегодня: {$data->Valute->EUR->Value}" ."&and;"."<br>";
}else{
    echo "Обменный курс USD по ЦБ РФ на сегодня: {$data->Valute->EUR->Value}" ."&or;"."<br>";
}

