<html>
    <head>
    <script type="text/javascript" src="../js/tagcloud.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/song_visualization.css" />

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
                        <a href="../../ranking_of_singers/index.html" class="nav-link" target="_self">Singers</a>
                    </li>
                    <li class="nav-item">
                        <a href="../../ranking_of_albums/index.html" class="nav-link" target="_self">Albums</a>
                    </li>
                    <li class="nav-item">
                        <a href="../index.html" class="nav-link" target="_self">Songs</a>
                    </li>
                </ul>
            </div>
            <div class="navbar navbar-expand-sm bg-dark navbar-dark">
                <form action="../../search/search_song.php" class="form-inline" method="GET" target="_self">
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
                        echo "<a target='_blank' href='" . $song_url ."'>";
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
                            echo "<a target='_blank' href='" . $song_url . "'>";
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
                                echo "<a target='_self' href='#' style='font-size:20px;'>";
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
                                echo "<a target='_self' href='#' style='font-size:20px;'>";
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