<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>crashcoder FB app using codeigniter facebook sdk - demo</title>
<link href="<?php echo base_url(); ?>/Styles/style.css" rel="stylesheet" type="text/css" />
<style>
.img_gall li{
float:left;
padding:15px;
list-style:none;
}
.link{
clear:both;
}
</style>
</head>
<body>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=388144371208472";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div id="Header">
    <div class="LiquidContainer HeaderContainer" style="width: 933px;">
       <span id="Pinterest">
    <img  src="pinit-b.png" ></img> </span>
<span>
<div class="fb-like" data-href="http://faceapp.crashcoder.com" data-send="true" data-layout="button_count" data-width="450" data-show-faces="false"></div>
</span>
    </div>
</div>
    <div class="wrapper"> 
	<div id="BoardTitle">
			
			<div id="BoardMeta">
				<div id="BoardUsers">
                                   <img src="https://graph.facebook.com/<?php echo $uid; ?>/picture" alt="" class="pic left" /> <h1 class="serif left"><strong>Hiii <?php echo $full_name; ?></strong></h1>
					
  
						
				</div>

				
				
			</div><!-- #BoardMeta -->

			

  <p class="desc"><?php echo $full_name; ?>, you are watching application photos  page. Ssshhhh.</p>


<h2>Upload Image</h2>
	<form name="photo" enctype="multipart/form-data" action="<?php echo site_url('main/upload_photo');?>" method="post">
<table>
<tr><td>
Photo</td><td> <input type="file" name="image" size=20" />
</td></tr>
<tr><td>
Desc</td><td><input type="text" name="desc" />
</td></tr>
<tr><td>
<input type="submit" name="upload" value="Upload" />
</td></tr>
	</form>
</table>

<div class="img_gall">
<ul>
<?php
foreach($photos_array as $row)
{
echo '<li>';
$src=$row['src'];
echo '<img src="'.$src.'"></img></br>';
echo $row['caption'];
echo '</li>';
}
 ?>
</ul>
<div style="clear:both;"></div>
</div>	


 <p> <a href="<?php echo site_url('home'); ?>"> Go to the home page</a></p>
 <p><a href="<?php echo site_url('main/logout'); ?>">logout</a>


</div><!--- wrapper end-->
<div class="footer">
                <a target="blank" href="http://www.crashcoder.com/tutotials-to-add-cool-things-to-your-pinterest-boards/"> <img  src="pinit-crashcoder-b.png" ></img> </span></a>
                </br>
            </br>
                 <a href="http://www.crashcoder.com/tutotials-to-add-cool-things-to-your-pinterest-boards/" target="blank" >get code and related tutorials</a>
            </div>
 
</body>
</html>
