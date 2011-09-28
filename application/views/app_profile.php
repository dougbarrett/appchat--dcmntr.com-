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
<img src="<?php echo get_gravatar($appemail, 164, 'identicon'); ?>" style="float:left; padding:5px;" />
	<h1><?php echo $appname; ?></h1>
	<p>Created by: <?php echo anchor("user-profile/$dev->id/". url_title($dev->name, 'dash', TRUE), $dev->name); ?><br /><?php echo anchor(prep_url($appurl)); ?></p>
	<hr />
	<p><?php echo $appdescription ?></p>
</div>
</div>
<div class="span12">
		<ul class="pills">
				<li <?php echo ($subpage == "discussion") ? 'class="active"' : ''; ?>><?php echo anchor("app-profile/$appnameid", "Discussion"); ?></li>
				<li <?php echo ($subpage == "bugs") ? 'class="active"' : ''; ?>><?php echo anchor("app-profile/$appnameid/bugs", "Bugs"); ?></a></li>
				<li <?php echo ($subpage == "faqs") ? 'class="active"' : ''; ?>><?php echo anchor("app-profile/$appnameid/faqs", "FAQ's"); ?></a></li>
		</ul>
		<?php if($subpage == "discussion"): ?>
			<h4>Discussion</h4>
			<?php if(@$loggedin): ?>
			<p><?php echo anchor("add-topic/" . $appnameid, "Add Topic", 'class="btn success"'); ?></p>
			<?php endif; ?>
			<table>
				<tr>
					<th>Title</th>
					<th>Comments</th>
				</tr>
			<?php foreach($discussions as $disc): ?>
				<?php
					$disccomments = $this->db->get_where("discussion", array("parentid" => $disc->id));
					$disccomments = $disccomments->num_rows(); ?>
				<tr>
					<td><?php echo anchor("view-discussion/" . $appnameid . "/" . $disc->id . "/" . url_title($disc->title, 'dash', TRUE), $disc->title); ?></td>
					<td><?php echo $disccomments ?></td>
				</tr>
			<?php endforeach; ?>
			</table>
		<?php endif; ?>
		<?php if($subpage == "bugs"): ?>
			<h4>Bugs</h4>
			<?php if(@$loggedin): ?>
			<p><?php echo anchor("add-bug/" . $appnameid, "Add bug", 'class="btn success"'); ?></p>
			<?php endif; ?>
			<table>
				<tr>
					<th>Title</th>
					<th>Comments</th>
				</tr>
			<?php foreach($bugs as $bug): ?>
				<?php
					$bugcomments = $this->db->get_where("bug", array("parentid" => $bug->id));
					$bugcomments = $bugcomments->num_rows(); ?>
				<tr>
					<td><?php echo anchor("view-bug/" . $appnameid . "/" . $bug->id . "/" . url_title($bug->title, 'dash', TRUE),  $bug->title); ?></td>
					<td><?php echo $bugcomments ?></td>
				</tr>
			<?php endforeach; ?>
			</table>
		<?php endif; ?>
		<?php if($subpage == "faqs"): ?>
			<h4>FAQ's</h4>
			<?php if(@$isdev == TRUE): ?>
			<p><?php echo anchor("add-faq/" . $appnameid, "Add FAQ", 'class="btn success"'); ?></p>
			<?php endif; ?>
			<table>
				<?php foreach($faq as $topic): ?>
					<tr>
						<td><?php echo anchor("view-faq/$appnameid/$topic->id/" . url_title($topic->question, 'dash', TRUE), $topic->question); ?></td>
						<?php if(@$isdev == TRUE): ?>
						<td width="40px"><?php echo anchor("edit-faq/$appnameid/$topic->id/", "<img src='/images/edit.png' />"); ?></td>
						<?php endif; ?>
					</tr>
				<?php endforeach; ?>
			</table>
		<?php endif; ?>
</div>
</div>