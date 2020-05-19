<html>

    <head>
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
        <style>
            .warning{
                text-align: center;
                font-size: 50px;
            }
            .info{
                margin-left: 20px;
                margin-top: 10px;
                font-size: 20px;
            }
            #album_image{
                margin-left: 20px;
                margin-top: 10px;
                width: 256;
                height: 256;
            }
            .intro{
                font-size: 20px;
                margin-left: 30px;
                margin-right: 30px;
                margin-top: 10px;
            }
            #cover{
                margin-left: 20px;
            }
            h2{
                width: 100%;
            }
            .songs{
                height: 300;
            }

        </style>
    <base target="_blank">
        <meta charset="utf-8">
    <script src="/js/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <?php
        if (isset($_GET["album"])){
            $album = $_GET["album"];
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
        $result1 = mysqli_query($link, "SELECT * from Albums where name='$album'");
        if ($result1){
            $infos = mysqli_fetch_array($result1);
            if (!isset($infos)){
                echo "<p class='warning'><strong>";
                echo "404 NOT FOUND!<br>";
                echo "</strong></p>";
                exit(0);
            }
            $album_url = $infos["url"];
            $issue_date = $infos["issue date"];
            $intro = $infos["introduction"];
            $cover = $infos["cover"];
            $singer = $infos["singer"];
            $songs = $infos["songs"];// the id of each song
            $comments = $infos["album comments"];// The string of the number of comments
            $song_a = explode(",",$songs);
            $len = count($song_a);

            foreach ($song_a as $key => $value) {
                $value = substr($value,2,-1);
                $song_a[$key] = $value;
            }
            $song_a[$len-1] = substr($song_a[$len-1],0,-1);
        }
        else{
            echo "<p class='warning'><strong>";
            echo "404 NOT FOUND!<br>";
            echo "</strong></p>";
            exit(0);
        }
    ?>
        <title><?php echo $album?></title>
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
                        <a href="../index.html" class="nav-link" target="_self">Albums</a>
                    </li>
                    <li class="nav-item">
                        <a href="../../ranking_of_songs/index.html" class="nav-link" target="_self">Songs</a>
                    </li>
                </ul>
            </div>
            <div class="navbar navbar-expand-sm bg-dark navbar-dark">
                <form action="../../search/search_album.php" class="form-inline" method="GET" target="_self">
                    <input type="text" class="form-control" placeholder="Search" name="album">
                    <button class="btn btn-success" type="submit">Search</button>
                </form>
            </div>
            <div class="row info">
                <div class="col">
                    <h2>Name: 
                        <?php
                            echo "<a target='_blank' href='" . $album_url ."'>";
                            echo $album;
                            echo "</a>";
                        ?>
                    </h2>
                    <?php
                        echo "<a target='_blank' href='" . $album_url . "'>";
                        echo "<img src='" . $cover . "' alt='cover' id='cover'>";
                        echo "</a>";
                    ?>

                </div>
                
                <div class="col">
                    <h2>
                        Issue Date:
                        <?php echo "<strong>" . $issue_date . "</strong>"; ?>
                    </h2>
                    <p>
                        
                        <?php echo "<strong>" ."Singer: " . $singer . "</strong>"; ?>
                    </p>
                </div>
            </div>
            <div class="row intro">
                <p>
                    <?php
                        $intro_a = explode(' ',$intro);
                        foreach ($intro_a as $key => $value) {
                            echo $value . "<br>";
                        }
                    ?>
                </p>
            </div>
            <div class="row visualization">
                <img src="" alt="可视化图片">
            </div>
            <div class="row">
                <?php
                    echo "<h2>" . "Songs Here!" . "</h2>";
                    
                    for ($i=0; $i < $len; $i++) { 
                        echo "<div class='col songs'>";
                        $temp = mysqli_query($link, "SELECT * from Songs where id='$song_a[$i]'");
                        if ($temp){
                            $infos = mysqli_fetch_array($temp);
                            $name = $infos["name"];
                            $url = $infos["url"];
                            $song_cover = $infos["cover"];
                            $numOfCom = $infos["commentnum"];
                            echo "<p>";

                            echo "<a target='_blank' href='" . $url . "'>";
                            echo $name . "</a></p>";
                            echo "<a target='_blank' href='" . $url . "'>";
                            echo "<img src='" . $song_cover . "' alt='" . $name . "'</a>";
                            
                        }
                        echo "<br>";
                    echo "</div>";
                    }
                    
                ?>
            </div>
        </div>
    </body>
</html>