<?php
//include_once("includes/logged.php");
if($_SERVER["REQUEST_METHOD"]==="POST")
{
  try{
  require_once 'includes/con_db.php';
  $sql = "INSERT INTO `testimonials`(`name`, `position`, `content`, `image`) VALUES (?,?,?,?)";
  $name = $_POST["tname"];
  $position = $_POST["position"];
  $content = $_POST["content"];
  require_once 'includes/addimage.php';
  $stmt = $conn->prepare($sql);
  $stmt->execute([$name, $position, $content, $image_name]);
  
  echo "Inserted Successfully";

}
catch(PDOException $e)
{
  echo "Connection Failed:" . $e->getMessage();
}
}

?>
<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>Insert Testimonials</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
	</head>

	<body>
		<div class="container">
			<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="m-auto" style="max-width:600px" enctype="multipart/form-data">
				<h3 class="my-4">Edit / Update Testimonials</h3>
				<hr class="my-4" />
				<div class="form-group mb-3 row"><label for="title2" class="col-md-5 col-form-label">Name</label>
					<div class="col-md-7"><input type="text" class="form-control form-control-lg" id="tname" name="tname" required></div>
				</div>
				<hr class="bg-transparent border-0 py-1" />
				<div class="form-group mb-3 row"><label for="price6" class="col-md-5 col-form-label">Position</label>
					<div class="col-md-7"><input type="text" class="form-control form-control-lg" id="position" name="position"></div>
				</div>
				<hr class="bg-transparent border-0 py-1" />
				<div class="form-group mb-3 row"><label for="content4" class="col-md-5 col-form-label">Content</label>
					<div class="col-md-7"><textarea class="form-control form-control-lg" id="content" name="content" required></textarea></div>
				</div>
				<hr class="my-4" />
				<div>
					<label for="image" class="col-md-5 col-form-label">Select Image</label>
					<input type="file" id="image" name="image" accept="image/*">
				</div>
				<hr class="my-4" />
				<div class="form-group mb-3 row"><label for="insert10" class="col-md-5 col-form-label"></label>
					<div class="col-md-7"><button class="btn btn-primary btn-lg" type="submit">Insert</button></div>
				</div>
			</form>
		</div>
	</body>

</html>