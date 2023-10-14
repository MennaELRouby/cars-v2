<?php
try{
    $id = $_GET["id"];
    $sql="SELECT * FROM `cars` WHERE id_category = ? and id <> ?";
    $stmtR = $conn->prepare($sql);
    $stmtR->execute([$id_category, $id]);
}catch(PDOException $e){
    echo "Connection failed" .$e->getMessage();
}
?>
<div class="container-fluid pb-5">
        <div class="container pb-5">
            <h2 class="mb-4">Related Cars</h2>
            <div class="owl-carousel related-carousel position-relative" style="padding: 0 30px;">
            <?php
            foreach($stmtR->fetchAll() as $row)
            {
                $rtitle = $row["title"];
                $rprice = $row["price"];
                $rmodel = $row["model"];
                $rimage= $row["image"];
                $rcontent = $row["content"];
                $rproperties = $row["properties"];
                $type= $row["type"];
                if($type){
                    $rtype="Auto";
                }else{
                    $rtype="Manual";
                }

            ?>
                <div class="rent-item">
                    <img class="img-fluid mb-4" src="img/<?php echo $rimage ?>" alt="<?php echo $rtitle ?>">
                    <h4 class="text-uppercase mb-4"><?php echo $rtitle ?></h4>
                    <div class="d-flex justify-content-center mb-4">
                        <div class="px-2">
                            <i class="fa fa-car text-primary mr-1"></i>
                            <span><?php echo $rmodel ?></span>
                        </div>
                        <div class="px-2 border-left border-right">
                            <i class="fa fa-cogs text-primary mr-1"></i>
                            <span><?php echo $rtype ?></span>
                        </div>
                        <div class="px-2">
                            <i class="fa fa-road text-primary mr-1"></i>
                            <span><?php echo $rproperties ?></span>
                        </div>
                    </div>
                    <a class="btn btn-primary px-3" href=""><?php echo $rprice ?></a>
                </div>
                <?php
            }
            ?> 
                
            </div>
        </div>
    </div>