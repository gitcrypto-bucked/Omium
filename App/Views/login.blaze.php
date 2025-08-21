<!DOCTYPE HTML>
<?php 
    global $auth;

    $auth = new Core\Auth();
?>
<!DOCTYPE html><html lang="en"><head>
  	<title>Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="<?=asset('css/fontawesome-all.min.css')?>">
	
	<link rel="stylesheet" href="<?=asset('css/style.css')?>">

	</head>
	<body class="img js-fullheight" style="background-image: url(<?=asset('images/bg.jpg')?>);">

	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section">Login</h2>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-6 col-lg-4">
					<div class="login-wrap p-0">
		      	<h3 class="mb-4 text-center">Ja possui conta?</h3>
		      	<?php if(isset($_SESSION['error'])): ?>
		      		<div class="alert alert-danger" id='error'>
		      			<?= $_SESSION['error']; ?>
		      		</div>
		      	<?php endif; ?>
		      	<?php unset($_SESSION['error']); ?>

		      	<form action="<?=url('dologin') ?>" method="post" class="signin-form" autocomplet="off">
		      		<?= csrf_field(); ?>
		      		<div class="form-group">
		      			<input type="text" class="form-control" placeholder="Username" id='username' name='username' required="">
		      		</div>
	            <div class="form-group">
	              <input id="password-field" type="password" class="form-control" id='password' name='password' placeholder="Password" required="">
	              <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
	            </div>
	            <div class="form-group">
	            	<button type="submit" class="form-control btn btn-primary submit px-3">Login</button>
	            </div>
	            <div class="form-group d-md-flex">
	            	<div class="w-50">
		            	
                            </div>
                            <div class="w-50 text-md-right">
                                <a href="#" style="color: #fff">Esqueceu a senha</a>
                            </div>
	            </div>
	          </form>
	        
		      </div>
				</div>
			</div>
		</div>
	</section>

  <script src="<?= asset('js/jquery.min.js');?>"></script>
  <script src="<?= asset('js/popper.js');?>"></script>

  <script src=" <?= asset('js/bootstrap.mi.js');?>"></script>
  <script src=" <?= asset('js/main_alt.js');?>"></script>
  <script type="text/javascript">

		setTimeout(() => {
			
			let error = document.getElementById('error');
			if(error != undefined)
			{
				error.style.display ="none";
			}

		}, 3500);

  </script>
</body></html>