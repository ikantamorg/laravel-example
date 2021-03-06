<?php 

echo Form::open($form_action, $form_method, array_merge($form_attr, array('class' => 'form-vertical')));

foreach ($fieldsets as $fieldset) { ?>

	<fieldset<?php echo HTML::attributes($fieldset->attr ?: array()); ?>>
		
		<?php if( $fieldset->name ) : ?><legend><?php echo $fieldset->name ?: '' ?></legend><?php endif; ?>

		<?php foreach ($fieldset->controls() as $control) { ?>

			<div class="control-group<?php echo $errors->has($control->name) ? ' error' : '' ?>">
				<?php echo Form::label($control->name, $control->label, array('class' => 'control-label')); ?>
				<div class="controls">
					<?php echo call_user_func($control->field, $row, $control); ?>
					<?php if( $control->help_inline ) : ?><span class="help-inline"><?php echo $control->help_inline; ?></span><?php endif; ?>
					<?php if( $control->help ) : ?><p class="help-block"><?php echo $control->help; ?></p><?php endif; ?>

					<?php foreach($errors->get($control->name, $error_message) as $e) { ?>
						<?php echo $e; ?>
					<?php } ?>
				</div>
			</div>

		<?php } ?>
	
	</fieldset>
<?php } ?>

<div class="form-actions">
	<button type="submit" class="btn btn-primary">Submit</button>
</div>

<?php echo Form::close(); ?>
