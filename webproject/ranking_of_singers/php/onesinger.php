
<?php 
          $singer = $_GET["singer"]; //收集input中name为“singer”的提交信息

            # 创建连接
             $link = mysqli_connect("121.199.77.180:3306", 'root', 'Zrh999999','NeteaseCloudMusic');
             # 设定字符集
             $link->set_charset("utf8");
             # 执行SQL语句
            $result1 = mysqli_query($link, "SELECT * from Singers where name='$singer'");//从Singer数据库中选择name为$singer的记录
            # 检测返回结果
                
            if ($result1) {
                # 读取一行返回结果
                $infos = mysqli_fetch_array($result1);
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
                $albums[$len-1] = substr($albums[$len-1],0,-1);
                }
                else{
                    echo "404 NOT FOUND!<br>";
                    exit(0);
                }
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <title>singer</title>
        <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="css/style.css" />
        <script src="js/modernizr.custom.63321.js"></script>
        
		<!--[if lte IE 7]><style>.support-note .note-ie{display:block;}</style><![endif]-->
	</head>
	<body>
		<div class="container">	
        <div class="navbar navbar-expand-sm bg-dark navbar-dark">
                <a href="#" class="navbar-brand">
                    <img src="http://file03.16sucai.com/2016/03/2016yisxqhd5vv4.jpg" alt="Logo" width="40px">
                </a>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="../index.html" class="nav-link">Singers</a>
                    </li>
                    <li class="nav-item">
                        <a href="../../ranking_of_albums/index.html" class="nav-link">Albums</a>
                    </li>
                    <li class="nav-item">
                        <a href="../../ranking_of_songs/index.html" class="nav-link">Songs</a>
                    </li>
                </ul>
            </div>
            <div class="navbar navbar-expand-sm bg-dark navbar-dark">
                <form action="../../search/search_singer.php" class="form-inline" method="GET">
                    <input type="text" class="form-control" placeholder="Search" name="singer">
                    <button class="btn btn-success" type="submit">Search</button>
                </form>
            </div>
            <header class="clearfix">
                <br><br>
                <?php
                echo "<h1 style='text-align: center; font-size: 25px;'><span>singer:" .$singer ."&nbsp;&nbsp;&nbsp; total comment:" .$total_com ."</span></h1>";
                ?>
				<br><br>
				<div class="support-note">
					<span class="note-ie">Sorry, only modern browsers.</span>
				</div>
				
			</header>
			
			<section class="main">

				<ul class="timeline">

                <?php
                    for ($i = 0;$i<$len;$i++)
                    {
                        $j=$i+1;
                        $temp = mysqli_query($link, "SELECT * from Albums where id='$albums[$i]'");
                        if ($temp){
                            $infos = mysqli_fetch_array($temp);
                            $introduction = mb_substr($infos['introduction'],0,300);
                            echo "<li class='event'>";
                            echo "<input type='radio' name='tl-group' checked/>";
                            echo "<label></label>";
                            echo "<div style='background-image: url(" .$infos['cover'] .");' class='thumb'><span>" .$infos['issue date'] ."</span></div>";
                            echo "<div class='content-perspective'>";
                            echo "<div class='content'>";
                            echo "<div class='content-inner'>";
                            echo "<a " . "href='".$infos['url']. "'>";
                            echo "<h3>" . $infos['name'] . "</h3>";
                            echo "</a>";
                            echo "<p>" . $introduction .  "......</p>";
                            echo "</div>";
                            echo "<br>";
                            echo "</li>";
                        }
                    }
                ?>
					
				</ul>
			</section>

		</div><!-- /container -->
	</body>
</html>