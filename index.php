<?php
date_default_timezone_set('Europe/London');

function curl($url){
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch,CURLOPT_FOLLOWLOCATION,true);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}
$content = curl("https://api.openweathermap.org/data/2.5/forecast?q=Prague&appid=c5e1f7e007ed9f578f75d61c7eb4eabb");
$jsonarray = json_decode($content,true);

function getemoji($weather){

switch ($weather) {
    case "Clouds":
        echo "☁️";
        break;
    case "Clear":
        echo "☀️";
        break;
    case "Rain":
        echo "🌧";
        break;
}
}
// echo curl("https://api.openweathermap.org/data/2.5/weather?q=London,uk&appid=c5e1f7e007ed9f578f75d61c7eb4eabb");

//https://api.openweathermap.org/data/2.5/forecast?q=Prague&appid=c5e1f7e007ed9f578f75d61c7eb4eabb

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>🌈</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet"> 

</head>
<body>
    <div id="topintro">
    <h2> ☁️ Weather Outlook ☁️</h2>
</div>
    
    
        <div id="weatherbox">
        
        <?php for($i =0;$i<13;$i++){
            $weather = $jsonarray['list'][$i]['weather'][0]['main'];
            $timestamp = $jsonarray['list'][$i]['dt_txt'];
            
            $finaldate = date('d.m',$jsonarray['list'][$i]['dt']);
            $finaltime = substr($timestamp,-8,5);
            ?>
        <div class="singlebox">
            <h3> <?php echo $finaltime;?> <small> <?php echo $weather; getemoji($weather); ?></small></h3>
            <?php
            if($i>0 && date('d.m',$jsonarray['list'][$i]['dt']) > date('d.m',$jsonarray['list'][$i-1]['dt'])){
                ?>
                <h2><?php echo date('d.m',$jsonarray['list'][$i]['dt'])?></h2>
                <?php
            }
            echo "<br>";

            ?>
            </h3>
            </div>
            
            <?php } ?>

        </div>



        </div>


    <h4> </h4>
</body>
</html>