<div class="row">
<div class="span10 offset3">
<h1>Sign Up For Free!</h1>
</div>
<?php echo form_open(); ?>
<div class="span10 offset3">
	<div class="clearfix">
		<label for="email">Email</label>
		<div class="input">
				<input type="text" name="email" id="email" class="xlarge" value="<?php echo set_value('email') ?>"/>
		</div>
	</div>
	<div class="clearfix">
		<label for="password">Password</label>
		<div class="input">
			<input type="password" name="password" id="password" class="xlarge"/>
		</div>
	</div>
</div>
</div>
<div class="row">
<div class="span10 offset3">
	<div class="actions">
		<input type="submit" value="Sign Up" class="btn primary" />
	</div>
<?php echo form_close(); ?>
</div>
</div>
<div class="row">
<div class="span16">
<div style="color:red; text-align:center;">
<?php echo validation_errors(); ?>
</div>
</div>
</div>
