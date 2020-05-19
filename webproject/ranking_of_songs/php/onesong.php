<html>
    <head>
    <script type="text/javascript" src="../js/tagcloud.js"></script>
    <style type="text/css">
    .fl{ float: left; }
    .fr{ float: right; }
    .wrapper{ width: 1200px; height: 300px; margin: 0 auto; }
    .wrapper p{ padding-top: 150px; line-height: 27px; color: #999; font-size: 14px; text-align: center;  }
    .tagcloud { position: relative; margin-top:-150px; }
    .tagcloud a{ position: absolute;  top: 0; left: 0;  display: block; padding: 11px 30px; color: #333; font-size: 16px; border: 1px solid #e6e7e8; border-radius: 18px; background-color: #f2f4f8; text-decoration: none; white-space: nowrap;
      -o-box-shadow: 6px 4px 8px 0 rgba(151,142,136,.34);
      -ms-box-shadow: 6px 4px 8px 0 rgba(151,142,136,.34);
      -moz-box-shadow: 6px 4px 8px 0 rgba(151,142,136,.34);
      -webkit-box-shadow: 6px 4px 8px 0 rgba(151,142,136,.34);
      box-shadow: 6px 4px 8px 0 rgba(151,142,136,.34);
      -ms-filter:"progid:DXImageTransform.Microsoft.Shadow(Strength=4,Direction=135, Color='#000000')";/*兼容ie7/8*/
      filter: progid:DXImageTransform.Microsoft.Shadow(color='#969696', Direction=125, Strength=9);
      /*strength是阴影大小，direction是阴影方位，单位为度，可以为负数，color是阴影颜色 （尽量使用数字）使用IE滤镜实现盒子阴影的盒子必须是行元素或以行元素显示（block或inline-block;）*/
    }
    .tagcloud a:hover{ color: #3385cf; }
    </style>
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
	
            	background-image: linear-gradient(-25deg, #b9eeb7 0%, #96B7C4 100%);
            }

            /* div {margin-bottom: 3rem;} */
            div:last-child {margin-bottom: 0;}
    </style>
        <?php 

if (isset($_GET["song"])){
    $song = $_GET["song"];
}
else{
    echo "<p class='warning'><strong>";
    echo "No Specified Song";
    echo "</strong></p>";
    exit(0);
}
$link = mysqli_connect("121.199.77.180:3306", 'root', 'Zrh999999','NeteaseCloudMusic');

# 设定字符集
$link->set_charset("utf8mb4");
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
    $commentnums = $infos["commentnum"];
    $lyrics_common_words = $infos["lyrics common words"];
    $comments_common_words = $infos["comments common words"];
    $lyrics_array = explode(',',$lyrics_common_words);
    $lyric_len = count($lyrics_array);
    $comment_array = explode(',',$comments_common_words);
    $comment_len = count($comment_array);
    foreach ($lyrics_array as $key => $value) {
        $value = substr($value,2,-1);
        $lyrics_array[$key] = $value;
    }
    $lyrics_array[$lyric_len-1] = substr($lyrics_array[$lyric_len-1],0,-1);
    foreach ($comment_array as $key => $value) {
        $value = substr($value,2,-1);
        $comment_array[$key] = $value;
    }
    $comment_array[$comment_len-1] = substr($comment_array[$comment_len-1],0,-1);
}
?>
        <title><?php echo $song_name?></title>
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
                        <a href="../../ranking_of_singers/index.html" class="nav-link">Singers</a>
                    </li>
                    <li class="nav-item">
                        <a href="../../ranking_of_albums/index.html" class="nav-link">Albums</a>
                    </li>
                    <li class="nav-item">
                        <a href="../index.html" class="nav-link">Songs</a>
                    </li>
                </ul>
            </div>
            <div class="navbar navbar-expand-sm bg-dark navbar-dark">
                <form action="../../search/search_song.php" class="form-inline" method="GET">
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
                    <br>
                    <p style="font-size: 25px;">歌词中的热词</p>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    
                    <div class="tagcloud fl">
                        <?php
                            
                            foreach ($lyrics_array as $key => $value) {
                                echo "<a href='#' style='font-size:20px;'>";
                                echo $value;
                                echo "</a>";
                            }
                        ?>
                    </div>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <p style="font-size: 25px;">评论中的热词</p>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <div class="tagcloud fr">
                        <?php
                            foreach ($comment_array as $key => $value) {
                                echo "<a href='#'>";
                                echo $value;
                                echo "</a>";
                            }
                        ?>
                    </div>
                    <script type="text/javascript">
                        /*3D标签云*/
                        tagcloud({
                            selector: ".tagcloud",  //元素选择器
                            fontsize: 16,       //基本字体大小, 单位px
                            radius: 100,         //滚动半径, 单位px
                            mspeed: "normal",   //滚动最大速度, 取值: slow, normal(默认), fast
                            ispeed: "normal",   //滚动初速度, 取值: slow, normal(默认), fast
                            direction: 135,     //初始滚动方向, 取值角度(顺时针360): 0对应top, 90对应left, 135对应right-bottom(默认)...
                            keep: false          //鼠标移出组件后是否继续随鼠标滚动, 取值: false, true(默认) 对应 减速至初速度滚动, 随鼠标滚动
                        });
                    </script>
                </div>
                <div class="col" id="lyrics">
                    
                        <?php 
                            echo  "<h3 style='text-align:center;font-weight:bold;font-size:200%'>";
                            echo "Lyrics";
                            echo "</h3>";
                            // var_dump($lyrics);
                            $lyric_array = explode("\n",$lyrics);
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
                                    echo "<br>";
                                }
                            }
                        ?>
                </div>
            </div>
        </div>
    </body>
</html>