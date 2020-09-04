<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Multi Login - Dashboard</title>
	<link rel="stylesheet" href="<?=base_url('assets/bootstrap-4.4.1/css/bootstrap.min.css')?>">
	<link rel="stylesheet" href="<?=base_url('assets/css/style.css')?>">
</head>
<body>
	<div class="dashboard">
		<div class="container">
			<div class="col-md-5 mx-auto">
				<div class="login-header text-center pt-5">
					<h1 class="h4 mb-0"><b>Dashboard</b></h1>
					<hr>
				</div>
				<div class="card-body">
					<div class="form-group text-center">
						You are 
						<span class="badge badge-primary"><?=$this->session->userdata('role')?></span>
					</div>
					<form action="<?=base_url('welcome/logout')?>">
						<div class="form-group text-center">
							<button type="submit" class="btn btn-light border" name="logout">Logout</button>
						</div>
					</form>
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