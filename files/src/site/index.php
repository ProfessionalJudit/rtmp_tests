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
        $chanel = '' . $params_get['name'];
        $url = "auth_server:3000/getchanel";
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, "name=$chanel");
        $chanel_data = curl_exec($curl);
        $chanel_data_json = json_decode($chanel_data, true);
        if ($debug) {
            echo ('<br>Chanel Data:' . $chanel_data . "<br>");
        }
        if ($chanel_data_json["Found"] == "True") {
            include 'chanel.php';
        } else {
            include '404.php';
        }
        break;

    case '/search':
        $params = "";
        if (isset($params_get['search'])) {
            $params = "" . $params_get['search'];
        } else {
            $params = "";
        }
        $url = "auth_server:3000/search";
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, "params=$params");
        $results = curl_exec($curl);
        $results_json = json_decode($results, true);
        foreach ($results_json["Found"] as $value) {
            //echo($value."<br>");
        }
        include 'default.php';
        break;
    case '/login':
        include 'login.php';
        break;
    case '/profile':
        $url = "auth_server:3000/getfull";
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, "name=" . $_SESSION['user']);
        $chanel_data = curl_exec($curl);
        $fullchanel = json_decode($chanel_data, true);

        include 'profile.php';
        break;
    case '/loginloc':
        if (strlen($_POST['user']) < 4 || strlen($_POST['pass']) < 4) {
            //header("Location: /login");
            //die();
            echo ("<script>location.href = '/login'</script>");
        }
        $chanel = $_POST['user'];
        $pass = $_POST['pass'];
        $url = "auth_server:3000/canlogin";
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $params = array(
            "user" => $chanel,
            "pass" => $pass
        );
        $values = http_build_query($params);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $values);
        // curl_setopt($curl,CURLOPT_POSTFIELDS,"pass=$pass");            
        $chanel_data = curl_exec($curl);
        $chanel_data_json = json_decode($chanel_data, true);
        if ($chanel_data_json["allowed"] == "true") {
            $_SESSION['user'] = $chanel;
            //echo '<p>'.session_status().'</p>';
        }
        echo ("<script>location.href = '/'</script>");
        break;
    case '/registerloc':

        $chanel = $_POST["user"];
        $url = "auth_server:3000/getchanel";
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, "name=$chanel");
        $chanel_data = curl_exec($curl);
        $chanel_data_json = json_decode($chanel_data, true);
        if ($chanel_data_json['Found'] == "False") {
            $user = $_POST["user"];
            $desc = $_POST["desc"];
            $mail = $_POST["mail"];
            $pass = $_POST["pass"];
            $img1 = "pholder_img.jpeg";
            $img2 = "pholder_person.png";            
            $target_dir = "/media/chanels-img/";
            if (isset($_FILES["img1"])) {
                $target_file = $target_dir . basename($_FILES["img1"]["tmp_name"]) . "." . pathinfo($_FILES["img1"]["name"], PATHINFO_EXTENSION);;
                if (move_uploaded_file($_FILES["img1"]["tmp_name"], $target_file)) {
                    $img1 = basename($_FILES["img1"]["tmp_name"]) . "." . pathinfo($_FILES["img1"]["name"], PATHINFO_EXTENSION);
                }
            }
            if (isset($_FILES["img2"])) {
                $target_file = $target_dir . basename($_FILES["img2"]["tmp_name"]) . "." . pathinfo($_FILES["img2"]["name"], PATHINFO_EXTENSION);;
                if (move_uploaded_file($_FILES["img2"]["tmp_name"], $target_file)) {
                    $img2 = basename($_FILES["img2"]["tmp_name"]) . "." . pathinfo($_FILES["img2"]["name"], PATHINFO_EXTENSION);
                }
            }
            curl_close($curl);
            $url2 = "auth_server:3000/createaccount";
            $curl2 = curl_init();
            curl_setopt($curl2, CURLOPT_URL, $url2);
            curl_setopt($curl2, CURLOPT_RETURNTRANSFER, true);
            $params2 = array(
                "user" => $user,
                "pass" => $pass,
                "desc" => $desc,
                "mail" => $mail,
                "img1" => $img1,
                "img2" => $img2
            
            );
             $values = http_build_query($params2);

            curl_setopt($curl2, CURLOPT_POSTFIELDS, $values);
            $chanel_data2 = curl_exec($curl2);
            $chanel_data_json2 = json_decode($chanel_data2, true);
//            var_dump($chanel_data_json2);
            echo ("<script>location.href = '/profile'</script>");

            
        }
        // $chanel = $_POST['user'];
        // $pass = $_POST['pass'];
        // $url = "auth_server:3000/createaccount";
        // $curl = curl_init();
        // curl_setopt($curl, CURLOPT_URL, $url);
        // curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        // $params = array(
        //     "user" => $chanel,
        //     "pass" => $pass
        // );
        // $values = http_build_query($params);
        // curl_setopt($curl, CURLOPT_POSTFIELDS, $values);
        // // curl_setopt($curl,CURLOPT_POSTFIELDS,"pass=$pass");            
        // $chanel_data = curl_exec($curl);
        // $chanel_data_json = json_decode($chanel_data, true);
        // if ($chanel_data_json["allowed"] == "true") {
        //     $_SESSION['user'] = $chanel;
        //     //echo '<p>'.session_status().'</p>';
        //     echo ("<script>location.href = '/'</script>");
        // }
        break;
    case '/edit':
        $img1 = "NOCHANGE";
        $img2 = "NOCHANGE";
        $desc = $_POST["desc"];
        $target_dir = "/media/chanels-img/";
        //var_dump($_FILES);
        //var_dump($_FILES["img1"]);
        if (isset($_FILES["img1"])) {
            $target_file = $target_dir . basename($_FILES["img1"]["tmp_name"]) . "." . pathinfo($_FILES["img1"]["name"], PATHINFO_EXTENSION);;
            echo "<br>" . $target_file . "<br>";
            if (move_uploaded_file($_FILES["img1"]["tmp_name"], $target_file)) {
                // echo "The file " . htmlspecialchars(basename($_FILES["img1"]["name"])) . " has been uploaded.";
                $img1 = basename($_FILES["img1"]["tmp_name"]) . "." . pathinfo($_FILES["img1"]["name"], PATHINFO_EXTENSION);
            } else {
                // echo "Sorry, there was an error uploading your file.";
            }
        }
        if (isset($_FILES["img2"])) {
            $target_file = $target_dir . basename($_FILES["img2"]["tmp_name"]) . "." . pathinfo($_FILES["img2"]["name"], PATHINFO_EXTENSION);;
            //echo "<br>" . $target_file . "<br>";
            if (move_uploaded_file($_FILES["img2"]["tmp_name"], $target_file)) {
                $img2 = basename($_FILES["img2"]["tmp_name"]) . "." . pathinfo($_FILES["img2"]["name"], PATHINFO_EXTENSION);

                //echo "The file " . htmlspecialchars(basename($_FILES["img2"]["name"])) . " has been uploaded.";
            } else {
                //echo "Sorry, there was an error uploading your file.";
            }
        }
        $chanel = $_SESSION['user'];
        $url = "auth_server:3000/change";
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $params = array(
            "user" => $chanel,
            "desc" => $desc,
            "img1" => $img1,
            "img2" => $img2,

        );
        $values = http_build_query($params);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $values);
        $chanel_data = curl_exec($curl);
        $chanel_data_json = json_decode($chanel_data, true);
        echo ("<script>location.href = '/profile'</script>");
        break;
    case '':
    case '/':
        $params = "";
        $url = "auth_server:3000/search";
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, "params=$params");
        $results = curl_exec($curl);
        $results_json = json_decode($results, true);
        include 'default.php';
        break;
}
