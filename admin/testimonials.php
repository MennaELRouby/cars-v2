<?php
include_once("includes/logged.php");

try{
  include_once("includes/con_db.php");
  
  $sql = "SELECT * FROM `testimonials`";
  $stmt = $conn->prepare($sql);
  $stmt->execute();

} catch(PDOException $e){
  echo "Connection Failed:" .$e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Testimonials</title>
    <link rel="stylesheet" href="cars.css">
</head>
<body>
    <body>
        <div id="wrapper">
         <h1>Testimonials List</h1>
         
         <table id="keywords" cellspacing="0" cellpadding="0">
           <thead>
             <tr>
               <th><span>Name</span></th>
               <th><span>Position</span></th>
               <th><span>Delete</span></th>
               <th><span>Update</span></th>
             </tr>
           </thead>
           <tbody>
            <?php
             if($stmt->rowCount() > 0){
              foreach($stmt->fetchAll() as $row){
                $name = $row["name"];
                $position = $row["position"];
                $id = $row["id"];
              ?>
             <tr>
               <td class="lalign"><?php echo $name ?></td>
               <td><?php echo $position ?></td>
               <td><a href="Tdelete.php?id=<?php echo $id ?>" onclick="return confirm('Are you sure you want to delete?')"><img src="../img/delete.jpg"></a></td>
               <td><a href="UpdateTestimonials.php?id=<?php echo $id ?>"><img src="../img/update.jpg"></a></td>
             </tr>
             <?php
             } }else{
                echo "No data found";
              }
              ?>
           </tbody>
         </table>
        </div> 
       </body>
</body>
</html>
