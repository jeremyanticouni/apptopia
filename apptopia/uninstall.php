<?php

// If uninstall is not called from WordPress, exit 
if ( !defined( 'WP_UNINSTALL_PLUGIN' ) ) { 
exit(); 
} 

// Delete options
delete_option('apptopia_token');
delete

?>