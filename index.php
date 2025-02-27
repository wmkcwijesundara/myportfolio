<?php
                include_once 'includes/connect.php';

                $select_profile = "SELECT * FROM `profile` ";
                $result_profile = mysqli_query($con,$select_profile);
                $row = mysqli_fetch_assoc($result_profile);
                $pname = $row['name'];
                $pdesc = $row['overview'];
                $bgImage = $row['bg'];

                $select_skill = "SELECT * FROM `skills` ";
                $result_skill = mysqli_query($con,$select_skill);

                $select_project = "SELECT * FROM `projects` ";
                $result_project = mysqli_query($con,$select_project);

                $select_experience = "SELECT * FROM `experience` ";
                $result_experience = mysqli_query($con,$select_experience);

                $select_certificate = "SELECT * FROM `certification` ";
                $result_certificate = mysqli_query($con,$select_certificate);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>portfolio of Kavindu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

</head>
<body>

    <header>
        <div class="container-fluid p-0">
            <nav class="navbar navbar-expand-lg">
                <div class="container-fluid">
                  <a class="navbar-brand" href="#">Kavindu</a>
                  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>
                  <div class="mr-auto">
                  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                      <a class="nav-link" href="#skills">Skills</a>
                      <a class="nav-link" href="#projects">Projects</a>
                      <a class="nav-link" href="#experience">Experience</a>
                      <a class="nav-link" href="#certification">Certifications</a>
                      <a class="nav-link" href="#contact">Contact</a>
                    </div>
                    </div>
                  </div>
                </div>
              </nav>
        </div>

 

    <div class="container text-center" id="hero">
        <div class="row">
            <?php
                echo "
                <div class='col-md-12 col-sm-12'>
                    <h1>Hello,I'm $pname</h1>
                    <div class='panel text-center'>
                        <p>$pdesc</p>
                    </div>
                </div>";
            ?>

            <style>
                #hero {
                background: url('<?php echo $bgImage; ?>') no-repeat center center/cover;
                }
            </style>
        </div>
    </div>
    </header>
    <main>
        <section class="section-1">
            <div class="container text-center">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <h6>Skills</h6>
                        <h2>My Expertise in Computer <br>Networking</h2>
                    </div>
                </div>
            </div>
        </section>
        <section class="section-2 container-fluid text-center" id="skills">
            <div class="row">
                <?php
                    while($skill = mysqli_fetch_assoc($result_skill)){
                    $simage = $skill['simage'];
                    $sicon = $skill['sicon'];
                    $stitle = $skill['stitle'];
                    $sdesc = $skill['sdesc'];
                    echo "<div class='col-md-3'>
                    $sicon
                    <h4>$stitle</h4>
                    <p>$sdesc</p>
                </div>";
                }
                ?>
            </div>
        </section>
        <section class="section-3" id="projects">
        <?php
                  $counter = 0;
                  while($project = mysqli_fetch_assoc($result_project)){
                    $protitle = $project['protitle'];
                    $prodescription = $project['prodescription'];
                    $proimage = $project['proimage'];

                    if($counter % 2 ==0)
                    {
                        echo "<div class='row'>
                <div class='col-md-6'>
                    <div class='container text-left'>
                    <h6>Project</h6>
                    <h2>$protitle</h2>
                    <p>$prodescription</p>
                    <button>Explore</button>
                    </div>
                </div>
                <div class='col-md-6'>
                    <img src='$proimage' class='img-fluid custom-shape' alt='Custom Shaped Image'>
                </div>
            </div>";
                    }else{
                        echo "<div class='row'>
                <div class='col-md-6'>
                    <img src='$proimage' class='img-fluid custom-shape' alt='Custom Shaped Image'>
                </div>
                <div class='col-md-6'>
                    
                    <div class='container text-end'>
                        <h6>Project</h6>
                        <h2>$protitle</h2>
                        <p>$prodescription</p>
                        <button>Explore</button>
                        </div>
                </div>
            </div>";
                    }

                    $counter++;
                    
                  }
                ?>



        </section>
        <section class="section-4" id="experience">
            <div class="container text-center">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <h6>Experience</h6>
                        <h2>Unlocking Opportunities<br> Through Practical <br>Experience</h2>
                    </div>
                </div>
            </div>
            <?php
                    while($experience = mysqli_fetch_assoc($result_experience)){
                        $extitle = $experience['extitle'];
                        $exdesc = $experience['exdesc'];
                        $eximage = $experience['eximage'];
                        echo "
                                <div class='row'>
                                <hr>
                                <div class='col-md-6'>
                                    <div class='container text-left'>
                                        <h2>$extitle</h2>
                                        <p>$exdesc</p>
                                        <button>More info</button>
                                    </div>
                                </div>
                                    <div class='col-md-6'>
                                        <div class='container text-end'>
                                            <img src='$eximage'  alt='Custom Shaped Image' height='315px' width='553px'>
                                        </div>
                                    </div>
                                </div>";
                    }
            ?>
        </section>
        <section class="section-5" id="certification">
            <div class="container text-center">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <h6>Certifications</h6>
                        <h2>Certifying Skills for a Better<br> Tomorrow</h2>
                    </div>
                </div>
            </div>
            <?php
                    while($certificate = mysqli_fetch_assoc($result_certificate)){
                        $cauthority = $certificate['cauthority'];
                        $authname = $certificate['authname'];
                        $cimg = $certificate['cimg'];
                        $cdesc = $certificate['cdesc'];
                        echo "<div class='row'>
                                <div class='col-md-3' >
                                    <div class='container text-center'>
                                        <img src='$cauthority' style ='height: 50px; width: 50px;'>
                                        <h4>$authname</h4>
                                    </div>
                    
                                </div>
                                <div class='col-md-6'>
                                    <div class='container text-center'>
                                    <img src='$cimg'  alt='Custom Shaped Imag' height='315px' width='500px'>
                                    </div>
                                </div>
                                <div class='col-md-3'>
                                    <div class='container text-left'>
                                        <p>$cdesc</p>
                                    </div>
                                </div>
                                </div>";
                    }
            ?>        
        </section>
        <section class="section-6" id="contact">
            <div class="row">
            <div class="container text-left">
                    <div class="col-md-12 col-sm-12">
                        <h6>Contact</h6>
                        <h2>Stay Connected with My <br>Portfolio</h2>
                        <p>Designed engaging and professional presentations for clients<br> on Fiverr, 
                            focusing on visual storytelling, layout consistency,
                             and audience impact</p>
                        <button>connect</button>
                    </div>
                </div>
            </div>          
        </section>
    </main>
    <footer>
        <hr class="custom-line">
        <h6>© 2024 I am Kavindu Chelaka. All rights reserved.</h6>
    </footer>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>