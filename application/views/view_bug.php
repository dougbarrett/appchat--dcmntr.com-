<?php function get_gravatar( $email, $s = 80, $d = 'mm', $r = 'g', $img = false, $atts = array() ) {
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
}?>
<div class="row">
<div class="span4">
<div class="well">
<img src="<?php echo get_gravatar($app->email, 164, 'identicon'); ?>" style="float:left; padding:5px;" />
	<h1><?php echo anchor("app-profile/$app->appnameid/bugs", $app->appname); ?></h1>
	<?php $dev = $this->db->get_where("users", array("id" => $app->devid))->row(); ?>
	<p>Created by: <?php echo anchor("user-profile/$dev->id/". url_title($dev->name, 'dash', TRUE), $dev->name); ?><br /><?php echo anchor(prep_url($app->url)); ?></p>
	<hr />
	<p><?php echo $app->description ?></p>
</div>
</div>
<div class="span12">
<h2><?php echo $bug->title; ?></h2>
		<blockquote>
		<p><?php echo $bug->body; ?></p>
		<?php
			$author = $this->db->get_where("users", array("id" => $bug->userid));
			$author = $author->row(); ?>
		<cite><?php echo anchor("user-profile/" . $author->id, $author->name); ?> <br /><em><?php echo date('M d, Y - g:i:s A', strtotime($bug->timestamp)); ?></em></cite>
		</blockquote>
		<?php $comments = $this->db->get_where("bug", array("parentid" => $bug->id));
			$comments = $comments->result(); ?>
		<?php $i = 1; ?>
		<?php foreach($comments as $comment): ?>
		<?php $lor = (@$lor == "left") ? "right" : "left" ?>
		<div style="float:left;">
		<div style="float:left; padding-right:10px; width:20px;"><h1 style=" color:#aaa;"><?php echo $i; ?>.</h1></div>
		<div style="float:left; width:450px;">
			<blockquote>
				<p><strong></strong><?php echo $comment->body; ?></p>
				<?php
					$author = $this->db->get_where("users", array("id" => $comment->userid));
					$author = $author->row(); ?>
				<cite><?php echo anchor("user-profile/" . $author->id, $author->name); ?> <br /><em><?php echo date('M d, Y - g:i:s A', strtotime($comment->timestamp)); ?></em</cite>
			</blockquote>
		</div>
		</div>
		<div style="clear:both"></div>
		<?php $i++;endforeach; ?>
</div>
</div>
<div class="row">
<div class="span16">
<?php if($this->session->userdata("logged_in")): ?>
		<hr />
		<fieldset>
		<legend>Leave a comment</legend>
		<?php echo form_open(); ?>
			<div class="clearfix">
			<label for="comment">Comment:</label>
			<div class="input">
			<?php echo form_textarea("comment"); ?>
			</div>
			</div>
			<div class="actions">
			<?php $btdata = array("name" => "add",
									"class" => "btn primary"); ?>
			<?php echo form_submit($btdata, "Add Comment"); ?>
			<?php echo form_close(); ?>
			</div>
		</fieldset>
		<?php endif; ?>
</div>
</div>