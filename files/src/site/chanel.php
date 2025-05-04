
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

            <?php 
                $output = array();
                $reurn_err = '';
                exec("ffmpeg -i http://nginx-rtmp-web:8088/dash/".$chanel.".mpd stdout -v 16 2>&1",$output,$reurn_err);
                //echo('Stream down: '.str_contains($output[0],'404'));
                if (!str_contains($output[0],'404')) 
                {
                    echo 
                        '<video
                            id="my_video_1"
                            class="video-js"
                            controls>
                        </video>'
                        ."<script>
                            const video = document.querySelector('#my_video_1')
                            const src   = video.getAttribute('src')
                            const type  = video.getAttribute('type')

                            const player = videojs(video)
                            player.src({
                            //src: src,
                                src:'http://localhost:8088/dash/".$chanel.".mpd',
                                type: 'application/dash+xml'
                            })
                            //type='application/dash+xml'
                            //src='http://localhost:8088/dash/stream.mpd'
                            //Auth    
                        </script>"
                        .'<div class="banner center-align ">
                            <img class="banner_i circle " src="/media/chanels-img/'.$chanel_data_jsonc["img1"].'">
                            <p class="banner_p left-align">'.$chanel_data_jsonc["Desc"].'</p>
                        </div>';
                }else{
                    echo '<div class="valign-wrapper"><p class="offlinep center-align">STREAM OFFLINE <3</p></div>'. 
                        '<div class="banner center-align rounded">
                            <img class="banner_i circle " src="/media/chanels-img/'.$chanel_data_jsonc["img1"].'">
                            <p class="banner_p left-align">'.$chanel_data_jsonc["Desc"].'</p>
                        </div>';
                }
            ?>    
            
        </div>            
    </div>
</body>
