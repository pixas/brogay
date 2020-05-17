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
            /* ~~~~~~~ INIT. BTN ~~~~~~~ */

            .btn {		
            	position: relative;	
            	padding: 1.4rem 4.2rem;
            	padding-right: 2.1rem;
            	font-size: 1.4rem;
                /* height: 3rem; */
            	color: var(--inv);
            	letter-spacing: 0.1rem;
            	text-transform: uppercase;
            	-webkit-transition: all 600ms cubic-bezier(0.77, 0, 0.175, 1);
            	transition: all 600ms cubic-bezier(0.77, 0, 0.175, 1);	
            	-webkit-user-select: none;	
	               -moz-user-select: none;	
                    -ms-user-select: none;	
	                    user-select: none;
                /* margin-left: 10%; */
            }

            .btn:before, .btn:after {
            	content: '';
            	position: absolute;	
            	-webkit-transition: inherit;	
            	transition: inherit;
	            z-index: -1;
            }

            .btn:hover {
            	color: var(--def);
            	-webkit-transition-delay: .6s;
            	        transition-delay: .6s;
            }

            .btn:hover:before {
            	-webkit-transition-delay: 0s;
            	        transition-delay: 0s;
            }

            .btn:hover:after {
            	background: var(--inv);
            	-webkit-transition-delay: .4s;
            	        transition-delay: .4s;
            }

            /* From Top */

            .from-top:before, 
            .from-top:after {
            	left: 0;
            	height: 0;
            	width: 100%;
            }

            .from-top:before {
            	bottom: 0;	
            	border: 1px solid var(--inv);
            	border-top: 0;
            	border-bottom: 0;
            }

            .from-top:after {
               	top: 0;
            	height: 0;
            }

            .from-top:hover:before,
            .from-top:hover:after {
            	height: 100%;
            }
            /* ~~~~~~~~~~~~ GLOBAL SETTINGS ~~~~~~~~~~~~ */

            *, *:before, *:after {
            	-webkit-box-sizing: border-box;
            	        box-sizing: border-box;
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
                <form action="search_singer.php" class="form-inline" method="GET">
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
                    echo "<a href = '../ranking_of_singers/php/onesinger.php?singer=" . $singer_name . "'>";
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