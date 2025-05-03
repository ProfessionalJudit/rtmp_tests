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
            </div>
        </nav>
        <div class="mainbody deep-purple lighten-1 valign-wrapper">
            <div class="formscotnainer">
                <div class="valign">
                    <h4 class="fancytext">LOGIN</h4>
                    <div class="form_login">
                        <form action="/loginloc" method="POST" id="loginform">
                            <input class="validate" placeholder="Username" id="user" name="user" type="text">
                            <input class="validate" placeholder="Password" id="pass" name="pass" type="password">
                            <input type="submit" hidden>

                            <button form="loginform"  class="logbutton waves-effect waves-light btn" type="submit">Login</button>
                        </form>
                    </div>
                </div>
                <div class="valign">
                    <h4 class="fancytext">REGISTER</h4>
                    <div class="form_login form_res">
                        <form action="/registerloc" method="POST" enctype="multipart/form-data">
                            <input class="validate" placeholder="Username" minlength="4" id="user" name="user" type="text" required>
                            <input class="validate" placeholder="Description" id="desc" name="desc" type="textarea"required>
                            <input class="validate" placeholder="Password" id="pass" minlength="6" name="pass" type="password"required>
                            <input class="validate" placeholder="E-Mail" id="mail" name="mail" type="text"required>
                            <input type="file" id="img1" name="img1">
                            <input type="file" id="img2" name="img2">
                            <input type="submit" hidden>
                            <button class="logbutton waves-effect waves-light btn" type="submit">Register</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</body>