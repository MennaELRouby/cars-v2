<?php
    include_once("includes/logged.php");
    try{
        include_once("includes/conn.php");

        $sql = "SELECT * FROM `cars`";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        
    }catch(PDOException $e){
        echo "Connection failed: " . $e->getMessage();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Table V01</title>
    <link rel="stylesheet" href="cars.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
    <body>
    <?php include_once("includes/nav.php"); ?>
        <div id="wrapper">
         <h1>Cars List</h1>
         
         <table id="keywords" cellspacing="0" cellpadding="0">
           <thead>
             <tr>
               <th><span>Car Title</span></th>
               <th><span>Price</span></th>
               <th><span>Model</span></th>
               <th><span>Delete</span></th>
               <th><span>Update</span></th>
             </tr>
           </thead>
           <tbody>
            <?php
                foreach($stmt->fetchAll() as $row){
                    $title = $row["title"];
                    $price = $row["price"];
                    $model = $row["model"];
                    $id = $row["id"];
            ?>
             <tr>
               <td class="lalign"><?php echo $title ?></td>
               <td><?php echo $price ?></td>
               <td><?php echo $model ?></td>
               <td><a href="delete.php?id=<?php echo $id ?>" onclick="return confirm('Are you sure you want to delete?')"><img src="../img/delete.jpg" alt=""></a></td>
               <td><a href="UpdateCar.php?id=<?php echo $id ?>"><img src="../img/update.jpg" alt=""></a></td>
             </tr>

            <?php
                }
            ?>
             
           </tbody>
         </table>
        </div> 
       </body>
</body>
</html>
