<?php $action = (@$edit) ? "edit-app/$id" : "add-app"; ?>
<? echo form_open($action); ?>
<div class="row">
	<div class="span10 offset3">
		<h2><?php echo (@$edit) ? "Edit" : "Add" ?> App</h2>
		<?php if($edited): ?>
		<div style="text-align:center; color:blue;">
		<h4>Info was edited!</h4>
		<p><?php echo anchor("profile", "Go back to your profile"); ?></p>
		</div>
		<?php endif; ?>
		<fieldset>
			<div class="clearfix">
				<label for="appname">App Name:</label>
				<div class="input">
					<?php echo form_input("appname", @$appname); ?>
				</div>
			</div>
			<div class="clearfix">
				<label for="email">Email:</label>
				<div class="input">
					<?php echo form_input("email", $email); ?>
				</div>
			</div>
			<div class="clearfix">
				<label for="url">Website:</label>
				<div class="input">
					<div class="input-prepend">
					<span class="add-on">http://</span>
					<?php echo form_input("url", $url); ?>
					</div>
				</div>
			</div>
			<div class="clearfix">
				<label for="description">Description</label>
				<div class="input">
					<?php echo form_textarea("description", @$description); ?>
				</div>
			</div>
			<?php $submit = (@$edit) ? "Edit" : "Add"; ?>
			<?php $sbdata = array("name" => "add",
									"class" => "btn primary"); ?>
</div>
</div>
<div class="row">
<div class="span10 offset3">
	<div class="actions">
			<?php echo form_submit($sbdata, "$submit App"); ?>
	</div>
</div>
</div>
			<?php echo form_close(); ?>