<?php
// echo "get:";
// foreach ($_GET as $key => $value) {
//     echo($key . "  " . $value."<br>");
// }
// echo "<br>post:";
// foreach ($_POST as $key => $value) {
//     echo($key . "  " . $value);
// }
//echo phpinfo()
?>


<!DOCTYPE html>

<head>
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="/media/css/main.css">
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://unpkg.com/@videojs/themes@1/dist/city/index.css" rel="stylesheet">
    <link href="https://vjs.zencdn.net/8.0.4/video-js.css" rel="stylesheet">
    <script src="https://vjs.zencdn.net/8.0.4/video.min.js"></script>
    <script src="https://unpkg.com/@videojs/http-streaming@3.2.0/dist/videojs-http-streaming.min.js"></script>

</head>

<body>

    <div class="root">
        <nav>
            <div class="nav-wrapper deep-purple">
                <a href="search?search=#" class="brand-logo">SPASM</a>
                <div class="input-field searchbar">
                    <form action="/search" method="GET">
                        <i class="material-icons prefix">search</i>
                        <input class="validate searchbar_t" placeholder="Search..." id="search" name="search" type="text">
                        <input type="submit" value="Submit" hidden>
                    </form>
                </div>
                <?php 
                    include("menu_icon.php");

                ?>
            </div>
        </nav>
        <div class="mainbody deep-purple lighten-1 valign-wrapper">
            <div class="cards_container">
                <?php
                foreach ($results_json['Found'] as $key => $value) {
                    $chanel = $value;
                    $url = "auth_server:3000/getchanel";
                    $curl = curl_init();
                    curl_setopt($curl,CURLOPT_URL,$url);
                    curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
                    curl_setopt($curl,CURLOPT_POSTFIELDS,"name=$chanel");
                    $chanel_data = curl_exec($curl);
                    $chanel_data_json = json_decode($chanel_data,true);
                    echo '
                        <a href="/chanel?name='.$value.'">
                            <div class="card">
                                <div class="card-image">
                                    <img src="/media/chanels-img/'.$chanel_data_json['img1'].'">
                                    <span class="card-title">'.$value.'</span>
                                </div>
                                <div class="card-content">
                                    <p>'.$chanel_data_json['Desc'].'</p>
                                </div>
                        </div>
                    </a>';
                }
                ?>
            </div>
        </div>
    </div>
</body>