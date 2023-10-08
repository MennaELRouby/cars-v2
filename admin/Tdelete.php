<?php

if(isset($_GET["id"])){
    try{
        include_once("includes/con_db.php");
        $id=$_GET["id"];
        $sql="DELETE FROM `testimonials` WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
        echo "Deleted Successfully";

    } catch(PDOException $e)
    {
echo "connection failed:" .$e->getMessage();
    }
}else{
    "Invalid Request";
}
?>