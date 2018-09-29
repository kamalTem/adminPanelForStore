<?php   
 session_start();  
//session_destroy();
 $connect = mysqli_connect("localhost", "root", "", "tbl_product");   
 ?>  
 <!DOCTYPE html>  
 <html>  
    <head>  
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
      <script type="text/javascript" src="jquery.js"></script>
    </head>  
    <body>  
       <br />  
       <div class="container" style="width:700px;">  
            <?php  
            $query = "SELECT * FROM tbl_product ORDER BY id ASC";  
            $result = $connect->query($query);  
            if($result->num_rows > 0)  
            {  
                 while($row = $result->fetch_array())  
                 {  
            ?>  
            <!-- Обрабатывает ряд результата запроса, возвращая ассоциативный массив, численный массив или оба. -->
            <div class="col-md-4">  
                 <form method="post" action="index.php?action=add&id=<?php echo $row["id"]; ?>">  
                      <div style="border:1px solid #333; background-color:#f1f1f1; border-radius:5px; padding:16px;" align="center">  
                           <img src="<?php echo $row["image"]; ?>" class="img-responsive" /><br />  
                           <h4 class="text-info"><?php echo $row["name"]; ?></h4>  
                           <h4 class="text-danger"><?php echo $row["price1"]; ?></h4>  
                           <h4 class="text-danger"><?php echo $row["price2"]; ?></h4> 
                           <h4 class="text-danger"><?php echo $row["date"]; ?></h4>                   
                      </div>  
                 </form>  
            </div>  
            <?php  
                 }  
            }  
            ?>  
            <p><a href="adminpanel.php">перейти в админ панель</a></p>
            
        </div>  
      </div>  
    <br />  
    
  </body>  
 </html>