<div class="row">
	<div class="span10 offset3">
		<h2>Add Topic for <?php echo $appname; ?></h2>
		<fieldset>
			<? echo form_open(); ?>
			<div class="clearfix">
			<label for="title">Title:</label>
			<div class="input">
				<?php echo form_input("title"); ?>
			</div>
			</div>
			<div class="clearfix">
			<label for="comment">Body:</label>
			<div class="input">
				<?php echo form_textarea("body"); ?>
			</div>
			</div>
		</fieldset>
	</div>
</div>
<div class="row">
<div class="span10 offset3">
<div class="actions">
			<?php $btdata = array("name" => "add",
								"class" => "btn primary"); ?>
			<?php echo form_submit($btdata, "Add Topic"); ?>
			<?php echo form_close(); ?>
</div>
</div>
</div>