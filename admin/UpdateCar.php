<?php
include_once("includes/logged.php");
include_once("includes/con_db.php");
$status=false;
if(isset($_GET["id"])){
	$id=$_GET["id"];
	$status=true;
}elseif($_SERVER["REQUEST_METHOD"] === "POST"){
	$id =$_POST["id"];
	$status=true;
	$title = $_POST["title"];
	$content = $_POST["content"];
	$price = $_POST["price"];
	$model = $_POST["model"];
	$type = $_POST["type"];
	$properties = $_POST["properties"];
	if(isset($_POST["published"]))
	{
		$published=1;
	}else{
		$published=0;
	}
	$oldImage= $_POST["img"];
	include_once("includes/updateImage.php");
	$sql="UPDATE `cars` SET `title`= ?,`content`=?,`price`=?,`model`=?,`type`=?,`properties`=?,`image`=?,`published`=? WHERE id=?";
	$stmt= $conn->prepare($sql);
	$stmt->execute([$title, $content, $price, $model, $type, $properties, $image_name, $published, $id]);
	echo "Updated successfully";
}
// Display the data in the form
if($status)
{
try{
$sql = "SELECT * FROM `cars` WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->execute(["$id"]);
$result = $stmt->fetch();
$title = $result["title"];
$content = $result["content"];
$price = $result["price"];
$model = $result["model"];
$id = $result["id"];
$type = $result["type"];
if($type){
	$auto = "selected";
	$manual="";
}else{
	$auto="";
	$manual="selected";
}
$properties = $result["properties"];
$image= $result["image"];
$published = $result["published"];
if($published){
	$checked = "checked";
}else{
	$checked ="";
} } catch(PDOException $e){
    echo "Can't dispaly the cars' data:" .$e->getMessage();
  }}
?>
<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>Edit / Update Car</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
	</head>

	<body>
		<?php
		if(($status))
		{
			?>
		<div class="container">
			<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="m-auto" style="max-width:600px" enctype="multipart/form-data">
				<h3 class="my-4">Edit / Update Car</h3>
				<hr class="my-4" />
				<div class="form-group mb-3 row"><label for="title2" class="col-md-5 col-form-label">Car Title</label>
					<div class="col-md-7"><input type="text" value="<?php echo $title ?>" class="form-control form-control-lg" id="title2" name="title" required></div>
				</div>
				<hr class="bg-transparent border-0 py-1" />
				<div class="form-group mb-3 row"><label for="content4" class="col-md-5 col-form-label">Content</label>
					<div class="col-md-7"><textarea class="form-control form-control-lg" id="content4" name="content" required><?php echo $content ?></textarea></div>
				</div>
				<hr class="bg-transparent border-0 py-1" />
				<div class="form-group mb-3 row"><label for="price6" class="col-md-5 col-form-label">Price</label>
					<div class="col-md-7"><input type="text" value ="<?php echo $price ?>" class="form-control form-control-lg" id="price6" name="price"></div>
				</div>
				<hr class="bg-transparent border-0 py-1" />
				<div class="form-group mb-3 row"><label for="model6" class="col-md-5 col-form-label">Model</label>
					<div class="col-md-7"><input type="text" value="<?php echo $model ?>" class="form-control form-control-lg" id="model6" name="model"></div>
				</div>
				<hr class="bg-transparent border-0 py-1" />
				<div class="form-group mb-3 row"><label for="select-option1" class="col-md-5 col-form-label">Auto / Manual</label>
					<div class="col-md-7"><select class="form-select custom-select custom-select-lg" id="select-option1" name="type">
							<option value="1" <?php echo $auto ?>>Auto</option>
							<option value="0" <?php echo $manual ?>>Manual</option>
							<option>Hypered</option>
						</select></div>
				</div>
				<hr class="bg-transparent border-0 py-1" />
				<div class="form-group mb-3 row"><label for="properties6" class="col-md-5 col-form-label">Properties</label>
					<div class="col-md-7"><input type="text" value="<?php echo $properties ?>" class="form-control form-control-lg" id="properties6" name="properties"></div>
				</div>
				<hr class="my-4" />
				<div>
					<label for="image" class="col-md-5 col-form-label">Select Image</label>
					<input type="file" id="image" name="image" accept="image/*">
					<img src="../img/<?php echo $image ?>" alt="<?php echo $title ?>" style="width:300px;">

				</div>
				<hr class="bg-transparent border-0 py-1" />
				<div class="form-group mb-3 row"><label for="model7" class="col-md-5 col-form-label">Published</label>
					<div class="col-md-7"><input type="checkbox" id="model7" name="published" <?php echo $checked ?>></div>
				</div>
				<input type="hidden" name="id" value="<?php echo $id ?>" >
				<input type="hidden" name="img" value="<?php echo $image ?>" >

				<hr class="my-4" />
				<div class="form-group mb-3 row"><label for="insert10" class="col-md-5 col-form-label"></label>
					<div class="col-md-7"><button class="btn btn-primary btn-lg" type="submit">Update</button></div>
				</div>
			</form>
		</div>
		<?php
		}else{
			echo "invalid request";
		} 
		?>
	</body>

</html>