<?php
    include("function/session.php");
    include("db/dbconn.php");
?>
<!DOCTYPE html>
<html>
<head>
    <title>OmarTill</title>
    <link rel="stylesheet" type="text/css" href="css/style.css" media="all">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <script src="js/jquery-1.7.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- Other JS files are included in bootstrap.min.js -->
</head>
<body>
    <div id="header">
        <img src="img/logo.jpg" alt="OmarTill Logo">
        <label>OmarTill</label>
        
        <?php
            $id = (int) $_SESSION['id'];
            $query = mysqli_query($conn, "SELECT * FROM customer WHERE customerid = '$id'") or die(mysqli_error($conn));
            $fetch = mysqli_fetch_array($query);
        ?>
    
        <ul>
            <li><a href="function/logout.php"><i class="icon-off icon-white"></i>logout</a></li>
            <li>Welcome:&nbsp;&nbsp;&nbsp;<a href="#profile" data-toggle="modal"><i class="icon-user icon-white"></i><?php echo htmlspecialchars($fetch['firstname']); ?> <?php echo htmlspecialchars($fetch['lastname']); ?></a></li>
        </ul>    
    </div>
    
    <div id="profile" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="width:700px;">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
            <h3 id="myModalLabel">My Account</h3>
        </div>
        <div class="modal-body">
            <?php
                $id = (int) $_SESSION['id'];
                $query = mysqli_query($conn, "SELECT * FROM customer WHERE customerid = '$id'") or die(mysqli_error($conn));
                $fetch = mysqli_fetch_array($query);
            ?>
            <center>
                <form method="post">
                    <center>
                        <table>
                            <tr>
                                <td class="profile">Name:</td><td class="profile"><?php echo htmlspecialchars($fetch['firstname']); ?> <?php echo htmlspecialchars($fetch['mi']); ?> <?php echo htmlspecialchars($fetch['lastname']); ?></td>
                            </tr>
                            <tr>
                                <td class="profile">Address:</td><td class="profile"><?php echo htmlspecialchars($fetch['address']); ?></td>
                            </tr>
                            <tr>
                                <td class="profile">Country:</td><td class="profile"><?php echo htmlspecialchars($fetch['country']); ?></td>
                            </tr>
                            <tr>
                                <td class="profile">ZIP Code:</td><td class="profile"><?php echo htmlspecialchars($fetch['zipcode']); ?></td>
                            </tr>
                            <tr>
                                <td class="profile">Mobile Number:</td><td class="profile"><?php echo htmlspecialchars($fetch['mobile']); ?></td>
                            </tr>
                            <tr>
                                <td class="profile">Telephone Number:</td><td class="profile"><?php echo htmlspecialchars($fetch['telephone']); ?></td>
                            </tr>
                            <tr>
                                <td class="profile">Email:</td><td class="profile"><?php echo htmlspecialchars($fetch['email']); ?></td>
                            </tr>
                        </table>
                    </center>
        </div>
        <div class="modal-footer">
            <a href="account.php?id=<?php echo htmlspecialchars($fetch['customerid']); ?>"><input type="button" class="btn btn-success" name="edit" value="Edit Account"></a>
            <button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Close</button>
        </div>
                </form>
            </div>
        </div>
    </div>
        
    <br>
    <div id="container">
    
        <div class="nav">
            <ul>
                <li><a href="home.php"><i class="icon-home"></i>Home</a></li>
                <li><a href="product1.php"><i class="icon-th-list"></i>Product</a></li>
                <li><a href="aboutus1.php"><i class="icon-bookmark"></i>About Us</a></li>
                <li><a href="contactus1.php"><i class="icon-inbox"></i>Contact Us</a></li>
                <li><a href="privacy1.php"><i class="icon-info-sign"></i>Privacy Policy</a></li>
                <li><a href="faqs1.php"><i class="icon-question-sign"></i>FAQs</a></li>
            </ul>
        </div>
        
        <div class="nav1">
            <ul>
                <li><a href="product1.php" class="active" style="color:#111;">Basketball</a></li>
                <li>|</li>
                <li><a href="football1.php">Football</a></li>
                <li>|</li>
                <li><a href="running1.php">Running</a></li>
            </ul>
            <?php echo "<a href='cart.php?id=".htmlspecialchars($id)."&action=view'><button class='btn btn-inverse' style='right:1%; position:fixed; top:10%;'><i class='icon-shopping-cart icon-white'></i> View Cart</button></a>" ?>
        </div>
    
        <div id="content">
            <br />
            <br />
            <div id="product">
                <form method="post">
                
                <?php 
                    include ('function/addcart.php');
                    
                    $query = mysqli_query($conn, "SELECT * FROM product WHERE category='basketball' ORDER BY product_id DESC") or die(mysqli_error($conn));
                    
                        while($fetch = mysqli_fetch_array($query))
                            {
                            
                            $pid = $fetch['product_id'];
                            
                            $query1 = mysqli_query($conn, "SELECT * FROM stock WHERE product_id = '$pid'") or die(mysqli_error($conn));
                            $rows = mysqli_fetch_array($query1);
                            
                            $qty = $rows['qty'];
                            if($qty > 5){
                                echo "<div class='float'>";
                                echo "<center>";
                                echo "<a href='details.php?id=".htmlspecialchars($fetch['product_id'])."'><img class='img-polaroid' src='photo/".htmlspecialchars($fetch['product_image'])."' height='300px' width='300px' alt='Product Image'></a>";
                                echo htmlspecialchars($fetch['product_name']);
                                echo "<br />";
                                echo "P ".htmlspecialchars($fetch['product_price']);
                                echo "<br />";
                                echo "<h3 class='text-info' style='position:absolute; margin-top:-90px; text-indent:15px;'> Size: ".htmlspecialchars($fetch['product_size'])."</h3>";
                                echo "</center>";
                                echo "</div>";
                            }
                            }
                ?>
                
                </form>
            </div>
        </div>
        
    <br />
    </div>
    <br />
    <div id="footer">
        <div class="foot">
            <label style="font-size:17px;"> Copyright &copy; </label>
            <p style="font-size:25px;">OmarTill GmbH. 2024</p>
        </div>
            
        <div id="foot">
            <h4>Links</h4>
            <ul>
                <a href="http://www.facebook.com"><li>Facebook</li></a>
                <a href="http://www.twitter.com"><li>Twitter</li></a>
                <a href="http://www.pinterest.com/"><li>Pinterest</li></a>
            </ul>
        </div>
    </div>
</body>
</html>
