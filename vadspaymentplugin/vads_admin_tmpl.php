<?php
#####################################################################################################
#
#					Module pour la plateforme de paiement PayZen
#						Version : 1.0d (révision 32335)
#									########################
#					Développé pour TheCartPress
#						Version : 1.0.7
#						Compatibilité plateforme : V2
#									########################
#					Développé par Lyra Network
#						http://www.lyra-network.com/
#						04/01/2012
#						Contact : support@payzen.eu
#
#####################################################################################################
?>

<tr>
	<td colspan="2"><hr/></td>
</tr>

<tr>
	<th>
		<label> <?php echo _e( 'Developped by', 'vpp'); ?>:</label>
	</th>
	<td>
		<label><a href="http://www.lyra-network.com/" target="_blank">Lyra network</a></label>
	</td>
</tr>

<tr>
	<th>
		<label><?php echo _e( 'Contact us', 'vpp'); ?>:</label>
	</th>
	<td>
		<label><a href="mailto:support@payzen.eu">support@payzen.eu</a></label>
	</td>
</tr>

<tr>
	<th>
		<label><?php echo _e( 'Module version', 'vpp'); ?>:</label>
	</th>
	<td>
		<label>1.0d</label>
	</td>
</tr>

<tr>
	<th>
		<label><?php echo _e( 'Platform version', 'vpp'); ?>:</label>
	</th>
	<td>
		<label>V2</label>
	</td>
</tr>

<tr>
	<th>
		<label><?php echo _e( 'Tested with', 'vpp'); ?>:</label>
	</th>
	<td>
		<label>TheCartPress 1.0.7</label>
	</td>
</tr>

<tr>
	<td colspan="2"><hr/></td>
</tr>

<tr>
	<th>
		<label for="vads_platform_url"><?php echo _e( 'Platform URL', 'vpp'); ?>:</label>
	</th>
	<td>
		<input type="text" name="vads_platform_url" size="50" value="<?php echo isset($data['vads_platform_url']) ? $data['vads_platform_url'] : '';?>" />
		<p class="description"><?php echo _e( 'Link to the payment platform.', 'vpp'); ?></p>
	</td>
</tr>

<tr>
	<th>
		<label for="vads_site_id"><?php echo _e( 'Site ID', 'vpp'); ?>:</label>
	</th>
	<td>
		<input type="text" name="vads_site_id" size="10" value="<?php echo isset($data['vads_site_id']) ? $data['vads_site_id'] : '';?>" />
		<p class="description"><?php echo _e( 'The identifier provided by your bank.', 'vpp'); ?></p>
	</td>
</tr>

<tr>
	<th>
		<label for="vads_key_test">
			<?php echo _e( 'Certificate in test mode', 'vpp'); ?>:
		</label>
	</th>
	<td>
		<input type="text" name="vads_key_test" size="20" value="<?php echo isset($data['vads_key_test']) ? $data['vads_key_test'] : '';?>" />
		<p class="description"><?php echo _e( 'Certificate provided by your bank for test (Available in your back office).', 'vpp'); ?></p>
	</td>
</tr>

<tr>
	<th>
		<label for="vads_key_prod">
			<?php echo _e( 'Certificate in production mode', 'vpp'); ?>:
		</label>
	</th>
	<td>
		<input type="text" name="vads_key_prod" size="20" value="<?php echo isset($data['vads_key_prod']) ? $data['vads_key_prod'] : '';?>" />
		<p class="description"><?php echo _e( 'Certificate provided by your bank (Available in your back office).', 'vpp'); ?></p>
	</td>
</tr>

<tr>
	<th>
		<label for="vads_ctx_mode">
			<?php echo _e( 'Mode', 'vpp'); ?>:
		</label>
	</th>
	<td>
		<input type="radio" name="vads_ctx_mode" id="vads_ctx_mode_test" value="TEST" <?php if ($data['vads_ctx_mode'] == 'TEST') echo 'checked="checked"'; ?>/><label for="vads_ctx_mode_test">TEST</label>
		<input type="radio" name="vads_ctx_mode" id="vads_ctx_mode_prod" value="PRODUCTION" <?php if ($data['vads_ctx_mode'] == 'PRODUCTION') echo 'checked="checked"'; ?>/><label for="vads_ctx_mode_prod">PRODUCTION</label>
		<p class="description"><?php echo _e( 'The context mode of this module.', 'vpp'); ?></p>
	</td>
</tr>

<tr>
	<td colspan="2"><hr/></td>
</tr>

<tr>
	<th>
		<label for="vads_language">
			<?php echo _e( 'Default language', 'vpp'); ?>:
		</label>
	</th>
	<td>
		<select  name="vads_language">
			<option <?php if ($data['vads_language'] == 'fr') echo 'selected="selected"'; ?> value="fr"><?php echo _e( 'French', 'vpp'); ?></option>
			<option <?php if ($data['vads_language'] == 'de') echo 'selected="selected"'; ?> value="de"><?php echo _e( 'German', 'vpp'); ?></option>
			<option <?php if ($data['vads_language'] == 'en') echo 'selected="selected"'; ?> value="en"><?php echo _e( 'English', 'vpp'); ?></option>
			<option <?php if ($data['vads_language'] == 'es') echo 'selected="selected"'; ?> value="es"><?php echo _e( 'Spanish', 'vpp'); ?></option>
			<option <?php if ($data['vads_language'] == 'zh') echo 'selected="selected"'; ?> value="zh"><?php echo _e( 'Chinese', 'vpp'); ?></option>
			<option <?php if ($data['vads_language'] == 'it') echo 'selected="selected"'; ?> value="it"><?php echo _e( 'Italian', 'vpp'); ?></option>
			<option <?php if ($data['vads_language'] == 'ja') echo 'selected="selected"'; ?> value="ja"><?php echo _e( 'Japanese', 'vpp'); ?></option>
			<option <?php if ($data['vads_language'] == 'pt') echo 'selected="selected"'; ?> value="pt"><?php echo _e( 'Portuguese', 'vpp'); ?></option>
		</select>
		<p class="description"><?php echo _e( 'Select the language to use on the payment page by default.', 'vpp'); ?></p>
	</td>
</tr>

<tr>
	<th>
		<label for="vads_available_languages">
			<?php echo _e( 'Available languages', 'vpp'); ?>:
		</label>
	</th>
	<td>
		<select  name="vads_available_languages[]" id="vads_available_languages" multiple="multiple" size="8" style="height: auto;">
			<option <?php if (in_array('fr', $data['vads_available_languages'])) echo 'selected="selected"'; ?> value="fr"><?php echo _e( 'French', 'vpp'); ?></option>
			<option <?php if (in_array('de', $data['vads_available_languages'])) echo 'selected="selected"'; ?> value="de"><?php echo _e( 'German', 'vpp'); ?></option>
			<option <?php if (in_array('en', $data['vads_available_languages'])) echo 'selected="selected"'; ?> value="en"><?php echo _e( 'English', 'vpp'); ?></option>
			<option <?php if (in_array('es', $data['vads_available_languages'])) echo 'selected="selected"'; ?> value="es"><?php echo _e( 'Spanish', 'vpp'); ?></option>
			<option <?php if (in_array('zh', $data['vads_available_languages'])) echo 'selected="selected"'; ?> value="zh"><?php echo _e( 'Chinese', 'vpp'); ?></option>
			<option <?php if (in_array('it', $data['vads_available_languages'])) echo 'selected="selected"'; ?> value="it"><?php echo _e( 'Italian', 'vpp'); ?></option>
			<option <?php if (in_array('ja', $data['vads_available_languages'])) echo 'selected="selected"'; ?> value="ja"><?php echo _e( 'Japanese', 'vpp'); ?></option>
			<option <?php if (in_array('pt', $data['vads_available_languages'])) echo 'selected="selected"'; ?> value="pt"><?php echo _e( 'Portuguese', 'vpp'); ?></option>
		</select>
		<p class="description"><?php echo _e( 'Select none to use gateway config.', 'vpp'); ?></p>
	</td>
</tr>

<tr>
	<th>
		<label for="vads_shop_name">
			<?php echo _e( 'Shop name', 'vpp'); ?>:
		</label>
	</th>
	<td>
		<input type="text" name="vads_shop_name" size="50" value="<?php echo isset($data['vads_shop_name']) ? $data['vads_shop_name'] : '';?>" />
		<p class="description"><?php echo _e( 'Shop name to display on the payment page. Leave blank to use gateway config.', 'vpp'); ?></p>
	</td>
</tr>

<tr>
	<th>
		<label for="vads_shop_url">
			<?php echo _e( 'Shop url', 'vpp'); ?>:
		</label>
	</th>
	<td>
		<input type="text" name="vads_shop_url" size="50" value="<?php echo isset($data['vads_shop_url']) ? $data['vads_shop_url'] : '';?>" />
		<p class="description"><?php echo _e( 'Shop url to display on the payment page. Leave blank to use gateway config.', 'vpp'); ?></p>
	</td>
</tr>

<tr>
	<th>
		<label for="vads_capture_delay">
			<?php echo _e( 'Capture delay', 'vpp'); ?>:
		</label>
	</th>
	<td>
		<input type="text" name="vads_capture_delay" size="10" value="<?php echo isset($data['vads_capture_delay']) ? $data['vads_capture_delay'] : '';?>" />
		<p class="description"><?php echo _e( 'The number of days before the restoration bank (adjustable in your back office).', 'vpp'); ?></p>
	</td>
</tr>

<tr>
	<th>
		<label for="vads_validation_mode">
			<?php echo _e( 'Validation mode', 'vpp'); ?>:
		</label>
	</th>
	<td>
		<select  name="vads_validation_mode">
			<option <?php if ($data['vads_validation_mode'] == '') echo 'selected="selected"'; ?>  value=''><?php echo _e( 'Default', 'vpp'); ?></option>
			<option <?php if ($data['vads_validation_mode'] == '0') echo 'selected="selected"'; ?> value='0'><?php echo _e( 'Automatic', 'vpp'); ?></option>
			<option <?php if ($data['vads_validation_mode'] == '1') echo 'selected="selected"'; ?> value='1'><?php echo _e( 'Manual', 'vpp'); ?></option>
		</select>
		<p class="description"><?php echo _e( 'If manual is selected, you will have to confirm payments manually in your back office.', 'vpp'); ?></p>
	</td>
</tr>


<tr>
	<th>
		<label for="vads_payment_cards">
			<?php echo _e( 'Card types', 'vpp'); ?>:
		</label>
	</th>
	<td>
		<input type="text" name="vads_payment_cards" size="50" value="<?php echo isset($data['vads_payment_cards']) ? $data['vads_payment_cards'] : '';?>" />
		<p class="description"><?php echo _e( 'The card type(s) that can be used for the payment separated by semicolons.', 'vpp'); ?></p>
	</td>
</tr>

<tr>
	<td colspan="2"><hr/></td>
</tr>

<tr>
	<th>
		<label for="vads_amount_min">
			<?php echo _e( 'Minimum amount', 'vpp'); ?>:
		</label>
	</th>
	<td>
		<input type="text" name="vads_amount_min" size="10" value="<?php echo isset($data['vads_amount_min']) ? $data['vads_amount_min'] : '';?>" />
		<p class="description"><?php echo _e( 'Minimum amount allowed.', 'vpp'); ?></p>
	</td>
</tr>

<tr>
	<th>
		<label for="vads_amount_max">
			<?php echo _e( 'Maximum amount', 'vpp'); ?>:
		</label>
	</th>
	<td>
		<input type="text" name="vads_amount_max" size="10" value="<?php echo isset($data['vads_amount_max']) ? $data['vads_amount_max'] : '';?>" />
		<p class="description"><?php echo _e( 'Maximum amount allowed.', 'vpp'); ?></p>
	</td>
</tr>

<tr>
	<td colspan="2"><hr/></td>
</tr>

<tr>
	<th>
		<label for="vads_redirect_enabled">
			<?php echo _e( 'Automatic forward', 'vpp'); ?>:
		</label>
	</th>
	<td>
		<input type="radio" name="vads_redirect_enabled" id="vads_redirect_enabled_yes" value="1" <?php if ($data['vads_redirect_enabled'] == '1') echo 'checked="checked"'; ?>/><label for="vads_redirect_enabled_yes"><?php echo _e( 'Yes', 'vpp'); ?></label>
		<input type="radio" name="vads_redirect_enabled" id="vads_redirect_enabled_no" value="0" <?php if ($data['vads_redirect_enabled'] == '0') echo 'checked="checked"'; ?>/><label for="vads_redirect_enabled_no"><?php echo _e( 'No', 'vpp'); ?></label>
		<p class="description"><?php echo _e( 'If enabled, the client is automatically forwarded to your site at the end of the payment process.', 'vpp'); ?></p>
	</td>
</tr>

<tr>
	<th>
		<label for="vads_redirect_success_timeout">
			<?php echo _e( 'Success forward timeout', 'vpp'); ?>:
		</label>
	</th>
	<td>
		<input type="text" name="vads_redirect_success_timeout" size="10" value="<?php echo isset($data['vads_redirect_success_timeout']) ? $data['vads_redirect_success_timeout'] : '';?>" />
		<p class="description"><?php echo _e( 'Time in seconds (0-300) before the client is automatically forwarded to your site when the payment was successful.', 'vpp'); ?></p>
	</td>
</tr>

<tr>
	<th>
		<label for="vads_redirect_success_message">
			<?php echo _e( 'Success forward message', 'vpp'); ?>:
		</label>                 
	</th>
	<td>
		<input type="text" name="vads_redirect_success_message" size="50" value="<?php echo isset($data['vads_redirect_success_message']) ? $data['vads_redirect_success_message'] : '';?>" />
		<p class="description"><?php echo _e( 'Message posted on the payment platform before forwarding when the payment was successful.', 'vpp'); ?></p>
	</td>
</tr>

<tr>
	<th>
		<label for="vads_redirect_error_timeout">
			<?php echo _e( 'Failure forward timeout', 'vpp'); ?>:
		</label>
	</th>
	<td>
		<input type="text" name="vads_redirect_error_timeout" size="10" value="<?php echo isset($data['vads_redirect_error_timeout']) ? $data['vads_redirect_error_timeout'] : '';?>" />
		<p class="description"><?php echo _e( 'Time in seconds (0-300) before the client is automatically forwarded to your site when the payment failed.', 'vpp'); ?></p>
	</td>
</tr>

<tr>
	<th>
		<label for="vads_redirect_error_message">
			<?php echo _e( 'Failure forward message', 'vpp'); ?>:
		</label>                
	</th>
	<td>
		<input type="text" name="vads_redirect_error_message" size="50" value="<?php echo isset($data['vads_redirect_error_message']) ? $data['vads_redirect_error_message'] : '';?>" />
		<p class="description"><?php echo _e( 'Message posted on the payment platform before forwarding when the payment failed.', 'vpp'); ?></p>
	</td>
</tr>

<tr>
	<th>
		<label for="vads_return_mode">
			<?php echo _e( 'Return mode', 'vpp'); ?>:
		</label>                
	</th>
	<td>
		<select  name="vads_return_mode">
			<option <?php if ($data['vads_return_mode'] == 'GET') echo 'selected="selected"'; ?>  value='GET'>GET</option>
			<option <?php if ($data['vads_return_mode'] == 'POST') echo 'selected="selected"'; ?>value='POST'>POST</option>
			<option <?php if ($data['vads_return_mode'] == 'NONE') echo 'selected="selected"'; ?>value='NONE'>NONE</option>
		</select>
		<p class="description"><?php echo _e( 'Method that will be used for transmitting the payment result from the payment gateway to your store.', 'vpp'); ?></p>
	</td>
</tr>

<tr>
	<th>
		<label for="vads_return_get_params">
			<?php echo _e( 'Additional GET parameters', 'vpp'); ?>:
		</label>                
	</th>
	<td>
		<input type="text" name="vads_return_get_params" size="50" value="<?php echo isset($data['vads_return_get_params']) ? $data['vads_return_get_params'] : '';?>" />
		<p class="description"><?php echo _e( 'Extra parameters sent on return in GET mode.', 'vpp'); ?></p>
	</td>
</tr>

<tr>
	<th>
		<label for="vads_return_post_params">
			<?php echo _e( 'Additional POST parameters', 'vpp'); ?>:
		</label>                
	</th>
	<td>
		<input type="text" name="vads_return_post_params" size="50" value="<?php echo isset($data['vads_return_post_params']) ? $data['vads_return_post_params'] : '';?>" />
		<p class="description"><?php echo _e( 'Extra parameters sent on return in POST mode.', 'vpp'); ?></p>
	</td>
</tr>

<tr>
	<th>
		<label for="vads_url_return">
			<?php echo _e( 'Return URL', 'vpp'); ?>:
		</label>                
	</th>
	<td>
		<input type="text" name="vads_url_return" size="50" value="<?php echo isset($data['vads_url_return']) ? $data['vads_url_return'] : '';?>" />
		<p class="description"><?php echo _e( 'URL on which the client is redirected after payment.', 'vpp'); ?></p>
	</td>
</tr>

<tr>
	<th>
		<label>
			<?php echo _e( 'Server URL to copy in your store back office', 'vpp' ) . ': '; ?>
		</label>
	</th>
	<td>
		<?php echo '<b>'.plugins_url('vadspaymentplugin/vads_notify.php').'</b>'; ?>
	</td>
</tr>
