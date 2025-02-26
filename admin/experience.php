<?php
    include_once 'header.php';
    include_once '../includes/connect.php';
    if(isset($_POST['ex_add'])){
        $exTitle = $_POST['exTitle'];
        $exDescription = $_POST['exDescription'];

        $targetDir = "../img/";
        $fileName = basename($_FILES["exImage"]["name"]);
        $targetFile = $targetDir . $fileName;
        $ImagePath = "img/" . $fileName;
        $uploadok = 1;

        $filetype = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        if($filetype != "jpg" && $filetype != "png" && $filetype != "jpeg" && $filetype != "gif")
        {
            echo "<script>alert('Only JPG, PNG, JPEG and GIF files are allowed.')</script>";
            $uploadok = 0;
        }

        if($uploadok && move_uploaded_file($_FILES["exImage"]["tmp_name"],$targetFile))
        {
            $exImage = $ImagePath;

            $insert_query = "INSERT INTO experience (extitle, exdesc, eximage) VALUES (?, ?, ?)";
            $stmt = mysqli_prepare($con, $insert_query);
            mysqli_stmt_bind_param($stmt, 'sss', $exTitle, $exDescription, $exImage);
            
            // Execute the query
            if (mysqli_stmt_execute($stmt)) {
                echo "<script>alert('Experience has been added successfully')</script>";
            }else {
                echo "<script>alert('Error adding skill: " . mysqli_error($con) . "')</script>";

            }

            mysqli_stmt_close($stmt);
        } else {
            echo "<script>alert('Error uploading file')</script>";
            
        }
        
    }
?>
                        
                        
                        <div class="add-item">
                            <h5>Add/Remove/Update your Experinces</h5>
                            <form action="" method="POST" id="exForm" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="exImage">Upload Related Image:</label>
                                    <input type="file" id="itemImage" name="exImage" accept="image/*" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="exTitle">Experience Title:</label>
                                    <input type="text" id="itemTitle" name="exTitle" class="form-control" rows="3" ></input>
                                </div>
                                <div class="form-group">
                                    <label for="exDescription"> Description:</label>
                                    <textarea id="itemDescription" name="exDescription" class="form-control" rows="3" placeholder="Write a short description..."></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary" name="ex_add">Submit</button>
                            </form>
                        </div>
                        
                        
                    </div>
                </form>
<?php
    include_once 'footer.php';
?>