<?php
// include function file
require_once('functions/DatabaseClass.php');

if(isset($_GET['title']))
{
    $slug = trim($_GET['title']);
    $db_connect = new DatabaseClass("localhost", "blog", "root", "");

    $sql = "SELECT * FROM posts WHERE slug = :slug";
    $post = $db_connect->Select($sql, ["slug" => $slug]);

    $query = "SELECT * FROM posts";
    $posts = $db_connect->Select($query);
}

?>

<!DOCTYPE html>
<html>
    <head>
        <!-- Mobile Metas -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
        <!-- Site Metas -->
        <title>Jofedo</title>  
        <meta name="keywords" content="">
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- Site Icons -->
        <link rel="shortcut icon" href="images/logo_3.png" type="image/x-icon" />
        <link rel="apple-touch-icon" href="images/logo_2.png">

        <title>Jofedo.com</title>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900" rel="stylesheet">    
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,700,800&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
        
        <link href="css/bootstrap.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="css/animate.css" />
        <link href="fonts/font-awesome.min.css" rel="stylesheet">
        <link rel="stylesheet" href="css/owl.carousel.min.css" />
        <link rel="stylesheet" href="css/owl.theme.default.min.css" />
        <link rel="stylesheet" href="css/style.css" />
    

        <script src="js/jquery-1.8.3.min.js"></script>

        <script src="owl-carousel/owl-carousel.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </head>
    <body>
        <header class="single">
            <div class="container">
                <div class="navbar-brand">
                    <a href="index.html">JOFEDO</a>
                </div>
                <nav>
                    <ul>
                        <li><a class="active" href="index.php">Home</a></li>
                        <li><a href="">News</a></li>
                        <li><a href="">About</a></li>
                        <li><a href="">Contact</a></li>
                    </ul>
                </nav>    
            </div>
        </header>
        
        <div class="container single">
            <div class="row" style="width: 100%">
                <div class="col-sm-8 col-md-8 col-lg-8">
                    <div class="main-posts">
                        <h1 style="margin-bottom: 20px;"><?php echo $post[0]['title']; ?></h1>
                        <img src="<?php echo "images/" . $post[0]["image"]; ?>" style="margin-bottom: 20px;"/>
                        <p><?php echo $post[0]['body']; ?></p>
                    </div>
                </div>
                <div class="col-sm-4 col-md-4 col-lg-4">
                    <div class="side-posts">
                        <h3>Hot Topics</h3>
                        <div class="row">
                            <div class="col-sm-6 col-md-6 col-lg-6">
                                <a href="#" class="btn">All</a>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-6">
                                <a href="#" class="btn">Recent</a>
                            </div>
                        </div>
                        <div>
                            <?php
                                foreach ($posts as $row)
                                {
                                    $id = $db_connect->Select("SELECT username FROM users WHERE id = :id", ['id' => $row['user_id']])
                            ?>
                                    <div class="row" style="margin-bottom: 20px;" >
                                        <div class="col-sm-4 col-md-4 col-lg-4">
                                            <img src="<?php echo "images/" . $row["image"]; ?>" />
                                        </div>
                                        <div class="col-sm-8 col-md-8 col-lg-8">
                                            <h5><?php echo $row['title']; ?></h5>
                                            <p style="color: rgba(0, 0, 0, 0.4);">By <?php echo $id[0]['username']; ?> | <?php echo date("j F Y ", strtotime($row['created_at'])); ?></p>
                                        </div>
                                    </div>
                            <?php
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>


<script src="js/custom.js"></script>

</body>
</html>