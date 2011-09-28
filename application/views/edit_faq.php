<div class="row">
	<div class="span16">
		<?php echo form_open(); ?>
		<fieldset>
			<legend>Edit FAQ</legend>
		<?php if(@$edited): ?>
		<div style="text-align:center;">
			<h4>FAQ has been edited</h4>
			<p><?php echo anchor("app-profile/$appnameid/faqs", "Go back to app FAQ's")
			; ?></p>
		</div>
		<?php endif; ?>
			<div class="clearfix">
				<label for="">Question</label>
				<div class="input">
					<?php echo form_input("question", $faq->question); ?>
				</div>
			</div>
			<div class="clearfix">
				<label for="">Answer</label>
				<div class="input">
					<?php echo form_textarea("answer", $faq->answer); ?>
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