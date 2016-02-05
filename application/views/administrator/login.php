<!DOCTYPE html>
<html lang="en">
  
<head>
    <meta charset="utf-8">
    <title>Login - Administrator Manager</title>

	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes"> 
    
    <link href="<?php echo base_url()?>public/assets/administrator/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url()?>public/assets/administrator/css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css" />
    
    <link href="<?php echo base_url()?>public/assets/administrator/css/font-awesome.css" rel="stylesheet">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">
        
    <link href="<?php echo base_url()?>public/assets/administrator/css/style.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url()?>public/assets/administrator/css/pages/signin.css" rel="stylesheet" type="text/css">

</head>

<body>
	
	<div class="navbar navbar-fixed-top">
	
	<div class="navbar-inner">
		
		<div class="container">
			
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</a>
			
			<a class="brand" href="<?php echo base_url()?>">
				ADMINISTRATOR
			</a>		
			
			<div class="nav-collapse">
				<ul class="nav pull-right">
										
					<li class="">						
						<a href="<?php echo base_url()?>" class="">
							<i class="icon-chevron-left"></i>
							Back to Homepage
						</a>
						
					</li>
				</ul>
				
			</div><!--/.nav-collapse -->	
	
		</div> <!-- /container -->
		
	</div> <!-- /navbar-inner -->
	
</div> <!-- /navbar -->



<div class="account-container">
	
	<div class="content clearfix">
		
		<form action="#" method="post">
		
			<h1>Member Login</h1>		
			
			<div class="login-fields">
                
                <p>Please provide your details</p>
                
				<div class="field">
					<label for="username">Username</label>
					<input type="text" id="username" name="username" value="" placeholder="Username" class="login username-field" autocomplete="off"/>
				</div> <!-- /field -->
				
				<div class="field">
					<label for="password">Password:</label>
					<input type="password" id="password" name="password" value="" placeholder="Password" class="login password-field" autocomplete="off"/>
				</div> <!-- /password -->
				
			</div> <!-- /login-fields -->
			
			<div class="login-actions">
				
				<span class="login-checkbox">
					<input id="Field" checked="" name="remember" type="checkbox" class="field login-checkbox" value="First Choice" tabindex="4" />
					<label class="choice" for="Field">Keep me signed in</label>
				</span>
									
				<button class="button btn btn-success btn-large">Sign In</button>
				
			</div> <!-- .actions -->
			
			<input type="hidden" name="select-project" value="administrator">
			
		</form>
		
	</div> <!-- /content -->
	
</div> <!-- /account-container -->


<script src="<?php echo base_url()?>public/assets/administrator/js/jquery-1.7.2.min.js"></script>
<script src="<?php echo base_url()?>public/assets/administrator/js/bootstrap.js"></script>

<script src="<?php echo base_url()?>public/assets/administrator/js/signin.js"></script>

</body>

</html>
