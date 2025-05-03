<?php 

if (isset($_SESSION['user'])) {
    $url = "auth_server:3000/getchanel";
    $curl = curl_init();
    curl_setopt($curl,CURLOPT_URL,$url);
    curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($curl,CURLOPT_POSTFIELDS,"name=".$_SESSION['user']);
    $chanel_data = curl_exec($curl);
    $chanel_data_json = json_decode($chanel_data,true);

    echo '<a class="right waves-effect waves-light profileimg" href="#"><img src="/media/chanels-img/'.$chanel_data_json["img1"].'" class="navimg circle"/></a> ';
}else{
    echo '<a class="right waves-effect waves-light profileimg" href="/login"><img src="/media/chanels-img/'.'pholder_person.png'.'" class="navimg circle"/></a> ';
}
?>