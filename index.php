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
        echo "☔";
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
    
    
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4"
     crossorigin="anonymous">
     <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
	 crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
	 crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T"
	 crossorigin="anonymous"></script>
     



</head>
<body>
    <div id="topintro">
    <h2> ☁️ Weather Outlook ☁️</h2>
</div>
<div class="container">
	<div class="row">
        <div id="weatherbox" class="col-md-9 col-sm-12 col-xs-12">
            <!-- MAIN CYCLE START-->        
            <?php for($i =0;$i<5;$i++){
            
                $weather = $jsonarray['list'][$i]['weather'][0]['main'];
                $timestamp = $jsonarray['list'][$i]['dt_txt'];
                $temp = $jsonarray['list'][$i]['main']['temp'];

                $finaldate = date('d.m',$jsonarray['list'][$i]['dt']);
                $finaltime = substr($timestamp,-8,5);
                $finaltemp = floor($temp - 273.15);
            ?>
            <!-- CREATE SINGLE BOX -->      
            
            <div class="singlebox">
                <h3> <b><?php echo $finaltime." - "; ?></b> <small> <?php echo $weather; getemoji($weather); ?></small><b><?php echo ", ". $finaltemp."°C";?></b></h3>
                    <?php
                    //IF DAY ENDS , ECHO FOLLOWING DAY DATE
                    if($i>0 && date('d.m',$jsonarray['list'][$i]['dt']) > date('d.m',$jsonarray['list'][$i-1]['dt'])){
                        ?>
                        <h1><?php echo date('d.m',$jsonarray['list'][$i]['dt'])?></h1>
                        <?php
                    }
                    echo "<br>";
                    ?>
                </h3>
            </div>
            <?php } 
            //MAIN CYCLE ENDS
            ?>
        <!-- SHOW MORE BOX -->
        <div class="singlebox">
            <a href="#" id="buttoncollapse" data-toggle="collapse" data-target="#therest"> Show more . . .</a>
        </div>
        <!-- SHOW MORE BOX END -->
        <!-- BOX WITH MORE INFO -->
        <div class="collapse" id="therest">
            <!-- MAIN CYCLE START-->        
            <?php for($i =5;$i<13;$i++){
            
            $weather = $jsonarray['list'][$i]['weather'][0]['main'];
            $timestamp = $jsonarray['list'][$i]['dt_txt'];
            $temp = $jsonarray['list'][$i]['main']['temp'];

            $finaldate = date('d.m',$jsonarray['list'][$i]['dt']);
            $finaltime = substr($timestamp,-8,5);
            $finaltemp = floor($temp - 273.15);
        ?>
        <!-- CREATE SINGLE BOX -->      
        
        <div class="singlebox">
            <h3> <b><?php echo $finaltime." - "; ?></b> <small> <?php echo $weather; getemoji($weather); ?></small><b><?php echo ", ". $finaltemp."°C";?></b></h3>
                <?php
                //IF DAY ENDS , ECHO FOLLOWING DAY DATE
                if($i>0 && date('d.m',$jsonarray['list'][$i]['dt']) > date('d.m',$jsonarray['list'][$i-1]['dt'])){
                    ?>
                    <h1><?php echo date('d.m',$jsonarray['list'][$i]['dt'])?></h1>
                    <?php
                }
                echo "<br>";
                ?>
            </h3>
        </div>
        <?php } 
        //MAIN CYCLE ENDS
        ?>     
                 
        
        </div>
    </div>





    </div>
</div>

   
</body>
</html>