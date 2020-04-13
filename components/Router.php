<?php
class Router{
    //Маршруты
    private  $routes;

    public function __construct()
    {
        $routesPath = ROOT.'/config/routes.php';
        $this->routes = include($routesPath);
    }
    //Получаем строку запроса
    private function  getURI(){
        if (!empty($_SERVER['REQUEST_URI'])){
            return trim($_SERVER['REQUEST_URI'],'/');
        }
    }

    public function run(){
        //Получить строку запроса
        $url = $this->getURI();

        //Проверяем наличие запроса  в routes,где  $urlPattern это точно ищем и
        //$path это путь к введеной строке
        foreach ($this->routes as $urlPattern => $path){

            //Сравниваем строку запроса $url с $urlPattern, который записан в routes

            if(preg_match("~$urlPattern~",$url)){
                $intRoute = preg_replace("~$urlPattern~",$path,$url);
                $segmentsS = explode('/',$intRoute);
                //Разделяем пути на массив
                $segments = explode('/',$path);

                //определяем контроллер
                array_shift($segmentsS);
                array_shift($segmentsS);
                $controllerName = array_shift($segments).'Controller';
                $controllerName = ucfirst($controllerName);
                $actionName = 'action'.ucfirst(array_shift($segments));

                $controllerFile = ROOT. '/controllers/'.$controllerName.'.php';

                $param = $segmentsS;
                if(file_exists($controllerFile)){
                    include_once($controllerFile);
                }
                $contrllObj = new $controllerName;
                $result = call_user_func_array(array($contrllObj, $actionName), $param);
                if($result !=null){
                    break;
                }

            }
        }

    }
}