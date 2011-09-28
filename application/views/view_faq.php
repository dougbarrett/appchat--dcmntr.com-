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
<div class="span4">
<div class="well">
<img src="<?php echo get_gravatar($app->email, 164, 'identicon'); ?>" style="float:left; padding:5px;" />
	<h1><?php echo anchor("app-profile/$app->appnameid/faqs", $app->appname); ?></h1>
	<?php $dev = $this->db->get_where("users", array("id" => $app->devid))->row(); ?>
	<p>Created by: <?php echo anchor("user-profile/$dev->id/". url_title($dev->name, 'dash', TRUE), $dev->name); ?><br /><?php echo anchor(prep_url($app->url)); ?></p>
	<hr />
	<p><?php echo $app->description ?></p>
</div>
</div>
<div class="span12">
	<h2><?php echo $faq->question ?></h2>
	<p><?php echo $faq->answer ?></p>
</div>
</div>
