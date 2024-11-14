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
	unset($_SESSION['toast']);
} ?>