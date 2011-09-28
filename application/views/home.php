<?php
function get_gravatar( $email, $s = 80, $d = 'mm', $r = 'g', $img = false, $atts = array() ) {
	$url = 'http://www.gravatar.com/avatar/';
	$url .= md5( strtolower( trim( $email ) ) );
	$url .= "?s=$s&d=$d&r=$r";
	if ( $img ) {
		$url = '<img src="' . $url . '"';
		foreach ( $atts as $key => $val )
			$url .= ' ' . $key . '="' . $val . '"';
		$url .= ' />';
	}
	return $url;
}
?>
<div class="row">
<div class="span16">
<h1>dcmntr is a platform to build communities around apps</h1>
</div>
</div>
<div class="row">
<div class="span8">
<h2>For Developers</h2>
<p><img src="/images/bugs.png" alt="bugs" style="float:left; padding:2px;" /><strong>Easy Bug Tracking</strong><br />Keep track of bugs in your software, and let your audience know the status of them in real-time.</p>
<p><img src="/images/community.png" alt="bugs" style="float:left; padding:2px;" /><strong>Strong communities from the start</strong><br />
dcmntr keeps things simple.  We want to keep communication flowing, and discussions happening about your applications so they garner more attention</p>
<p><img src="/images/faqs.png" alt="bugs" style="float:left; padding:2px;" /><strong>Keep Your Users Informed</strong><br />
dcmntr is all about allowing you to provide information for your users.  The system was recently updated with a FAQ's section allowing app developers to provide answers to the most common questions.</p>
<p><img src="/images/seo.png" alt="bugs" style="float:left; padding:2px;" /><strong>SEO Friendly</strong><br />
You want your app to be seen by the world, and dcmntr will provide that for you.  The system is constantly being updated to make sure that as your application grows, so will the popularity on search engines.  The more active your community is, the better exposure it will get.</p>
</div>
<div class="span8">
<h2>For End-Users</h2>
<p><img src="/images/connect.png" alt="bugs" style="float:left; padding:2px;" /><strong>Connect with the Developers</strong><br />
Chances are if your favorite app is on this site, it's because the developer wants to hear back from you.  This is your platform to create a difference in the products you love the most.</p>
<p><img src="/images/app.png" alt="bugs" style="float:left; padding:2px;" /><strong>Find new apps</strong><br />
One of the great benefits of dcmntr is we want to spotlight applications.  We want people to see some of the gems of the internet that you might not always discover.</p>
<p><img src="/images/search.png" alt="bugs" style="float:left; padding:2px;" /><strong>Become a Bug Hunter</strong><br />
The greatest asset to a developer is their end user.  We don't create products to be stagnent, and we know that there are issues to be found.  Be proactive, and don't be afraid to speak up if something about an app just doesn't seem like it's functioning correctly.</p>
</div>
</div>
<?php if(! @$loggedin): ?>
<hr />
<div class="row">
<div class="span8">
<img src="<?php echo get_gravatar($randomApp->email, 80, 'identicon'); ?>" style="float:left; padding:5px;" />
	<h4>Random App of the Moment:</h4>
	<h1><?php echo $randomApp->appname; ?></h1>
	<p><?php echo $randomApp->description; ?> - <?php echo anchor("user-profile/$user->id/" . url_title($user->name, 'dash', TRUE), $user->name); ?></p>
	<p><?php echo anchor("app-profile/$randomApp->appnameid", "Learn More >>", "class='btn primary small'"); ?></p>
	</div>
<div class="span8">
<h4>Sign Up For Free!</h4>
<?php echo form_open("sign-up"); ?>
<div class="clearfix">
<label for="email">Email</label>
<div class="input">
<?php echo form_input("email"); ?>
</div>
</div>
<div class="clearfix">
<label for="password">Password</label>
<div class="input">
<?php echo form_password("password"); ?>
</div>
</div>
<div class="actions">
<?php $btdata = array("name" => "signup",
						"class" => "btn success"); ?>
<?php echo form_submit($btdata, "Sign Up"); ?>
</div>
<?php echo form_close(); ?>
</div>
</div>
<?php endif; ?>