<?php
    include_once 'header.php';
    include_once '../includes/connect.php';
    if(isset($_POST['profile_add'])){
        $profileTitle = $_POST['profileTitle'];
        $profileDescription = $_POST['profileDescription'];

        $targetDir = "../img/";
        $targetFile = $targetDir .basename($_FILES["bgImage"]["name"]);
        $uploadok = 1;

        $filetype = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        if($filetype != "jpg" && $filetype != "png" && $filetype != "jpeg" && $filetype != "gif")
        {
            echo "<script>alert('Only JPG, PNG, JPEG and GIF files are allowed.')</script>";
            $uploadok = 0;
        }

        if($uploadok && move_uploaded_file($_FILES["bgImage"]["tmp_name"],$targetFile))
        {
            $bgImage = $targetFile;

            $insert_query = "INSERT INTO profile (name, overview, bg) VALUES (?, ?, ?)";
            $stmt = mysqli_prepare($con, $insert_query);
            mysqli_stmt_bind_param($stmt, 'sss', $profileTitle, $profileDescription, $bgImage);
            
            // Execute the query
            if (mysqli_stmt_execute($stmt)) {
                echo "<script>alert('Skill has been added successfully')</script>";
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
                            <h5>Profile Overview</h5>
                            <form action="" method="POST" id="profileForm" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="skillImage">Upload Background Image:</label>
                                    <input type="file" id="itemImage" name="bgImage" accept="image/*" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="skillTitle">Profile Name:</label>
                                    <input type="text" id="itemTitle" name="profileTitle" class="form-control" rows="3" ></input>
                                </div>
                                <div class="form-group">
                                    <label for="skillDescription">Profile Description:</label>
                                    <textarea id="itemDescription" name="profileDescription" class="form-control" rows="3" placeholder="Write a short description..."></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary" name="profile_add">Submit</button>
                            </form>
                        </div>
                        
                        
                    </div>
                </form>
<?php
    include_once 'footer.php';
?>