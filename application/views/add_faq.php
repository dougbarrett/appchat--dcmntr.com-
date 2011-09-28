<div class="row">
	<div class="span16">
		<?php echo form_open(); ?>
		<fieldset>
			<legend>Add FAQ</legend>
			<div class="clearfix">
				<label for="">Question</label>
				<div class="input">
					<?php echo form_input("question"); ?>
				</div>
			</div>
			<div class="clearfix">
				<label for="">Answer</label>
				<div class="input">
					<?php echo form_textarea("answer"); ?>
				</div>
			</div>
		</fieldset>
		<div class="actions">
		<?php $btdata = array('name' => 'save',
								'class' => 'btn primary');
			echo form_submit($btdata, "Save FAQ"); ?>
		</div>
		<?php echo form_close(); ?>
	</div>
</div>