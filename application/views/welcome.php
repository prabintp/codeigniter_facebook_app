
	
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<style>
p{

}
</style>


<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>crashcoder FB app using codeigniter facebook sdk - demo</title>
<link href="<?php echo base_url(); ?>/Styles/style.css" rel="stylesheet" type="text/css" />
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
<script>
function newInvite(){
FB.ui({ method: 'apprequests',
message: 'Invite to crashcoder',
filters: ['app_non_users']
});
}


        //post story function,message, picture, link, name, caption, description, source
        function PostStory() {

           var wallPost = {
    message : "facebook application tutorials codeigniter",
	name: "crashcoder",
	caption: "facebook application",
	source:'http://www.crashcoder.com/codeigniter-facebook-sdk-tutorials-create-facebook-application-using-codeigniter/',
	description: "codeigniter facebook appication tutorials using php sdk.",
    picture: "<?php echo base_url();?>prabin.jpeg"
};
FB.api('/me/feed', 'post', wallPost , function(response) {
  if (!response || response.error) {
    alert('post is not publishedError occured');
  } else {
    alert('post  is published to wall sucessus Post ID: ' + response);
  }
});


}
function postwall(){
	FB.ui(
  {
    method: 'feed',
    attachment: {
      name: 'crashcoder ',
      caption: 'The Facebook codeigniter facebook api',
      description: (
        'A small JavaScript library that allows you to harness ' +
        'the power of Facebook, bringing the user\'s identity, ' +
        'social graph and distribution power to your site.'
      ),
      href: 'http://www.crashcoder.com/codeigniter-facebook-sdk-tutorials-create-facebook-application-using-codeigniter/'
    },
    action_links: [
      { text: 'crashcoder', href: 'http://www.crashcoder.com/codeigniter-facebook-sdk-tutorials-create-facebook-application-using-codeigniter/' }
    ]
  },
  function(response) {
    if (response && response.post_id) {
      alert('Post was published.');
    } else {
      alert('Post was not published.');
    }
  }
);
}
</script>
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

  
<p> <a href="<?php echo site_url('main/profile');?>">full Details</a> </p>



<p> <a href="<?php echo site_url('main/view_friends');?>">view friends</a> </p>
<p> <a href="<?php echo site_url('main/post_to_wall');?>">post to wall</a> </p>
 <p><a href="#" onclick="PostStory(); return false;">Post a story</a></p>
<p><a href="#" onclick="postwall(); return false;">Post wall</a></p>
<p><a href="#" onclick="newInvite(); return false;">Invite Friends</a></p>
<p> <a href="<?php echo site_url('main/get_photos');?>">view_photos</a> </p>
<p> <a href="<?php echo site_url('main/get_photos');?>">Upload Image</a> </p>
<p> <a href="<?php echo site_url('main/logout');?>">log_out</a> </p>

<div class="fb-comments" data-href="http://www.crashcoder.com" data-num-posts="2" data-width="470"></div>

</div><!--- wrapper end-->
<div class="footer">
                <a target="blank" href="http://www.crashcoder.com/codeigniter-facebook-sdk-tutorials-create-facebook-application-using-codeigniter/"> <img  src="pinit-crashcoder-b.png" ></img> </span></a>
                </br>
            </br>
                 <a href="#" target="blank" >get code and related tutorials</a>
            </div>
 
</body>
</html>
