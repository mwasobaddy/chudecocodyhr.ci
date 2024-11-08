        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo base_url('/espaceagent/afficher/accueil');?>">
                <div class="sidebar-brand-icon rotate-n-15">
                 <!--    <i class="fas fa-laugh-wink"></i>-->
                </div>
                <div class="sidebar-brand-text mx-3"><!--ESPACE ADMINISTRATEUR--></sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="<?php echo base_url('/espaceagent/afficher/accueil');?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Tableau de bord</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Mes modules
            </div>
 <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#collapseOne"
                    aria-expanded="true" aria-controls="collapseOne">
                    <i class="fas fa-user"></i>
                    <span>Employés</span>
                </a>
                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Données utilisateur:</h6>
                        <a class="collapse-item" href="<?php echo base_url('/espaceagent/monprofil');?>">Ma fiche agent</a>
                      <!--  <h6 class="collapse-header">Données statistiques:</h6>
                        <a class="collapse-item" href="">Statistiques</a> -->
                 
                    </div>
                    
                </div>
            </li>
            
             <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-plane"></i>
                    <span>Absences &amp; Congés</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Mes demandes :</h6>
                      <!--  <a class="collapse-item" href="">Congés annuel</a>
                        <a class="collapse-item" href="">Permission</a>
                        <a class="collapse-item" href="">Changement planning</a> -->
                        
                        <a class="collapse-item" href="<?php echo base_url('/espaceagent/creercongeannuel');?>">Planning Congés annuels</a>
                         <?php
						 if($_SESSION['genre']==1) {
						 ?>
                        <a class="collapse-item" href="<?php echo base_url('/espaceagent/creercongematernite');?>">Congés de maternité</a>
                         
                        <?php
						 }
						 ?>
                        <a class="collapse-item" href="<?php echo base_url('/espaceagent/creerpermissiondd');?>">Permission jour à jour</a>
                        <a class="collapse-item" href="<?php echo base_url('/espaceagent/creerpermissionhh');?>">Permission heure à heure</a>
                    </div>
                    
                </div>
            </li>
            
             <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#collapseThree"
                    aria-expanded="true" aria-controls="collapseThree">
                    <i class="fas fa-clipboard-check"></i>
                    <span>Planification</span>
                </a>
                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Données utilisateur:</h6>
                        <a class="collapse-item" href="<?php echo base_url('/espaceagent/afficherplanpermanence');?>">Planning du mois</a>
                       <!-- <a class="collapse-item" href="">Planning de la semaine</a>
                        <a class="collapse-item" href="">Planning du jour</a> -->
                        <h6 class="collapse-header">Validation et demandes:</h6>
                        <a class="collapse-item" href="<?php echo base_url('/espaceagent/modifierplanning');?>">Changement de planning</a>
                    
                    </div>
                    
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="">
                    <i class="fas fa-award"></i>
                    <span>Bonus</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#collapseFour"
                    aria-expanded="true" aria-controls="collapseThree">
                    <i class="fas fa-highlighter"></i>
                    <span>Évaluation</span>
                </a>
                <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        
                        <a class="collapse-item" href="<?php echo base_url('/espaceagent/evaluation');?>">Objectives setting</a>
                    
                        <a class="collapse-item" href="<?php echo base_url('');?>">Annual Performance Review</a>
                    
                    </div>
                    
                </div>
            </li>
                   

          


 <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                SUPPORT
            </div>
 
 <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url('/espaceagent/guideuser');?>">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Guide de l'utilisateur</span></a>
            </li>

           

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <!-- <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div> -->

            <!-- Sidebar Message -->
            <div class="sidebar-card">
                
            </div>

        </ul>
        <!-- End of Sidebar -->