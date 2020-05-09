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

            div {margin-bottom: 3rem;}
            div:last-child {margin-bottom: 0;}
    </style>
        <?php 

if (isset($_POST["song"])){
    $song = $_POST["song"];
}
else{
    echo "<p class='warning'><strong>";
    echo "No Specified Song";
    echo "</strong></p>";
    exit(0);
}
$link = mysqli_connect("121.199.77.180:3306", 'root', 'Zrh999999','NeteaseCloudMusic');

# 设定字符集
$link->set_charset("utf8");
# 执行SQL语句
$result1 = mysqli_query($link, "SELECT * from Songs where name='$song'");
# 检测返回结果
if ($result1){
    $infos = mysqli_fetch_array($result1);
    if (!isset($infos)){
        echo "<p class='warning'><strong>";
        echo "404 NOT FOUND!<br>";
        echo "</strong></p>";
    exit(0);
    }
    $ID = $infos["id"];
    $song_name = $infos["name"];
    $song_url = $infos["url"];
    $lyrics = $infos["lyrics"];
    $cover = $infos["cover"];
    $comments = $infos["comments"];
    $commentnums = $infos["commentnum"];
}
?>
        <title><?php echo $song_name?></title>
    <meta charset="utf-8">
    <base target="_blank">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <title>Song</title>
        <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
        <script src="https://cdn.staticfile.org/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://cdn.staticfile.org/popper.js/1.15.0/umd/popper.min.js"></script>
        <script src="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
        
    </head>
    <body>
        <div class="container">
        <div class="navbar navbar-expand-sm bg-dark navbar-dark">
                <a href="#" class="navbar-brand">
                    <img src="http://file03.16sucai.com/2016/03/2016yisxqhd5vv4.jpg" alt="Logo" width="40px">
                </a>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="singer.html" class="nav-link">Singers</a>
                    </li>
                    <li class="nav-item">
                        <a href="album.html" class="nav-link">Albums</a>
                    </li>
                    <li class="nav-item">
                        <a href="song.html" class="nav-link">Songs</a>
                    </li>
                </ul>
            </div>
            <div class="navbar navbar-expand-sm bg-dark navbar-dark">
                <form action="search_for_song.php" class="form-inline" method="POST">
                    <input type="text" class="form-control" placeholder="Search" name="song">
                    <button class="btn btn-success" type="submit">Search</button>
                </form>
            </div>
            
            <div class="row">
                <div class="col">
                    <div class="row">
                        <h2 id="song_name">
                            
                        <?php 
                        echo "Song: ";
                        echo "<a href='" . $song_url ."'>";
                        echo $song_name;
                        echo "</a>";
                        echo "<p>";
                        echo "Total comments: " . $commentnums;
                        echo "</p>";
                        ?>
                    </h2>
                    </div>
                    <div class="row">
                        <?php
                            echo "<a href='" . $song_url . "'>";
                            echo "<img src='" . $cover . "' alt='Cover' id='song_image'>";
                            echo "</a>";
                            
                        ?>
                    </div>
                    <div class="row visualization">
                        <img src="" alt="可视化图片">
                    </div>
                    <div class="row comments">
                        <?php
                            $com_a = explode(' ',$comments);
                            $len = count($com_a);
                            foreach ($com_a as $key=>$value) { 
                                $value = substr($value,2,-1);
                                $com_a[$key] = $value;
                            }
                            $com_a[$len-1] = substr($com_a[$len-1],0,-1);
                            for ($i=0; $i < $len; $i++) { 
                                echo $com_a[$i] . "<br>";
                            }
                        ?>
                    </div>
                </div>
                <div class="col" id="lyrics">
                    
                        <?php 
                            echo  "<h3 style='text-align:center;font-weight:bold;font-size:200%'>";
                            echo "Lyrics";
                            echo "</h3>";
                            $lyric_array = explode(' ',$lyrics);
                            foreach ($lyric_array as $key => $value) {
                                if ($value === "作词" or $value === ':' or $value === "作曲" or $value === "唱"){
                                    echo "<p class='btn'>";
                                    echo "<strong>" . $value ." </strong>" ; 
                                    echo "</p>";
                                }
                                else{
                                    echo "<p class='btn from-top'>";
                                    echo $value;
                                    echo "</p>";
                                }
                            }
                        ?>
                </div>
            </div>
        </div>
    </body>
</html>