<?php 
if (session_status() == PHP_SESSION_ACTIVE) {
    echo '<a class="right waves-effect waves-light profileimg" href="#"><img src="/media/chanels-img/'.$chanel_data_json["img2"].'" class="navimg circle"/></a> ';
}else{
    echo '<a class="right waves-effect waves-light profileimg" href="/login"><img src="/media/chanels-img/'.'pholder_person.png'.'" class="navimg circle"/></a> ';
}
?>