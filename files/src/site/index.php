<?php
// echo phpinfo();


$request = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
$params_get = $_GET;
$params_post = $_POST;
session_start();

//setcookie('debug', '1', time() + (86400 * 30)); // 86400 = seconds in 1 day
// $debug = ($_COOKIE['debug']==1);
// if ($debug) {
//     echo("Debug activated");
// }
switch ($request) {
    case '/chanel':
        $chanel = ''.$params_get['name'];
        $url = "auth_server:3000/getchanel";
        $curl = curl_init();
        curl_setopt($curl,CURLOPT_URL,$url);
        curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($curl,CURLOPT_POSTFIELDS,"name=$chanel");
        $chanel_data = curl_exec($curl);
        $chanel_data_json = json_decode($chanel_data,true);
        if ($debug) {
            echo ('<br>Chanel Data:'.$chanel_data."<br>");
        }
        if ($chanel_data_json["Found"] == "True") {
            include 'chanel.php';
        }else{
            include '404.php';
        }
        break;

    case '/search':
        $params = "";
        if (isset($params_get['search'])) {
            $params = "".$params_get['search'];
        }else{
            $params = "";

        }
        $url = "auth_server:3000/search";
        $curl = curl_init();
        curl_setopt($curl,CURLOPT_URL,$url);
        curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($curl,CURLOPT_POSTFIELDS,"params=$params");
        $results = curl_exec($curl);
        $results_json = json_decode($results,true);
        foreach ($results_json["Found"] as $value) {
            //echo($value."<br>");
        }
        include 'default.php';
        break;
    case '/login':
        include 'login.php';
        break;
    case '/loginloc':
            if (strlen($_POST['user']) < 4 || strlen($_POST['pass']) < 4 ) {
                //header("Location: /login");
                //die();
                echo("<script>location.href = '/login'</script>");
            }
            $chanel = $_POST['user'];
            $pass = $_POST['pass'];
            $url = "auth_server:3000/canlogin";
            $curl = curl_init();
            curl_setopt($curl,CURLOPT_URL,$url);
            curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
            $params = array(
                "user"=>$chanel,
                "pass"=>$pass
            );
            $values = http_build_query($params);
            curl_setopt($curl,CURLOPT_POSTFIELDS,$values);
           // curl_setopt($curl,CURLOPT_POSTFIELDS,"pass=$pass");            
            $chanel_data = curl_exec($curl);
            $chanel_data_json = json_decode($chanel_data,true);
            if ($chanel_data_json["allowed"] == "true") {                                
                $_SESSION['user'] = $chanel;
                echo '<p>'.session_status().'</p>';
                //echo("<script>location.href = '/'</script>");

            }
            break;
    case '':
    case '/':
        $params = "";
        $url = "auth_server:3000/search";
        $curl = curl_init();
        curl_setopt($curl,CURLOPT_URL,$url);
        curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($curl,CURLOPT_POSTFIELDS,"params=$params");
        $results = curl_exec($curl);
        $results_json = json_decode($results,true);
        include 'default.php';
        break;
}
