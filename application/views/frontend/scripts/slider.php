<div class="container">
	<div class="row">
		<div id="myCarousel" class="carousel slide col-md-24" data-ride="carousel">
		    <!-- Indicators -->
		    <ol class="carousel-indicators">
		        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
		      	<li data-target="#myCarousel" data-slide-to="1"></li>
		     	<li data-target="#myCarousel" data-slide-to="2"></li>
		      	<li data-target="#myCarousel" data-slide-to="3"></li>
		    </ol>

		    <!-- Wrapper for slides -->
		    <div class="carousel-inner" role="listbox">
		      	<div class="item active">
		        	<img src="<?php echo base_url('/public/assets/images/sliders/1.jpg')?>" alt="Chania">
		      	</div>

		      	<div class="item">
		        	<img src="<?php echo base_url('/public/assets/images/sliders/2.jpg')?>" alt="Chania">
		      	</div>
		    
		      	<div class="item">
		        	<img src="<?php echo base_url('/public/assets/images/sliders/3.jpg')?>" alt="Flower">
		      	</div>

		      	<div class="item">
		        	<img src="<?php echo base_url('/public/assets/images/sliders/4.jpg')?>" alt="Flower">
		      	</div>
		    </div>

		    <!-- Left and right controls -->
		    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
		      	<span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span>
		      	<span class="sr-only">Previous</span>
		    </a>
		    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
		     	<span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span>
		      	<span class="sr-only">Next</span>
		    </a>
		</div>
	</div>
</div>