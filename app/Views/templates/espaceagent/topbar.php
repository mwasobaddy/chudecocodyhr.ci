 <?php //session_start(); ?>
 <?php 
if(!isset($_SESSION['cnxid'])) {
	header('Location: '.base_url('home/logout').'');
	exit;	
}
?>
 
 <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
            <!-- <img src="<?php echo base_url('img/banner.png');?>" style="width:100%" /> -->

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search --> 
                    
                    <?php 
					
					$ladate = date("l d F Y");
					//mois
					$ladate = preg_replace('/January/', 'Janvier', $ladate);
					$ladate = preg_replace('/February/', 'Fevrier', $ladate);
					$ladate = preg_replace('/March/', 'Mars', $ladate);
					$ladate = preg_replace('/April/', 'Avril', $ladate);
					$ladate = preg_replace('/May/', 'Mai', $ladate);
					$ladate = preg_replace('/June/', 'Juin', $ladate);
					$ladate = preg_replace('/July/', 'Juillet', $ladate);
					$ladate = preg_replace('/August/', 'Aout', $ladate);
					$ladate = preg_replace('/September/', 'Septembre', $ladate);
					$ladate = preg_replace('/October/', 'Octobre', $ladate);
					$ladate = preg_replace('/November/', 'Novembre', $ladate);
					$ladate = preg_replace('/December/', 'Décembre', $ladate);
					//jour
					$ladate = preg_replace('/Monday/', 'Lundi', $ladate);
					$ladate = preg_replace('/Tuesday/', 'Mardi', $ladate);
					$ladate = preg_replace('/Wednesday/', 'Mercredi', $ladate);
					$ladate = preg_replace('/Thursday/', 'Jeudi', $ladate);
					$ladate = preg_replace('/Friday/', 'Vendredi', $ladate);
					$ladate = preg_replace('/Saturday/', 'Samedi', $ladate);
					$ladate = preg_replace('/Sunday/', 'Dimanche', $ladate);
					
					echo $ladate;
					
					
					function datefr($dd) {
					$dd = preg_replace('/January/', 'Janvier', $dd);
					$dd = preg_replace('/February/', 'Fevrier', $dd);
					$dd = preg_replace('/March/', 'Mars', $dd);
					$dd = preg_replace('/April/', 'Avril', $dd);
					$dd = preg_replace('/May/', 'Mai', $dd);
					$dd = preg_replace('/June/', 'Juin', $dd);
					$dd = preg_replace('/July/', 'Juillet', $dd);
					$dd = preg_replace('/August/', 'Aout', $dd);
					$dd = preg_replace('/September/', 'Septembre', $dd);
					$dd = preg_replace('/October/', 'Octobre', $dd);
					$dd = preg_replace('/November/', 'Novembre', $dd);
					$dd = preg_replace('/December/', 'Décembre', $dd);
					//jour
					$dd = preg_replace('/Monday/', 'Lundi', $dd);
					$dd = preg_replace('/Tuesday/', 'Mardi', $dd);
					$dd = preg_replace('/Wednesday/', 'Mercredi', $dd);
					$dd = preg_replace('/Thursday/', 'Jeudi', $dd);
					$dd = preg_replace('/Friday/', 'Vendredi', $dd);
					$dd = preg_replace('/Saturday/', 'Samedi', $dd);
					$dd = preg_replace('/Sunday/', 'Dimanche', $dd);
					return $dd;
					}
					
					?>
                    
                    <!--
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form> -->

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages --> <!--
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>   --->

                        <!-- Nav Item - Alerts --> <!--
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts --> <!--
                                <span class="badge badge-danger badge-counter">3+</span>
                            </a>
                            <!-- Dropdown - Alerts --> <!--
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Alerts Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 12, 2019</div>
                                        <span class="font-weight-bold">A new monthly report is ready to download!</span>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-success">
                                            <i class="fas fa-donate text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 7, 2019</div>
                                        $290.29 has been deposited into your account!
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-warning">
                                            <i class="fas fa-exclamation-triangle text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 2, 2019</div>
                                        Spending Alert: We've noticed unusually high spending for your account.
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                            </div>
                        </li>   ---->

                        <!-- Nav Item - Messages --> <!--
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
                                <!-- Counter - Messages --> <!--
                                <span class="badge badge-danger badge-counter">7</span>
                            </a>
                            <!-- Dropdown - Messages --> <!--
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    Message Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_1.svg"
                                            alt="">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div class="font-weight-bold">
                                        <div class="text-truncate">Hi there! I am wondering if you can help me with a
                                            problem I've been having.</div>
                                        <div class="small text-gray-500">Emily Fowler · 58m</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_2.svg"
                                            alt="">
                                        <div class="status-indicator"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">I have the photos that you ordered last month, how
                                            would you like them sent to you?</div>
                                        <div class="small text-gray-500">Jae Chun · 1d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_3.svg"
                                            alt="">
                                        <div class="status-indicator bg-warning"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Last month's report looks great, I am very happy with
                                            the progress so far, keep up the good work!</div>
                                        <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60"
                                            alt="">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Am I a good boy? The reason I ask is because someone
                                            told me that people say this to all dogs, even if they aren't good...</div>
                                        <div class="small text-gray-500">Chicken the Dog · 2w</div>
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>
                        --->

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php //'Utilisateur connecté';
								
								if(isset($_SESSION['cnxname'])) {
								    echo $_SESSION['cnxname'];
								} else { }
							
								//print_r($_SESSION);
								
								//echo '<br/>';
								//print_r(session()->usercnx);
								 ?>
                               </span>
                                <img class="img-profile rounded-circle"
                                    src="<?php 
									
									if(isset($_SESSION['avatar']) && file_exists('./agents/'.$_SESSION['mat'].'/'.$_SESSION['avatar'])){
										echo base_url('agents/'.$_SESSION['mat'].'/'.$_SESSION['avatar']);
									} else {
									echo base_url('img/undraw_profile.svg');	
									}

									
									?>">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                 <?php
								// print_r($_SESSION);
								//echo '<br/>LE LIEN = '.'agents/'.$_SESSION['mat'].'/'.$_SESSION['avatar'];
							
								?>
                                 <img class="img-profile rounded-circle" style="width:100%; height:100%"
                                    src="<?php 
									
									if(isset($_SESSION['avatar']) && file_exists('./agents/'.$_SESSION['mat'].'/'.$_SESSION['avatar'])){
										echo base_url('agents/'.$_SESSION['mat'].'/'.$_SESSION['avatar']);
									} else {
									echo base_url('img/undraw_profile.svg');	
									}
									?>">
                                <a class="dropdown-item" href="<?php echo base_url('/espaceagent/monprofil');?>">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Mon profil
                                </a>
                                 <a class="dropdown-item" href="<?php echo base_url('/espaceagent/changepwd');?>">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Changer mot de passe
                                </a>
                               <!-- <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>-->
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Se déconnecter
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->