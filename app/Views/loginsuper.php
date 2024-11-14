<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PORTAIL RH - CHU DE COCODY</title>

    <!-- Custom fonts for this template-->
    <link href="<?php echo base_url('/vendor/fontawesome-free/css/all.min.css');?>" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?php echo base_url('css/sb-admin-2.css');?>" rel="stylesheet">

</head>

<body class="bg-gradient-primary d-flex align-items-center" style="min-height: 100vh;">

<div class="d-flex container" style="background: linear-gradient(to bottom, #ebffeb 30%, #ffffff 30% 90%, #4e73df 90%);">

        <!-- Outer Row -->
        <div class="row justify-content-center d-flex align-items-center w-100">

            <div class="col-12">
                <br/>
                <div class="card border-0 mb-5 pt-5" style="background: transparent;">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row d-flex">
                            <div class="col-lg-5 shadow-lg p-0">
                                <article class="bg-white text-dark d-none d-lg-flex flex-column justify-content-center align-items-center h-100 w-100 p-4">
                                    <div class="h-100">
                                        <img src="<?php echo base_url('/img/nurse-img.jpg');?>" alt="Logo CHU Cocody" title="Logo CHU Cocody" style="width: 100%; height: 100%; object-fit: none;"/>
                                    </div>
                                </article>
                            </div>
                            <div class="col-lg-7 p-0 d-flex align-items-center justify-content-center">
                                <div class="w-100 py-0 px-5">
                                    <div class="text-center d-flex flex-column align-items-center">
                                        </br>
                                        <div class="logo rounded-circle overflow-hidden d-flex position-absolute p-2" style="height: 100px;  width: 100px; background-color: #ffffff; top: -60px; right: 10px;">
                                            <img src="<?php echo base_url('/img/CHU-logo.jpg');?>" alt="Logo CHU Cocody" title="Logo CHU Cocody" style="width:100%; height:100%"/>
                                        </div>
                                        </br>
                                        <h3 class="text-center text-dark" style="font-weight: bold;">Bienvenue sur votre Portail RH!</h3>
                                        <h3 class="text-dark w-100 mt-4" style="font-weight: bold; text-align: left;">Connexion</h3>
                                    </div>
                                    
                                        <?php
                                            if (isset($toast) && isset($_POST['go']) && !empty($_POST['go'])) {
                                            echo ' <div class="alert alert-warning alert-dismissible fade show" role="alert">  
                                                '.$toast.' 
                                                </div>';
                                            }

                                            if (isset($_SESSION['toast']) && !empty($_SESSION['toast'])) {
                                            echo ' <div class="alert alert-warning alert-dismissible fade show" role="alert" style="color: #0f5132; background-color: #d1e7dd; border-radius: 1px solid #badbcc;">  
                                                '.$_SESSION['toast'].' 
                                                </div>';
                                                //unset($_SESSION['toast']);
                                            }
                                        ?>
                         
                                     <?php

                                        helper('form');
                                        echo form_open('home/loginsuper');
                                        
                                    ?>
                                        <div class="form-group mb-3">
                                            <label for="mobile mb-3">Contact précédé de +225</label>
                                            <input type="mobile" class="form-control form-control-user"
                                                id="mobile" name="mobile" aria-describedby="mobile" 
                                                placeholder="+2250505050505" required
                                            />
                                        </div>
                                        <div class="form-group mb-4">
                                            <label for="password mb-3">Code</label>
                                            <input type="password" class="form-control form-control-user"
                                                id="password" name="password"
                                                placeholder="Code de validation"
                                            />
                                            
                                            
                                        </div>
                                        
                                        <div class="d-flex justify-content-center mb-3">
                                            <button type="submit" class="btn btn-primary mb-3" name="go" value="go">connexion</button>
                                        </div>
                                        
                                        <?php  
										
										//var_dump($cnxerror);
										
										?>
                                        
                                    </form>
                                    
                                    
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?php echo base_url('vendor/jquery/jquery.min.js');?>"></script>
    <script src="<?php echo base_url('vendor/bootstrap/js/bootstrap.bundle.min.js');?>"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?php echo base_url('vendor/jquery-easing/jquery.easing.min.js');?>"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?php echo base_url('js/sb-admin-2.min.js');?>"></script>

</body>

</html>