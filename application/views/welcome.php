<?php echo form_open(); ?>
<div class="row">
	<div class="span10 offset3">
	<h2>Welcome! We just need a little bit of info</h2>
		<fieldset>
			<div class="clearfix">
				<label for="username">What is your name?</label>
				<div class="input">
					<input type="text" name="username" id="username" />
				</div>
			</div>
			<div class="clearfix">
			<div class="input">
				<ul class="inputs-list">
					<li>
						<label for="addapp"><input type="checkbox" name="addapp" id="addapp" />
						<span>Will you be adding an app?</span>
						</label>
					</li>
				</ul>
			</div>
			</div>
		</fieldset>
	</div>
</div>
<div class="row">
<div class="span10 offset3">
	<div class="actions">
		<input type="submit" value="Save Information" class="btn primary" name="save" />
	</div>
</div>
</div>
<?php echo form_close(); ?>