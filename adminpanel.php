  <html> <body>  

<?php   
 session_start();  
 $connect = mysqli_connect("localhost", "root", "", "tbl_product");  
?>
<script type="text/javascript" src="jquery.js"></script>


<h3>Админ панель</h3>
<form action="" method="post" id="form">
<table>    <tr>
        <td>Наименование:</td>
        <td><input type="text" name="Name" required="required"></td>
    </tr>
    <tr>
        <td>Цена1:</td>
        <td><input type="text" name="Price1" size="3"  required="required"> руб.</td>       
    </tr>
    <tr>
        <td>Цена2:</td>
        <td><input type="text" name="Price2" size="3" required="required" > руб.</td>      
    </tr>
     <tr>
        <td>Название-картинки:</td>
        <td><input onclick="console.log(event)" type="text" name="Image_name" size="3" required="required"></td>
    </tr>
    <tr>
        <td colspan="2"><input type="submit" value="OK"></td>
    </tr>
</table></form>
    <p><a href="index.php">перейти в магазин</a></p>


<?php



 //Если переменная Name передана
if ((isset($_POST['Name'])&&$_POST['Name']!="")&&(isset($_POST['Price1'])&&$_POST['Price1']!=""&&is_numeric($_POST['Price1']))&&(isset($_POST['Price2'])&&$_POST['Price2']!="")&&is_numeric($_POST['Price2'])) {
      $name = $_POST['Name'];
      $price1 = $_POST['Price1'];
      $price2 = $_POST['Price2'];
      $date = date("Y-m-d");
      $image = $_POST['Image_name'];
    //Вставляем данные, подставляя их в запрос
    $sql =  $connect->query("INSERT INTO `tbl_product` (`name`,`price1`,`price2`,`date`,`image`) 
                        VALUES ('$name','$price1','$price2','$date','$image')");
    
    //Если вставка прошла успешно
    if ($sql) {
        echo "<p>Данные успешно добавлены в таблицу.</p>";
    } else {
        echo "<p>Произошла ошибка.</p>";
    }
}
?>
<?php
//Удаляем, если что
if (isset($_GET['del'])) {
    $sql = $connect->query('DELETE FROM `tbl_product` WHERE `id` = "'.$_GET['del'].'"');
    if ($sql) {
        echo "<p>Товар удален.</p>";
    } else {
        echo "<p>Произошла ошибка.</p>";
    }
}

//Получаем данные
// Извлекает результирующий ряд в виде ассоциативного массива
$sql = $connect->query('SELECT `id`, `name` FROM `tbl_product`');
while ($result = $sql->fetch_assoc()) {
    echo $result['id'].") ".$result['name']." - <a href='?del=".$result['id']."'>Удалить</a><br>";
}
?>

 <script type="text/javascript">
$(document).ready(function(e){
    $("#form").submit(function() { 
            var form_data = $(this).serialize(); //собераем все данные из формы
            $.ajax({
            type: "POST", //Метод отправки
            url: "adminpanel.php", //путь до php фаила отправителя
            data: form_data,
            success: function(k) {
                 
                   
            }
            
    });
//e = event тип переменная текущего события
    e.preventDefault();//тоже вставлять вместе с return false
    e.stopPropagation();//остановит дальнейший  проход события
    return false;
}); 
});   
/*вообше return false
в события
как правило
отменяет стандартное поведение для данного события*/
</script>
  </body>  
 </html>