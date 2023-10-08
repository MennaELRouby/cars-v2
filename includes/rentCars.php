<?php
include_once("admin/includes/con_db.php");
try{
    $sql="SELECT * FROM `cars` WHERE published =1";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
}catch(PDOException $e){
    echo "Connection failed" .$e->getMessage();
}
?>
<div class="container-fluid py-5">
        <div class="container pt-5 pb-3">
            <h1 class="display-1 text-primary text-center">03</h1>
            <h1 class="display-4 text-uppercase text-center mb-5">Find Your Car</h1>
            <div class="row">
                <?php
                foreach($stmt->fetchAll() as $row){
                    $title = $row["title"];
                    $price = $row["price"];
                    $model = $row["model"];
                    $id = $row["id"];
                    $auto = $row["type"];
                    if($auto == 0)
                    {
                        $type="Manual";
                    }else{
                        $type="auto";
                    }
                    $properties = $row["properties"];
                    $image = $row["image"];
                    ?>
                
                <div class="col-lg-4 col-md-6 mb-2">
                    <div class="rent-item mb-4">
                        <img class="img-fluid mb-4" src="img/<?php echo $image ?>" alt="<?php echo $title ?>">
                        <h4 class="text-uppercase mb-4"><?php echo $title ?></h4>
                        <div class="d-flex justify-content-center mb-4">
                            <div class="px-2">
                                <i class="fa fa-car text-primary mr-1"></i>
                                <span><?php echo $model ?></span>
                            </div>
                            <div class="px-2 border-left border-right">
                                <i class="fa fa-cogs text-primary mr-1"></i>
                                <span><?php echo $type ?></span>
                            </div>
                            <div class="px-2">
                                <i class="fa fa-road text-primary mr-1"></i>
                                <span><?php echo $properties ?></span>
                            </div>
                        </div>
                        <a class="btn btn-primary px-3" href="detail.php?id=<?php echo $id ?>"><?php echo $price ?></a>
                    </div>
                </div>
                <?php
                }
                ?>