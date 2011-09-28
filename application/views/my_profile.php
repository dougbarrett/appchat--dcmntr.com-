<div class="row">
<div class="span8">
	<?php echo form_open("main/edit_user"); ?>
<fieldset>
	<legend>Edit User Information</legend>
	<div class="clearfix">
		<label for="name">Name:</label>
		<div class="input">
			<?php echo form_input("name", $user->name); ?>
		</div>
	</div>
	<div class="clearfix">
		<label for="email">Email:</label>
		<div class="input">
			<?php echo form_input("email", $user->email); ?>
		</div>
	</div>
	<div class="clearfix">
		<label for="url">Website:</label>
		<div class="input">
			<?php echo form_input("url", $user->url); ?>
		</div>
	</div>
</fieldset>
<fieldset>
	<legend>Set New Password</legend>
	<div class="clearfix">
		<label for="">Old Password:</label>
		<div class="input">
			<?php echo form_input("oldpw"); ?>
		</div>
	</div>
	<div class="clearfix">
		<label for="">New Password:</label>
		<div class="input">
			<?php echo form_input("newpw"); ?>
		</div>
	</div>
	<div class="clearfix">
		<label for="">New Password: <br /><small>(Again)</small></label>
		<div class="input">
			<?php echo form_input("newpwagain"); ?>
		</div>
	</div>
</fieldset>
<div class="actions">
<?php $btdata = array("name" => "saveuser",
						"class" => "btn primary");
echo form_submit($btdata, "Save"); ?>
</div>
<?php echo form_close(); ?>
</div>
<div class="span8">
<div style="width:50%; float:left;">
<h2>My Apps</h2>
</div>
<div style="width:48%; float:right; text-align:right;">
<?php echo anchor("add-app", "Add App", "class='btn primary'"); ?>
</div>
<div style="clear:both;">&nbsp;</div>
<table class="well">
<?php foreach($apps as $app): ?>
<tr>
	<td><?php echo anchor("app-profile/$app->appnameid", $app->appname); ?></td>
	<td width="35px"><?php echo anchor("edit-app/$app->id", "<img src='images/edit.png' alt='Edit' />"); ?></td>
	<td width="35px"><?php echo anchor("delete-app/$app->id", "<img src='images/delete.png' alt='Delete' />"); ?></td>
</tr>
<?php endforeach; ?>
</table>
</div>
</div>