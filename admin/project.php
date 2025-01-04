<?php
    include_once 'header.php';
    include_once '../includes/connect.php';
    if(isset($_POST['project_add'])){
        $projectTitle = $_POST['projectTitle'];
        $projectDescription = $_POST['projectDescription'];

        $targetDir = "../img/";
        $targetFile = $targetDir .basename($_FILES["projectImage"]["name"]);
        $uploadok = 1;

        $filetype = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        if($filetype != "jpg" && $filetype != "png" && $filetype != "jpeg" && $filetype != "gif")
        {
            echo "<script>alert('Only JPG, PNG, JPEG and GIF files are allowed.')</script>";
            $uploadok = 0;
        }

        if($uploadok && move_uploaded_file($_FILES["projectImage"]["tmp_name"],$targetFile))
        {
            $projectImage = $targetFile;

            $insert_query = "INSERT INTO projects (protitle, prodescription, proimage) VALUES (?, ?, ?)";
            $stmt = mysqli_prepare($con, $insert_query);
            mysqli_stmt_bind_param($stmt, 'sss',  $projectTitle, $projectDescription, $projectImage);
            
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
                            <h5>Add your projects</h5>
                            <form action="" method="POST" id="projectForm" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="projectImage">Upload Project Image:</label>
                                    <input type="file" id="itemImage" name="projectImage" accept="image/*" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="projectTitle">Skill Title:</label>
                                    <input type="text" id="itemTitle" name="projectTitle" class="form-control" rows="3" ></input>
                                </div>
                                <div class="form-group">
                                    <label for="projectDescription">Skill Description:</label>
                                    <textarea id="itemDescription" name="projectDescription" class="form-control" rows="3" placeholder="Write a short description..."></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary" name="project_add">Submit</button>
                            </form>
                        </div>
                        
                        
                    </div>
                </form>
<?php
    include_once 'footer.php';
?>