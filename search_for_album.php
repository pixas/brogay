<html>

    <head>
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

        </style>
    <base target="_blank">
        <meta charset="utf-8">
    <script src="/js/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <?php
        if (isset($_POST["album"])){
            $album = $_POST["album"];
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
                <form action="search_for_album.php" class="form-inline" method="POST">
                    <input type="text" class="form-control" placeholder="Search" name="album">
                    <button class="btn btn-success" type="submit">Search</button>
                </form>
            </div>
            <div class="row info">
                <div class="col">
                    <h2>Name: 
                        <?php
                            echo "<a href='" . $album_url ."'>";
                            echo $album;
                            echo "</a>";
                        ?>
                    </h2>
                    <?php
                        echo "<a href='" . $album_url . "'>";
                        echo "<img src='" . $cover . "' alt='cover' id='cover'>";
                        echo "</a>";
                    ?>

                </div>
                
                <div class="col">
                    <h2>
                        Issue Date:
                        <?php echo "<strong>" . $issue_date . "</strong>"; ?>
                    </h2>
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

            </div>
        </div>
    </body>
</html>