        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo base_url('/espacerespo/afficher/accueil');?>">
                <div class="sidebar-brand-icon rotate-n-15">
                 <!--    <i class="fas fa-laugh-wink"></i>-->
                </div>
                <div class="sidebar-brand-text mx-3"><!--ESPACE ADMINISTRATEUR--></sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="<?php echo base_url('/espacerespo/afficher/accueil');?>">
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
                    <i class="fas fa-users"></i>
                    <span>Employés</span>
                </a>
                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Données utilisateurs:</h6>
                        <a class="collapse-item" href="<?php echo base_url('/espacerespo/listagent');?>">Gestion des Agents</a>
                        <h6 class="collapse-header">Expression de besoins :</h6>
                        <a class="collapse-item" href="<?php echo base_url('/espacerespo/besoinservice');?>">Exprimer un besoin</a>
                        
                          <h6 class="collapse-header">Arrêtés de travail :</h6>
                        <a class="collapse-item" href="<?php echo base_url('/espacerespo/creerarrettravail');?>">Arrêt de travail</a>
                 
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
                         <a class="collapse-item" href="<?php echo base_url('/espacerespo/creercongeannuel');?>">Congé annuel</a>
                         <?php
						 if($_SESSION['genre']==1) {
						 ?>
                        
                        <a class="collapse-item" href="<?php echo base_url('/espacerespo/creercongematernite');?>">Congés de maternité</a>
                        
                        <?php
						 }
						 ?>
                        <a class="collapse-item" href="<?php echo base_url('/espacerespo/creerpermissiondd');?>">Permission jour à jour</a>
                        <a class="collapse-item" href="<?php echo base_url('/espacerespo/creerpermissionhh');?>">Permission heure à heure</a>
                    </div>
                    
                </div>
            </li>
            
             <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#collapseThree"
                    aria-expanded="true" aria-controls="collapseThree">
                    <i class="far fa-clipboard"></i>
                    <span>Planification</span>
                </a>
                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Données de base:</h6>
                        <a class="collapse-item" href="<?php echo base_url('/espacerespo/creerequipe');?>">Gestion des équipes</a>
                         <a class="collapse-item" href="<?php echo base_url('/espacerespo/creerplanpermanence');?>">Créer Planning du mois</a>
                        <a class="collapse-item" href="<?php echo base_url('/espacerespo/selectplan');?>">Attribuer Planning</a>
                        <a class="collapse-item" href="<?php echo base_url('/espacerespo/afficherplanpermanence');?>">Afficher Planning du mois</a>
                       <!-- <a class="collapse-item" href="">Planning de la semaine</a>
                        <a class="collapse-item" href="">Planning du jour</a>
                        <h6 class="collapse-header">Validation et demandes:</h6>
                        <a class="collapse-item" href="">Changement de planning</a>
                    -->
                    </div>
                    
                </div>
            </li>
            <!-- <li class="nav-item">
                <a class="nav-link" href="">
                    <i class="fas fa-award"></i>
                    <span>Bonus</span></a>
            </li> -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#collapseFour"
                    aria-expanded="true" aria-controls="collapseThree">
                    <i class="fas fa-highlighter"></i>
                    <span>Evaluation</span>
                </a>
                <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        
                        <a class="collapse-item" href="<?php echo base_url('/espacerespo/evaluation');?>">Fixation des objectifs</a>
                    
                    
                    </div>
                    
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url('espacerespo/bonus/managerReport');?>">
                    <i class="fas fa-award"></i>
                    <span>Bonus</span></a>
            </li>
            
             <!-- Nav Item - Pages Collapse Menu -->
           <!-- <li class="nav-item">
                <a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#collapseFor"
                    aria-expanded="true" aria-controls="collapseFor">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Configuration</span>
                </a>
                <div id="collapseFor" class="collapse" aria-labelledby="headingFor" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Données de base:</h6>
                        <a class="collapse-item" href="<?php //echo base_url('/espacerespo/creerdirection');?>">Directions</a>
                        <a class="collapse-item" href="<?php //echo base_url('/espacerespo/creersousdirection');?>">Sous-Directions</a>
                        <a class="collapse-item" href="<?php //echo base_url('/espacerespo/creerservice');?>">Services</a>
                        <a class="collapse-item" href="<?php //echo base_url('/espacerespo/creeremploi');?>">Emplois</a>
                        <a class="collapse-item" href="<?php //echo base_url('/espacerespo/creerfonction');?>">Fonctions</a>
                        <a class="collapse-item" href="<?php //echo base_url('/espacerespo/creergrade');?>">Grades</a>
                        <a class="collapse-item" href="<?php //echo base_url('/espacerespo/creerdroitaccess');?>">Droits d'accès</a>
                        <a class="collapse-item" href="<?php //echo base_url('/espacerespo/creerrole');?>">Rôles</a>
                        
                        
                        
                    </div>
                    
                </div>
            </li>
            
-->
       
        <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Mes validations
            </div>
         <li class="nav-item">
                <a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Validations en attente</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Congés et Absences :</h6>
                        <a class="collapse-item" href="<?php echo base_url('/espacerespo/validercongeannuel');?>">Congés annuels</a>
                        <a class="collapse-item" href="<?php echo base_url('/espacerespo/validercongematernite');?>">Congés de maternité</a>
                        <a class="collapse-item" href="<?php echo base_url('/espacerespo/validerpermissiondd');?>">Permission jour à jour</a>
                        <a class="collapse-item" href="<?php echo base_url('/espacerespo/validerpermissionhh');?>">Permission heure à heure</a>
                       <!-- <a class="collapse-item" href="forgot-password.html">Forgot Password</a> -->
                        <div class="collapse-divider"></div>
                        <h6 class="collapse-header">Planning :</h6>
                       <!--   <a class="collapse-item" href="<?php //echo base_url('/espacerespo/monprofil');?>">Planning service</a> -->
                        <a class="collapse-item" href="<?php echo base_url('/espacerespo/validerchangep');?>">Changement de planning</a>
                        <!-- <a class="collapse-item" href="blank.html">Blank Page</a> -->
                    </div>
                </div>
            </li>

          
       

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Mon profil
            </div>
 <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url('/espacerespo/monprofil');?>">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Fiche agent</span></a>
            </li>
            <!-- Nav Item - Pages Collapse Menu -->
           

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url('/espacerespo/afficherplanpermanencerespo');?>">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Mon planning</span></a>
            </li>



              <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                SUPPORT
            </div>
 

             <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url('/espacerespo/guiderespo');?>">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Guide du responsable hiérarchique</span></a>
            </li>

 <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url('/espacerespo/guideuser');?>">
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