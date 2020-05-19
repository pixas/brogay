<html>
<head>
    <style>
            .warning{
                text-align: center;
                font-size: 50px;
            }
            #song_name{
                margin-left: 20px;
                margin-top: 10px;
            }
            #song_image{
                margin-left: 20px;
                margin-top: 10px;
                width: 256;
                height: 256;
            }

            body {
            	--def: #96B7C4; 	
            	--inv: #fff;
            	display: -webkit-box;
            	display: -ms-flexbox;
            	display: flex;
            	-webkit-box-pack: center;
            	    -ms-flex-pack: center;
            	        justify-content: center;
            	-webkit-box-align: center;
            	    -ms-flex-align: center;
            	        align-items: center;
            	-webkit-box-orient: vertical;
            	-webkit-box-direction: normal;
            	    -ms-flex-direction: column;
            	        flex-direction: column;
	
            	background-image: linear-gradient(-25deg, #616161 0%, #96B7C4 100%);
            }

            /* div {margin-bottom: 3rem;} */
            div:last-child {margin-bottom: 0;}
    </style>




<?php
$name = $_GET["singer"];
$param = '{
    "query": {
        "match": {
          "name": '. '"'. $name . '"' .'
        }
    },
    "sort": {
        "_score": {
            "order": "desc"
        }
    }
}';
  
$curl = curl_init();
curl_setopt($curl,CURLOPT_URL,"http://121.199.77.180:9200/singer/_search");
$header = array(
    "content-type: application/json; charset=UTF8bm4"
);
curl_setopt($curl,CURLOPT_HTTPHEADER,$header);
curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
$timeout = 10;
curl_setopt($curl,CURLOPT_CONNECTTIMEOUT,$timeout);
curl_setopt($curl,CURLOPT_POSTFIELDS,$param);
$res = curl_exec($curl);
curl_close($curl);
$ret = json_decode($res,true);
$total = $ret["hits"]["hits"];
$len = count($total);
?>

<title><?php echo $name;?></title>
    <meta charset="utf8mb4">
    <base target="_blank">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <title>Song</title>
        
        <script src="https://cdn.staticfile.org/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://cdn.staticfile.org/popper.js/1.15.0/umd/popper.min.js"></script>
        <script src="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
    </head>
    <body>
    <div class="container">
        <div class="navbar navbar-expand-sm bg-dark navbar-dark">
                <a href="#" class="navbar-brand">
                    <img src="http://file03.16sucai.com/2016/03/2016yisxqhd5vv4.jpg" alt="Logo" width="40px">
                </a>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="../ranking_of_singers/index.html" class="nav-link" target="_self">Singers</a>
                    </li>
                    <li class="nav-item">
                        <a href="../ranking_of_albums/index.html" class="nav-link" target="_self">Albums</a>
                    </li>
                    <li class="nav-item">
                        <a href="../ranking_of_songs/index.html" class="nav-link" target="_self">Songs</a>
                    </li>
                </ul>
            </div>
            <div class="navbar navbar-expand-sm bg-dark navbar-dark">
                <form action="search_singer.php" class="form-inline" method="GET" target="_self">
                    <input type="text" class="form-control" placeholder="Search" name="singer">
                    <button class="btn btn-success" type="submit">Search</button>
                </form>
            </div>
            <div class="result">
                You searched <?php echo  '"'.$name . '"';  ?> ,
                and you get <?php echo "<em>" . $len . "</em>" ." results.";?>
            </div>
            <div class="row" height=100px>
             <?php
             
                for ($i=0; $i <$len ; $i++) { 
                    $id = $total[$i]["_id"];
                    
                    $source = $total[$i]["_source"];
                    // $cover = $source["cover"];
                    $singer_name = $source["name"];
                    $singer_url = $source["singer url"];
                    $album_num = $source["album number"];
                    $total_com = $source["total comments"];
                    echo "<div class='col'>";
                    echo "<a target='_self' href = '../ranking_of_singers/php/onesinger.php?singer=" . $singer_name . "'>";
                    echo $singer_name . "</a><br>";
                    echo "Total comments: " . $total_com . "<br>";
                    echo "Album number: " . $album_num . "<br>";
                    echo "</div>";
                }
            ?> 
        </div>
    </div>
    </body>
</html>