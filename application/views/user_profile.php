<div class="row">
<div class="span8">
<div class="well">
	<h1><?php echo $name; ?></h1>
	<p><?php echo safe_mailto($email, $email) ?></p>
	<?php if($user_website): ?>
	<p><?php echo anchor($user_website, $user_website) ?></p>
	<?Php endif; ?>
</div>
</div>
<div class="span8">
		<h2>Apps on this site:</h2>
		<ul class='square'>
			<?php foreach($apps as $app): ?>
			<li><?php echo anchor("app-profile/" . $app->appnameid, $app->appname) ?></li>
			<?php endforeach; ?>
		</ul>	
</div>
</div>