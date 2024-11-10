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

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">
<br/>
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block"><img src="<?php echo base_url('/img/chu.jpg');?>" alt="Logo CHU Cocody" title="Logo CHU Cocody" style="width:100%; height:100%"/></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                    <br/>
                                        <h1 class="h4 text-gray-900 mb-4">Bienvenue sur le <br>Portail RH du CHU de Cocody</h1>
                                        
                                    </div>
                                    
                                      <?php
echo view('toast');
 ?>
                                    
                                     <?php

helper('form');
echo form_open('home/login');
  
?>

                                        <div class="form-group"><br/>
                                            <label for="mobile">Saisissez votre numéro de téléphone précédé de +225</label>
                                            <input type="tel" class="form-control form-control-user"
                                                id="mobile" name="mobile" aria-describedby="mobile" 
                                                placeholder="+2250505050505"
                                            >
                                        </div>
                                        <div class="form-group mb-4">
                                            <label for="password">Votre mot de passe</label>
                                            <input type="password" class="form-control form-control-user"
                                                id="password"
                                                name="password"
                                                placeholder="Mot de passe"
                                            >
                                            
                                            
                                        </div>
                                        
                                        <button type="submit" class="btn btn-primary" style="width:100%">Valider numéro</button>
                                        <br/>
                                        
                                        <?php  
										
										//var_dump($cnxerror);
										
										?>
                                        
                                     
                                        
                                        <br/>
                                        
                                       <?= \Config\Services::validation()->listErrors(); ?>
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