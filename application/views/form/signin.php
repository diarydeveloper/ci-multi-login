<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Multi Login</title>
	<link rel="stylesheet" href="<?=base_url('assets/bootstrap-4.4.1/css/bootstrap.min.css')?>">
	<link rel="stylesheet" href="<?=base_url('assets/css/style.css')?>">
</head>
<body>
	<div class="login-form">
		<div class="container">
			<div class="col-md-5 mx-auto">
				<div class="login-header text-center pt-5">
					<h1 class="h4 mb-0"><b>Multi Login</b></h1>
					<hr>
				</div>
				<div class="card border-0">
					<div class="message">
						<?php if($this->session->flashdata('error')):?>
							<div class="alert alert-danger">
								<?=$this->session->flashdata('error')?>
							</div>
						<?php endif;?>
					</div>
					<div class="card-body">
						<form action="<?=base_url('welcome/login_action')?>" method="POST" accept-charset="utf-8">
							<div class="form-group">
								<input type="email" class="form-control" name="email" placeholder="Your Email" required>
							</div>
							<div class="form-group">
								<input type="password" class="form-control" name="password" placeholder="Your Password" required>
							</div>
							<div class="form-group">
								<button type="submit" class="btn border btn-block" name=submit>Login</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<footer class="footer">
		<div class="container">
			<div class="copyright text-center py-3 small">
				&copy; 2020 Diary Developer 
			</div>
		</div>
	</footer>
</body>
</html>