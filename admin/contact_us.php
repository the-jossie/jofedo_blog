<?php
session_start();

// include function file
require_once('functions/DatabaseClass.php');

$db_connect = new DatabaseClass("localhost", "blog", "root", "");

if(!isset($_SESSION['admin']))
{
	header("location:adminlogin.php");
}

if (isset($_GET['type']) && trim($_GET['type']) != '')
{
    $type = trim($_GET['type']);

    if ($type == 'delete')
    {
        $id = trim($_GET['id']);
        
        // Execute a Delete statement
        $sql = "DELETE FROM contact_us WHERE id = :id";
        $stmt = $db_connect->Remove($sql, ['id' => $id]);

        // Close statement
        unset($stmt);
    }
}

// Populate data from database
$sql = "SELECT * FROM contact_us ORDER BY id DESC";
$result = $db_connect->Select($sql);
?>

<!DOCTYPE html>
<html>
    <head>
    <!-- Basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">   
   
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
     <!-- Site Metas -->
    <title>Food Ordering System</title>  
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Site Icons -->
    <link rel="shortcut icon" href="../images/favicon.ico" type="image/x-icon" />
    <link rel="apple-touch-icon" href="../images/apple-touch-icon.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap-1.css">

    <!-- Site CSS -->
    <link rel="stylesheet" href="style.css">
    <!-- ALL VERSION CSS -->
    <link rel="stylesheet" href="../css/versions.css">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="../css/responsive.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../css/custom.css">
    </head>
    <body>
        

            <div class="wrapper">
                <nav id="sidebar">
                    <div class="sidebar-header">
                        <h3 style="color: white">Admin Panel</h3>
                    </div>
                    <ul class="list-unstyled components">
                        <li>
                            <a href="product.php">Posts</a>
                        </li>
                        <li>
                            <a href="users.php">Users</a>
                        </li>
                        <li>
                            <a class="active" href="contact_us.php">Contact Us</a>
                        </li>
                        <li>
                            <a href="logout.php">Logout</a>
                        </li>
                    </ul>
                </nav>
                <div id="content" style="padding-left: 20px; width: 100vw">
                    <nav class="navbar navbar-expand-lg navbar-light bg-light">
                        <div class="container-fluid">
                            <button class="btn btn-warning" type="button" id="sidebarCollapse" style="background: #7386D5;">&#9776;</button>
                        </div>
                    </nav>
                    <div class="title">
                        <h3>Contact Us</h3>
                    </div>
                    <div class="table" style="width: 100%;">
                        <table style="width: 100%">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Comment</th>
                            <th>Date</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $i = 1;
                            foreach ($result as $row)
                            {
                        ?>
                            <tr>
                                <td><?php echo $i ?></td>
                                <td><?php echo $row['id'] ?></td>
                                <td><?php echo $row['name'] ?></td>
                                <td><?php echo $row['email'] ?></td>
                                <td><?php echo $row['mobile'] ?></td>
                                <td><?php echo $row['comment'] ?></td>
                                <td><?php echo $row['added_on'] ?></td>
                                <td>
                                    <?php
                                    echo "&nbsp;<span class='sett delete'><a href='?type=delete&id=" . $row['id'] .  "'>Delete</a><span>";
                                    ?>
                                </td>
                            </tr>
                        <?php
                        ++$i;
                        }
                        ?>
                    </tbody>
                        </table>
                    </div>

                    <div class="copyrights">
                        <div class="container">
                            <div class="row">
                                <div style="text-align: center; width: 100%;">
                                        <p>All Rights Reserved. &copy; 2020 <b><a href="#">JOFEDO   </a></b> Developed by : <a href=""><b>Idowu Joseph</b></a></p>
                                    </div>
                            </div>
                        </div><!-- end container -->
                    </div><!-- end copyrights -->
                </div>
                
            </div>


            <a href="#" id="scroll-to-top" class="dmtop global-radius"><i class="fa fa-angle-up"></i></a>

            <script src="js/custom.js"></script>
    </body>
</html>