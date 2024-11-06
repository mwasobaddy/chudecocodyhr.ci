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

<body class="bg-gradient-primary d-flex" style="min-height: 100vh;">

    <div class="d-flex container">

        <!-- Outer Row -->
        <div class="row justify-content-center d-flex align-items-center">

            <div class="col-xl-10 col-lg-12 col-md-9">
                <br/>
                <div class="card o-hidden border-0 shadow-lg my-5" style="background: rgb(255, 255, 255, 0.5); backdrop-filter: blur(200px);">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row d-flex flex-row-reverse">
                            <div class="col-lg-5 p-0">
                                <article class="bg-white text-dark d-flex flex-column justify-content-center align-items-center h-100 w-100 p-5">
                                    <div class="logo d-flex d-lg-none" style="height: 200px;  width: 200px;">
                                        <img src="<?php echo base_url('/img/CHU-logo.jpg');?>" alt="Logo CHU Cocody" title="Logo CHU Cocody" style="width:100%; height:100%"/>
                                    </div>
                                    <div class="text-center d-flex flex-column align-items-center">
                                        <h3 class="text-center text-dark" style="font-weight: bold;">Bienvenue sur le</br>portail RH du CHU de Cocody</h3>
                                        <hr class="hr d-none d-lg-flex bg-dark rounded-circle m-0 w-50 mb-3" style="height: 0.5px;" />
                                    </div>
                                    <div class="d-none d-lg-block">
                                        <p>Votre portail pour une expérience de travail transparente, efficace et engageante.</p>
                                        <p>Notre objectif est de fournir une plateforme intégrée qui améliore votre expérience et vous donne un accès facile aux outils et informations essentiels.</p>
                                    </div>
                                </article>
                            </div>
                            <div class="col-lg-7 p-0 d-flex align-items-center justify-content-center">
                                <div class=" py-0 px-5">
                                    <div class="text-center d-flex flex-column align-items-center">
                                        <div class="logo rounded-circle overflow-hidden d-none d-lg-flex mt-4 p-3" style="height: 200px;  width: 200px; border: 2px solid black; background-color: #ffffff;">
                                            <img src="<?php echo base_url('/img/CHU-logo.jpg');?>" alt="Logo CHU Cocody" title="Logo CHU Cocody" style="width:100%; height:100%"/>
                                        </div>
                                        <h3 class="text-dark mt-4" style="font-weight: bold;">Connexion à votre compte</h3>
                                        <hr class="hr bg-dark rounded-circle m-0 w-50" style="height: 0.5px;" />
                                        
                                        
                                    </div>
                                    
                                        <?php
                                            if (isset($toast) && isset($_POST['go']) && !empty($_POST['go'])) {
                                            echo ' <div class="alert alert-warning alert-dismissible fade show" role="alert">  
                                                '.$toast.' 
                                                </div>';
                                            }

                                            if (isset($_SESSION['toast']) && !empty($_SESSION['toast'])) {
                                            echo ' <div class="alert alert-warning alert-dismissible fade show" role="alert" style="background-color:#4877f9; color:#fff">  
                                                '.$_SESSION['toast'].' 
                                                </div>';
                                                //unset($_SESSION['toast']);
                                            }
                                        ?>
                                    
                                        <?php

                                            helper('form');
                                            echo form_open('home/login');
                                            
                                        ?>

                                        <div class="form-group mb-4">
                                            <label for="mobile mb-3">Saisissez votre numéro de téléphone précédé de +225</label>
                                            <input type="text" class="form-control form-control-user"
                                                id="mobile" name="mobile" aria-describedby="mobile" 
                                                placeholder="+2250505050505" required
                                            />
                                        </div>
                                        
                                        <button type="submit" class="btn btn-primary mb-3" name="go" value="go"  style="width:100%">Valider numéro</button>
                                        <br/>
                                        
                                        <?php  
										
										//var_dump($cnxerror);
										
										?>
                                        
                                     
                                        
                                        <br/>
                                        
                                      
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