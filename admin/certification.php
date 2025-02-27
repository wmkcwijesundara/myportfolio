<?php
    include_once 'header.php';
    include_once '../includes/connect.php';
    
    if(isset($_POST['certificate_add'])){
        $auTitle = $_POST['auTitle'];
        $cDescription = $_POST['cDescription'];
        
        $targetDir = "../img/";
        
        // Handling cImage Upload
        $cImageFile = basename($_FILES["cImage"]["name"]);
        $targetFile1 = $targetDir . $cImageFile;
        $ImagePath1 = "img/" . $cImageFile;
        
        $auImageFile = basename($_FILES["auImage"]["name"]);
        $targetFile2 = $targetDir . $auImageFile;
        $ImagePath2 = "img/" . $auImageFile;

        $uploadOk = 1;
    
        // Allowed file types
        $allowedTypes = ["jpg", "jpeg", "png", "gif"];
        $fileType1 = strtolower(pathinfo($cImageFile, PATHINFO_EXTENSION));
        $fileType2 = strtolower(pathinfo($auImageFile, PATHINFO_EXTENSION));
        
        if(!in_array($fileType1, $allowedTypes) || !in_array($fileType2, $allowedTypes)) {
            echo "<script>alert('Only JPG, PNG, JPEG, and GIF files are allowed.')</script>";
            $uploadOk = 0;
        }
        
        if ($uploadOk) {
            if (move_uploaded_file($_FILES["cImage"]["tmp_name"], $targetFile1) && move_uploaded_file($_FILES["auImage"]["tmp_name"], $targetFile2)) {
                $cImage = $ImagePath1;
                $auImage = $ImagePath2;
                
                $insert_query = "INSERT INTO certification (cauthority, authname, cimg, cdesc) VALUES (?, ?, ?, ?)";
                $stmt = mysqli_prepare($con, $insert_query);
                mysqli_stmt_bind_param($stmt, 'ssss', $auImage, $auTitle, $cImage, $cDescription);
                
                if (mysqli_stmt_execute($stmt)) {
                    echo "<script>alert('Certificate has been added successfully')</script>";
                } else {
                    echo "<script>alert('Error adding Certification: " . mysqli_error($con) . "')</script>";
                }
                
                mysqli_stmt_close($stmt);
            } else {
                echo "<script>alert('Error uploading files')</script>";
            }
        }
    }
?>
                        
                        
                        <div class="add-item">
                            <h5>Add/Remove/Update your Certifications</h5>
                            <form action="" method="POST" id="certificateForm" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="skillImage">Upload Related Image:</label>
                                    <input type="file" id="itemImage" name="cImage" accept="image/*" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="authImage">Upload Issuing Auhtority Image:</label>
                                    <input type="file" id="itemImage" name="auImage" accept="image/*" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="skillTitle">Issuing Authority Name:</label>
                                    <input type="text" id="itemTitle" name="auTitle" class="form-control" rows="3" ></input>
                                </div>
                                <div class="form-group">
                                    <label for="skillDescription"> Description:</label>
                                    <textarea id="itemDescription" name="cDescription" class="form-control" rows="3" placeholder="Write a short description..."></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary" name="certificate_add">Submit</button>
                            </form>
                        </div>
                        
                        
                    </div>
                </form>
<?php
    include_once 'footer.php';
?>