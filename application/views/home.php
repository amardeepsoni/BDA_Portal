<div class="container-fluid" style="padding: 0; margin:0;">

<div class="container-fluid" style="padding: 0; margin:0;overflow: hidden;position: relative;">
	<div style="position: absolute;width: 100%;height: 100%; z-index: 10;opacity: .8;background: black;">

		</div>
<div id="demo" class="carousel slide" data-ride="carousel">

	  <!-- Indicators -->
	  <ul class="carousel-indicators">
	    <li data-target="#demo" data-slide-to="0" class="active"></li>
	    <li data-target="#demo" data-slide-to="1"></li>
	    <li data-target="#demo" data-slide-to="2"></li>
	  </ul>

	  <!-- The slideshow -->
	  <div class="carousel-inner">
	    <div class="carousel-item active">
	      <img src="<?php echo base_url(); ?>images/slide3.jpg" style="width: 100%;height: 650px;" alt="Los Angeles">
	    </div>
	    <div class="carousel-item">
	      <img src="<?php echo base_url(); ?>images/slide2.jpg" alt="Chicago" style="width: 100%;height: 650px;">
	    </div>
	    <div class="carousel-item">
	      <img src="<?php echo base_url(); ?>images/slide1.jpg" alt="New York" style="width: 100%;height: 650px;">
	    </div>
	  </div>

	  <!-- Left and right controls -->
	  <a class="carousel-control-prev" href="#demo" data-slide="prev">
	    <span class="carousel-control-prev-icon"></span>
	  </a>
	  <a class="carousel-control-next" href="#demo" data-slide="next">
	    <span class="carousel-control-next-icon"></span>
	  </a>
	</div>

		<div style="width: 350px;z-index: 20; position: absolute;top:50%;left: 50%; transform:translate(-50%,-50%);">
			<p style="width: 100%;text-align: center;color:white; font-family:sans-serif;font-size: 3em;">Join Us</p>
			<p style="width: 100%;display: flex;justify-content: space-between;">
			<a class="btn btn-outline-success px-5" href="<?php echo base_url(); ?>index.php/Register">Register</a><a class="btn btn-outline-primary px-5 text-primary">Log In</a>
			</p>
		</div>
</div>

</div>