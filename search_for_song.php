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
                </div>
                <div class="col" id="lyrics">
                    <p>
                        <?php 
                            echo  "<strong>" . "Lyrics: ". "</strong>" . "<br>";
                            $lyric_array = explode(' ',$lyrics);
                            foreach ($lyric_array as $key => $value) {
                                if ($value === "作词" or $value === ':' or $value === "作曲" or $value === "唱"){
                                    echo "<strong>" . $value ." </strong>" ; 
                                }
                                else{
                                    echo $value . "<br>";
                                }
                            }
                        ?>
                    </p>
                </div>
            </div>
        </div>
    </body>
</html>