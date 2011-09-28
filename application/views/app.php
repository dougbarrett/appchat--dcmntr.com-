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
<div class="span-one-third">
<h2>Newest Apps</h2>
<?php foreach($newest_apps as $app): ?>
<img src="<?php echo get_gravatar($app->email, 40, 'identicon'); ?>" style="float:left; padding:5px;" />
<h4><?php echo anchor("app-profile/$app->appnameid", $app->appname); ?></h4>
<p><?php echo $app->description; ?></p>
<?php endforeach; ?>
</div>
<div class="span-one-third">
<h2>Latest Discussion</h2>
<?php foreach($latest_discussion as $disc): ?>
<?php $app = $this->db->get_where("app", array("id" => $disc->appid))->row(); ?>
<?php $user = $this->db->get_where("users", array("id" => $disc->userid))->row(); ?>
	<h4><?php echo anchor("view-discussion/$app->appnameid/$disc->id/" . url_title($disc->title, 'dash', TRUE), character_limiter($disc->title, 30)); ?></h4>
	<p><?php echo $disc->body; ?> <br />
	<small>Started by:<?php echo anchor("user-profile/$user->id/" . url_title($user->name, 'dash', TRUE), $user->name); ?> in <?php echo anchor("app-profile/$app->appnameid", $app->appname); ?></small>
	</p>
<?php endforeach; ?>
</div>
<div class="span-one-third">
<h2>Latest Bugs</h2>
<?php foreach($latest_bug as $bug): ?>
<?php $app = $this->db->get_where("app", array("id" => $bug->appid))->row(); ?>
<?php $user = $this->db->get_where("users", array("id" => $bug->userid))->row(); ?>
	<h4><?php echo anchor("view-bug/$app->appnameid/$bug->id/" . url_title($bug->title, 'dash', TRUE), character_limiter($bug->title, 30)); ?></h4>
	<p><?php echo $bug->body; ?> <br />
	<small>Started by:<?php echo anchor("user-profile/$user->id/" . url_title($user->name, 'dash', TRUE), $user->name); ?> in <?php echo anchor("app-profile/$app->appnameid", $app->appname); ?></small>
	</p>
<?php endforeach; ?>
</div>
</div>