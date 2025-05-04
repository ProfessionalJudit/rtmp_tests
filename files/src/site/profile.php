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
        <div class="mainbody deep-purple lighten-1">
            <div class="card">
            <div class="card-image">
            <?php echo('<img src="/media/chanels-img/'.$fullchanel["img1"].'">');?>
            <span class="card-title"><?php echo $fullchanel["chanel"]?></span>
            </div>
                <div class="card-content">
                    <p><?php echo $fullchanel["Desc"]?></p>
                    <br>
                    <p><?php echo "Tokens: ".$fullchanel["token1"]." - ".$fullchanel["token2"]?></p>
                    <p style="font-style: italic;"><?php echo "Ussage: rtmp://spasm.loc/live/".$fullchanel["chanel"]."?key=".$fullchanel["token1"]."&pass=".$fullchanel["token2"]?></p>
                </div>
            </div>
            <div class="data-edit">
                <h6>Edit Chanel-Data</h6>
                <form action="/edit" method="POST" enctype="multipart/form-data">
                <input type="textarea" id="desc" name="desc" class="texta" value=<?php echo "'".$fullchanel["Desc"]."'"?>>
                <input type="file" id="img1" name="img1">
                <input type="file" id="img2" name="img2">
                <input type="submit" hidden>
                <button class="logbutton waves-effect waves-light btn" type="submit">Save</button>
                </form>
            </div>
        </div>
    </div>
</body>