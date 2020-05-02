<html>
    <head>
    <style>
    .info{
        font-size: 20pt;
    }
    .comment{
        width: 100%;
    }
    h2{
        width: 100%;
    }
    .warning{
        text-align: center;
        font-size: 50px;
    }
</style>
    <?php 
    if (isset($_POST["singer"])){
        $singer = $_POST["singer"];
    }
    else{
        echo "<p class='warning'><strong>";
        echo "No Specified Singer";
        echo "</strong></p>";
        exit(0);
    }
    ?>
    <?php
        # 创建连接
        $link = mysqli_connect("121.199.77.180:3306", 'root', 'Zrh999999','NeteaseCloudMusic');

        # 设定字符集
        $link->set_charset("utf8");
        # 执行SQL语句
        $result1 = mysqli_query($link, "SELECT * from Singers where name='$singer'");
        # 检测返回结果
        
        if ($result1) {
            # 读取一行返回结果
            $infos = mysqli_fetch_array($result1);

            if (!isset($infos)){
                echo "<p class='warning'><strong>";
            echo "404 NOT FOUND!<br>";
            echo "</strong></p>";
            exit(0);
            }
            $ID = $infos["id"];
            $singer_name = $infos["name"];
            $singer_url = $infos["url"];
            $album_nums = $infos["album number"];
            $albums = $infos["albums id"];// 得到albums的Id，可以连接albums
            $total_com = $infos["total comments"];

            
            $albums = explode(',',$albums);
            $len = (int)$album_nums;
            foreach ($albums as $key => $value) {
                $value = substr($value,2,-1);
                $albums[$key] = $value;
            }
        }
        else {
            echo "<p class='warning'><strong>";
            echo "404 NOT FOUND!<br>";
            echo "</strong></p>";
            exit(0);
        }
    ?>
        <title> <?php echo $singer_name ?></title>
    <base target="_blank">
        <meta charset="utf-8">
    <script src="/js/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
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
                <form action="search_for_singer.php" class="form-inline" method="POST">
                    <input type="text" class="form-control" placeholder="Search" name="singer">
                    <button class="btn btn-success" type="submit">Search</button>
                </form>
            </div>
            
            <div class="row info">
                <div class="col">
                    <p>Name: <?php echo "<strong>". $singer_name . "</strong>" ?></p>
                </div>
                <div class="col">
                    <p>Total comments: <?php echo "<strong>" . $total_com . "</strong>"?></p>
                </div>
            </div>
            <div class="row visualization">
                <img src="" alt="可视化图片">
            </div>
            <div class="row">
                <?php
                    $albums[$len-1] = substr($albums[$len-1],0,-1);
                    echo "<h2>" . "Albums Here!" . "</h2>";
                    for ($i = 0;$i<$len;$i++)
                    {
                        echo "<div class='col'>";
                        $temp = mysqli_query($link, "SELECT * from Albums where id='$albums[$i]'");

                        if ($temp){
                            $infos = mysqli_fetch_array($temp);
                            echo "<p>";
                            echo "<a " . "href='".$infos['url']. "'>";
                            echo $infos['name'];
                            echo "</a>";
                            echo "</p>";
                            echo "<a href='".$infos['url']."'>";
                            echo "<img src='" . $infos['cover'] . "'alt='" . $infos['name'] ."'>";
                            echo "</a>";
                        }
                        echo "<br>";
                        echo "</div>";
                    }
                ?>
            </div>
        </div>
    </body>
</html>