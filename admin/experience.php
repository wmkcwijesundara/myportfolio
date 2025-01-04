<?php
    include_once 'header.php';
    include_once '../includes/connect.php';
    if(isset($_POST['skills_add'])){
        $skillTitle = $_POST['skillTitle'];
        $skillDescription = $_POST['skillDescription'];

        $targetDir = "../img/";
        $targetFile = $targetDir .basename($_FILES["skillImage"]["name"]);
        $uploadok = 1;

        $filetype = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        if($filetype != "jpg" && $filetype != "png" && $filetype != "jpeg" && $filetype != "gif")
        {
            echo "<script>alert('Only JPG, PNG, JPEG and GIF files are allowed.')</script>";
            $uploadok = 0;
        }

        if($uploadok && move_uploaded_file($_FILES["skillImage"]["tmp_name"],$targetFile))
        {
            $skillImage = $targetFile;

            $insert_query = "INSERT INTO skills (simage, sicon, stitle, sdesc) VALUES (?, ?, ?, ?)";
            $stmt = mysqli_prepare($con, $insert_query);
            mysqli_stmt_bind_param($stmt, 'ssss', $skillImage, $skillHTML, $skillTitle, $skillDescription);
            
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
                            <h5>Add/Remove/Update your skills</h5>
                            <form action="" method="POST" id="skillForm" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="skillImage">Upload Certificate Image:</label>
                                    <input type="file" id="itemImage" name="skillImage" accept="image/*" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="skillTitle">Ceertification  Title:</label>
                                    <input type="text" id="itemTitle" name="skillTitle" class="form-control" rows="3" ></input>
                                </div>
                                <div class="form-group">
                                    <label for="skillDescription">Skill Description:</label>
                                    <textarea id="itemDescription" name="skillDescription" class="form-control" rows="3" placeholder="Write a short description..."></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary" name="skills_add">Submit</button>
                            </form>
                        </div>
                        
                        
                    </div>
                </form>
<?php
    include_once 'footer.php';
?>