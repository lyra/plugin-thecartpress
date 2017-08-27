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

<form action="<?php echo $vads->platformUrl; ?>" method="POST">
	<div>
		<div>
	    	<div style="float: left; padding: 10px;"><input type="image" src="<?php echo plugins_url('vadspaymentplugin/images/logo.jpg'); ?>" border="0" name="submit" alt="PayZen" /></div>
	    	<div style="float: left; padding: 10px;"><?php echo '<b>'.__('Click the button to pay with the secured payment platform ', 'vpp').'PayZen</b>'; ?></div>
	        <div style="clear: both;"></div>
	    </div>
	</div>
	<?php echo $vads->getRequestFieldsHtml(); ?>
</form>
