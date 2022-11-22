<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
<style>
    .FINISHED{
        background:red;
    }
    .IN_PLAY{
        background:green;
    }
    .TIMED{
        background:Blue;
    }
</style>
</head>
<body>
<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.football-data.org/v4/competitions/WC/matches',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'X-Auth-Token: b7d91565ae9d4069af402074cabb6ba3'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo '<script>var json ='.$response .
'</script>' ;

?>




    

    <div class="nav w-full h-52 flex place-content-center place-items-center aboslute left-0 ">
        <img src="qatar-word.png" class="w-2/4 h-auto" alt="">
        <img src="logo.png" alt="" class="w-20 h-auto">
    </div>


    <div id="insert" class="nav w-full flex place-content-center place-items-center aboslute left-0 flex-col">
        


    </div>


</body>
<script>
    var today = new Date();

    var dd = String(today.getDate()).padStart(2, '0');


    var insert = document.getElementById("insert");
    var t = ``;
    if(json)
    {
        for(var key in json['matches']){
            console.log(json['matches'][key]["awayTeam"]["crest"])
            t+= `<div class="w-3/4 h-20 bg-slate-800 rounded-lg shadow-lg drop-shadow-lg pointer flex justify-between items-center text-white mt-5"> <div class="away w-2/6 h-full   flex justify-center items-center" ><div class="logo relative flex justify-center items-center hidden md:block">`
            t+= `<img src="${json['matches'][key]["awayTeam"]["crest"]}" class="w-20 rounded-lg" alt=""></div> <span class="w-5 hidden md:block"></span> <div class="name flex justify-center items-center font-bold">${json['matches'][key]["awayTeam"]["name"]}</div></div>`
            t+= `<div class="status text-2xl font-bold   w-2/6 h-full  flex justify-center items-center ${json['matches'][key]["status"]}">`
            if(json['matches'][key]["score"]["fullTime"]["away"]==null)
            {
                var x = json['matches'][key]["utcDate"].substr(8, 10)
                if(x == dd){
                    t += json['matches'][key]["utcDate"].subste(11,16)
                }
                else{
                    t += json['matches'][key]["utcDate"].substr(0, 10)
                }
            }
            else{
                t+=`${json['matches'][key]["score"]["fullTime"]["away"]} : ${json['matches'][key]["score"]["fullTime"]["home"]}`
                
            }
            
            t+= `</div><div class="home  w-2/6 h-full   flex justify-center items-center"><div class="name flex justify-center items-center font-bold">${json['matches'][key]["homeTeam"]["name"]}</div><span class="w-5 hidden md:block"></span><div class="logo relative hidden md:block  flex justify-center items-center"><img src="${json['matches'][key]["homeTeam"]["crest"]}" class="w-20 rounded-lg" alt=""></div></div></div>`
}
insert.innerHTML = t;
    }
</script>
</html>
