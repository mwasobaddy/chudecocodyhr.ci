        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion pt-4" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center mb-4" href="<?php echo base_url('/espaceadmin/afficher/accueil');?>">
                <div class="sidebar-brand-icon rotate-n-15">
                 <!--    <i class="fas fa-laugh-wink"></i>-->
                </div>
                <div class="sidebar-brand-text mx-3"><!--ESPACE ADMINISTRATEUR--></sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="<?php echo base_url('/espaceadmin/afficher/accueil');?>">
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
                        <a class="collapse-item" href="<?php echo base_url('/espaceadmin/listagent');?>">Gestion des Agents</a>
                        
                                              
                        <h6 class="collapse-header">Arrêtés de travail :</h6>
                        <a class="collapse-item" href="<?php echo base_url('/espaceadmin/creerarrettravail');?>">Arrêt de travail</a>
                        
                      
                        
                       <h6 class="collapse-header">Formation continue :</h6>
                        <a class="collapse-item" href="<?php echo base_url('/espaceadmin/listagentformation');?>">Mise en formation</a>
                   
                        
                         <h6 class="collapse-header">Cessation de service:</h6>
                        <a class="collapse-item" href="<?php echo base_url('/espaceadmin/listagentdepartchu');?>">Départ du CHU</a>
                      <!--  <a class="collapse-item" href="<?php //echo base_url('/espaceadmin/listagentdepartdisponibilite');?>">Mise en disponibilité</a> -->
                        <a class="collapse-item" href="<?php echo base_url('/espaceadmin/listagentdepartretraite');?>">Depart à la retraite</a>
                         <a class="collapse-item" href="<?php echo base_url('/espaceadmin/listagentretraite');?>">Réintégrer retraité</a>

                 
                    </div>
                    
                </div>
            </li>
            
             <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#collapseTwoo"
                    aria-expanded="true" aria-controls="collapseTwoo">
                    <i class="fas fa-chart-bar"></i>
                    <span>Statistiques</span>
                </a>
                <div id="collapseTwoo" class="collapse" aria-labelledby="headingTwoo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Données statistiques:</h6>
                        <a class="collapse-item" href="<?php echo base_url('/espaceadmin/statagent');?>">Statistiques</a>
                          <a class="collapse-item" href="<?php echo base_url('/espaceadmin/statagentr');?>">Liste retraite</a>
                        
                      
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
                        <h6 class="collapse-header">Validations de demandes :</h6>
                      <!--  <a class="collapse-item" href="">Congés annuel</a>
                        <a class="collapse-item" href="">Permission</a>
                        <a class="collapse-item" href="">Changement planning</a> -->
                        
                        <a class="collapse-item" href="<?php echo base_url('/espaceadmin/creerplancongeannuel');?>">Planning Congés annuels</a>
                        
                        
                        <a class="collapse-item" href="<?php echo base_url('/espaceadmin/creercongeannuel');?>">Attribuer Congés annuels</a>
                        
                        
                        <a class="collapse-item" href="<?php echo base_url('/espaceadmin/creercongematernite');?>">Congés de maternité</a>
                        
                        <a class="collapse-item" href="<?php echo base_url('/espaceadmin/creerpermissiondd');?>">Permission jour à jour</a>
                        <a class="collapse-item" href="<?php echo base_url('/espaceadmin/creerpermissionhh');?>">Permission heure à heure</a>
                        <a class="collapse-item" href="<?php echo base_url('/espaceadmin/rapports');?>">
                        Rapports</a>
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
                        <h6 class="collapse-header">Données utilisateurs:</h6>
                        <a class="collapse-item" href="<?php echo base_url('/espaceadmin/afficherplanpermanence');?>">Planning du mois</a>
                         <a class="collapse-item" href="<?php echo base_url('/espaceadmin/creerequipe');?>">Gestion des équipes</a>
                         <a class="collapse-item" href="<?php echo base_url('/espaceadmin/creerplanpermanence');?>">Créer Planning du mois</a>
                        <a class="collapse-item" href="<?php echo base_url('/espaceadmin/selectplan');?>">Attribuer Planning</a>
                    
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
                        
                        <a class="collapse-item" href="<?php echo base_url('/espaceadmin/evaluation');?>">Fixation des objectifs</a>
                    
                    </div>
                    
                </div>
            </li>
             <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#collapseFor"
                    aria-expanded="true" aria-controls="collapseFor">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Configuration</span>
                </a>
                <div id="collapseFor" class="collapse" aria-labelledby="headingFor" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Données de base:</h6>
                        <a class="collapse-item" href="<?php echo base_url('/espaceadmin/creerdirection');?>">Directions</a>
                        <a class="collapse-item" href="<?php echo base_url('/espaceadmin/creersousdirection');?>">Sous-Directions</a>
                        <a class="collapse-item" href="<?php echo base_url('/espaceadmin/creerservice');?>">Services</a>
                        <a class="collapse-item" href="<?php echo base_url('/espaceadmin/creeremploi');?>">Emplois</a>
                        <a class="collapse-item" href="<?php echo base_url('/espaceadmin/creerfonction');?>">Fonctions</a>
                        <a class="collapse-item" href="<?php echo base_url('/espaceadmin/creergrade');?>">Grades</a>
                        <a class="collapse-item" href="<?php echo base_url('/espaceadmin/creerdroitaccess');?>">Droits d'accès</a>
                        <a class="collapse-item" href="<?php echo base_url('/espaceadmin/creerrole');?>">Rôles</a>
                        
                        
                        
                    </div>
                    
                </div>
            </li>
            
            
            <li class="nav-item">
                <a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#collapseForposte"
                    aria-expanded="true" aria-controls="collapseForposte">
                    <i class="fas fa-address-card"></i>
                    <span>Codification des postes</span>
                </a>
                <div id="collapseForposte" class="collapse" aria-labelledby="headingForposte" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Données de base:</h6>
                       <!-- <a class="collapse-item" href="<?php //echo base_url('/espaceadmin/creerposte');?>">Créer des Postes</a>   use windev to import fonction automaticaly -->
                         <a class="collapse-item" href="<?php echo base_url('/espaceadmin/postedirection');?>">Poste par Direction</a>
                        <a class="collapse-item" href="<?php echo base_url('/espaceadmin/postesousdirection');?>">Poste par Sous-Direction</a>
                        <a class="collapse-item" href="<?php echo base_url('/espaceadmin/posteservice');?>">Poste par Service</a>
                        <h6 class="collapse-header">Expression de besoins :</h6>
                        <a class="collapse-item" href="<?php echo base_url('/espaceadmin/apercubesoinservice');?>">Besoin en agents</a>
                         <h6 class="collapse-header">Données statistiques:</h6>
                        <a class="collapse-item" href="<?php echo base_url('/espaceadmin/rapportcodiposte');?>">Rapport général</a>

                        
                        
                        
                    </div>
                    
                </div>
            </li>
            


       

                  <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Mes validations
            </div>
         <li class="nav-item">
                <a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="far fa-check-circle"></i>
                    <span>Validations en attente</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Congés et Absences :</h6>
                        <a class="collapse-item" href="<?php echo base_url('/espaceadmin/validercongeannuel');?>">Congés annuels</a>
                        <a class="collapse-item" href="<?php echo base_url('/espaceadmin/validercongematernite');?>">Congés de maternité</a>
                        <a class="collapse-item" href="<?php echo base_url('/espaceadmin/validerpermissiondd');?>">Permission jour à jour</a>
                        <a class="collapse-item" href="<?php echo base_url('/espaceadmin/validerpermissionhh');?>">Permission heure à heure</a>
                       <!-- <a class="collapse-item" href="forgot-password.html">Forgot Password</a> -->
                        <div class="collapse-divider"></div>
                        <h6 class="collapse-header">Planning :</h6>
                       <!--   <a class="collapse-item" href="<?php //echo base_url('/espaceadmin/monprofil');?>">Planning service</a> -->
                        <a class="collapse-item" href="<?php echo base_url('/espaceadmin/validerchangep');?>">Changement de planning</a>
                        <!-- <a class="collapse-item" href="blank.html">Blank Page</a> -->
                    </div>
                </div>
            </li>

          
       

             <!-- Nav Item - Tables 
            <li class="nav-item">
                <a class="nav-link" href="<?php //echo base_url('/espaceadmin/afficherplanpermanencerespo');?>">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Mon planning</span></a>
            </li>
-->
           

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">
            
            
           

            <!-- Heading -->
            <div class="sidebar-heading">
                SUPPORT
            </div>
 <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url('/espaceadmin/guideadmin');?>">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Guide de l'administrateur</a>
            </li>
            <!-- Nav Item - Pages Collapse Menu -->
           

             <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url('/espaceadmin/guiderespo');?>">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Guide du responsable hiérarchique</span></a>
            </li>

 <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url('/espaceadmin/guideuser');?>">
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