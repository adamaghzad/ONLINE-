<?php

	include "connection.php";
	include "student_navbar.php";
    $res=mysqli_query($db,"SELECT * FROM category");

?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Library Management System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Kaushan+Script&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
</head>
<body>
    
    
    <div class="all-books">
        <div class="search-bar">
            <form action="" method='post'>
                <select name="category" class="select-category">
                    <option value="selectcat">Select Category</option>
                    <?php while($row=mysqli_fetch_array($res)):;?>
                        <option value="<?php echo $row[0];?>"><?php echo $row[1];?></option>
                    <?php endwhile;?>
                </select>
                <input type="search" name='search' placeholder='Search by Book Name'>
                <button type='submit' name='submit'><i class="fas fa-search"></i></button>
            </form>
        </div>
        <div class="small-container">
            <!-- <h2 class="all-books-title">All Books</h2> -->
            <?php
            if(isset($_POST['submit']))
            {
                if($_POST['category']!="selectcat")
                {
                
                $cat = mysqli_query($db,"SELECT categoryname FROM category where categoryid = $_POST[category];");
                $row=mysqli_fetch_assoc($cat);
                ?>
                <h2 class='all-books-title'>
                <?php
                echo $row['categoryname'];
                ?></h2>
                <?php     
                $q=mysqli_query($db,"SELECT books.bookid,books.bookpic,books.bookname,category.categoryname,authors.authorname,books.ISBN,books.price,quantity,status from  `books` join `category` on category.categoryid=books.categoryid join `authors` on authors.authorid=books.authorid where bookname like '%$_POST[search]%' AND books.categoryid = $_POST[category];");
                
                if(mysqli_num_rows($q)==0)
                {
                    echo "Sorry! No Books found. Try searching again";

                }
                else{
                    ?>
                    <div class="row">
                    <?php
                        while($row=mysqli_fetch_assoc($q)){
                            ?>
                            <div class="card">
                                <!-- <img src="images/c.jpg" alt="">  -->
                                <?php
                                    echo "<img src='images/".$row['bookpic']."'>";
                                ?>
                                <div class="card-body">
                                <h4 style="font-size: 18px;">
                                    <?php
                                        echo $row['bookname'];
                                    ?></h4>
                                    <p style="font-size: 18px">Price: 
                                    <?php
                                        echo $row['price'];
                                    ?> MAD.</p>
                                
                                <div class="overlay"></div>
                                <div class="sub-card">
                                <p><b>Book Name: &nbsp;</b> 
                                <?php
                                    echo $row['bookname'];
                                ?></p>  
                                <p><b>Category Name: &nbsp;</b> 
                                <?php
                                    echo $row['categoryname'];
                                ?></p>
                                <p><b>Author Name: &nbsp;</b> 
                                <?php
                                    echo $row['authorname'];
                                ?></p>
                                <p><b>ISBN: &nbsp;</b> 
                                <?php
                                    echo $row['ISBN'];
                                ?></p>
                                <p><b>Quantity: &nbsp;</b> 
                                <?php
                                    echo $row['quantity'];
                                ?></p>
                                <p><b>Price:</b> 
                                <?php
                                    echo $row['price'];
                                ?> MAD.</p> 
                                <p><b>Status: &nbsp;</b>
                                <span>
                                <?php
                                    echo $row['status'];
                                ?></span> </p>
                                </div>
                            </div>
                            </div>
                            <?php
                        }
                    ?>
                    </div>
                <?php 
                }  
                }
                else{
                    ?><h2 class="all-books-title">All Books</h2>
                <?php
                $q=mysqli_query($db,"SELECT books.bookid,books.bookpic,books.bookname,category.categoryname,authors.authorname,books.ISBN,books.price,quantity,status from  `books` join `category` on category.categoryid=books.categoryid join `authors` on authors.authorid=books.authorid where bookname like '%$_POST[search]%'; ");
                if(mysqli_num_rows($q)==0)
                {
                    echo "Sorry! No Books found. Try searching again";

                }
                else{
                    ?>
                    <div class="row">
                    <?php
                    while($row=mysqli_fetch_assoc($q)){
                        ?>
                        <div class="card">
                            <!-- <img src="images/c.jpg" alt="">  -->
                            <?php
                                echo "<img src='images/".$row['bookpic']."'>";
                            ?>
                            <div class="card-body">
                            <h4 style="font-size: 18px;">
                                <?php
                                    echo $row['bookname'];
                                ?></h4>
                                <p style="font-size: 18px">Price: 
                                <?php
                                    echo $row['price'];
                                ?> MAD.</p>
                            
                            <div class="overlay"></div>
                            <div class="sub-card">
                            <p><b>Book Name: &nbsp;</b> 
                            <?php
                                echo $row['bookname'];
                            ?></p>  
                            <p><b>Category Name: &nbsp;</b> 
                            <?php
                                echo $row['categoryname'];
                            ?></p>
                            <p><b>Author Name: &nbsp;</b> 
                            <?php
                                echo $row['authorname'];
                            ?></p>
                            <p><b>ISBN: &nbsp;</b> 
                            <?php
                                echo $row['ISBN'];
                            ?></p>
                            <p><b>Quantity: &nbsp;</b> 
                            <?php
                                echo $row['quantity'];
                            ?></p>
                            <p><b>Price:</b> 
                            <?php
                                echo $row['price'];
                            ?> MAD.</p> 
                            <p><b>Status: &nbsp;</b>
                            <span>
                            <?php
                                echo $row['status'];
                            ?></span> </p>
                            </div>
                        </div>
                        </div>
                        <?php
                    }
                    ?>
                    </div>
                <?php 
                } 
                }
                  
            }
            else{
                ?><h2 class="all-books-title">All Books</h2>
                <div class="row">
                <?php
                $res=mysqli_query($db,"SELECT books.bookid,books.bookpic,books.bookname,category.categoryname,authors.authorname,books.ISBN,books.price,quantity,status from  `books` join `category` on category.categoryid=books.categoryid join `authors` on authors.authorid=books.authorid;");
                while($row=mysqli_fetch_assoc($res)){
                    ?>
                    <div class="card">
                        <!-- <img src="images/c.jpg" alt="">  -->
                        <?php
                            echo "<img src='images/".$row['bookpic']."'>";
                        ?>
                        <div class="card-body">
                            <h4 style="font-size: 18px;">
                                <?php
                                    echo $row['bookname'];
                                ?></h4>
                                <p style="font-size: 18px">Price: 
                                <?php
                                    echo $row['price'];
                                ?> MAD.</p>
                            
                            <div class="overlay"></div>
                            <div class="sub-card">
                            <p><b>Book Name: &nbsp;</b> 
                            <?php
                                echo $row['bookname'];
                            ?></p>  
                            <p><b>Category Name: &nbsp;</b> 
                            <?php
                                echo $row['categoryname'];
                            ?></p>
                            <p><b>Author Name: &nbsp;</b> 
                            <?php
                                echo $row['authorname'];
                            ?></p>
                            <p><b>ISBN: &nbsp;</b> 
                            <?php
                                echo $row['ISBN'];
                            ?></p>
                            <p><b>Quantity: &nbsp;</b> 
                            <?php
                                echo $row['quantity'];
                            ?></p>
                            <p><b>Price:</b> 
                            <?php
                                echo $row['price'];
                            ?> MAD.</p> 
                            <p><b>Status: &nbsp;</b>
                            <span>
                            <?php
                                echo $row['status'];
                            ?></span> </p>
                             <p><b><<button onclick=></button></b> 
                             <?php
                                echo $row['open']
                             ?> open </p>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
                </div>
            <?php 
            }
            ?>
        </div>
    </div>
    
    <div class="footer">
        <div class="footer-row">
            <div class="footer-left">
                <h1>LIBRARY MANAGEMANT</h1>
                <p><i class="far fa-clock"></i>BOOKS</p>
                <p><i class="far fa-clock"></i>ADMIN </p>
            </div>
            <div class="footer-middle">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3329.4916398557434!2d-7.8340780319101455!3d33.436495570112356!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xda883b5919db4c9%3A0xdbe98fe052d03923!2sAlf%20Sahel!5e0!3m2!1sfr!2sma!4v1662127912184!5m2!1sfr!2sma" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>            </div>
            <div class="footer-right">
                <h1>contact </h1>
                <p>moroco | had soualem | alf sahel |<i class="fas fa-map-marker-alt"></i></p>
                <p>s.aghzaf14@gmail.com<i class="fas fa-paper-plane"></i></p>
                <p>+212 661247974<i class="fas fa-phone-alt"></i></p>
            </div>
        </div>
        <div class="social-links">
            <i class="fab fa-facebook-f"></i>
            <i class="fab fa-twitter"></i>
            <i class="fab fa-instagram-square"></i>
            <i class="fab fa-youtube"></i>
            <p>&copy; 2022 Copyright by | ADAM AGHZAF |</p>
        </div>
    </div>
</body>
</html>