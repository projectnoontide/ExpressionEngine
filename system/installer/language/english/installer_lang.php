<?php

$lang['enter_settings'] = 'Enter Your Settings';
$lang['contact_host'] = '<strong>Note: </strong> If you are not sure what any of these settings should be, please contact your hosting provider and ask them.';
$lang['your_version'] = 'We have detected that you are currently running ExpressionEngine version %x';
$lang['ready_to_update'] = 'If you are ready to update ExpressionEngine to version %x click the link below:';
$lang['ready_to_install'] = 'If you are ready to install ExpressionEngine version %x click the link below:';
$lang['backup_confirmation'] = 'Did you perform a full backup of your existing ExpressionEngine files and database?';

// Database Server
$lang['db_hostname'] = 'Database Server Address';
$lang['db_hostname_note'] = 'Commonly <b>localhost</b>, but your host may require something else.';
$lang['db_name'] = 'Database Name';
$lang['db_name_note'] = 'Name of the database where you want ExpressionEngine installed.';
$lang['db_name_warning'] = 'Make sure the database exists, the installer will <b>not</b> create it.';
$lang['db_username'] = 'Database Server Username';
$lang['db_username_note'] = 'Username used to access the above database.';
$lang['db_password'] = 'Database Server Password';
$lang['db_password_note'] = 'Password used to access the above database.';
$lang['db_prefix'] = 'Database Table Prefix';
$lang['db_prefix_note'] = 'Use <b>exp</b> unless you require/prefer a different prefix.';

// Account Creation
$lang['administrator_account'] = 'Administrator Account';
$lang['username'] = 'Username';
$lang['username_note'] = 'Username you want to use to login to the <abbr title="Control Panel">CP</abbr>.';
$lang['e_mail'] = 'e-mail';
$lang['e_mail_note'] = 'e-mail address you want to use for this account.';
$lang['password'] = 'Password';
$lang['password_note'] = 'Password you want to use to login to the <abbr title="Control Panel">CP</abbr>.';

// Timezone Selection
// TODO-WB: Remove before release.
$lang['local_settings'] = 'Localization Settings';
$lang['timezone'] = 'Your Timezone';
$lang['select_timezone'] = 'Select Timezone';
$lang['no_timezones'] = 'No Timezones';

// Default Theme
$lang['default_theme'] = 'Default theme';
$lang['install_default_theme'] = 'Install default theme?';
$lang['install_default_theme_info'] = 'When set to <b>yes</b>, ExpressionEngine will install a default theme.';

$lang['start_installation'] = 'Start Installation';

$lang['back'] = 'Back';
$lang['error'] = 'ERROR';
$lang['submit'] = 'Submit';
$lang['error_occurred'] = 'Oops, there was an error';
$lang['module_errors_occurred'] = 'The following error(s) were reported during module installation:';
$lang['click_to_install'] = 'Click here to install a brand new copy of ExpressionEngine';
$lang['click_to_update'] = 'Click here to update ExpressionEngine to Version %s';
$lang['version_update_text'] = 'Running update ...';
$lang['invalid_action'] = 'The action you have requested is not valid.';
$lang['unreadable_config'] = 'Your config.php file is unreadable. Please make sure the file exists and that the file permissions to 666 (or the equivalent write permissions for your server) on the following file: expressionengine/config/config.php';
$lang['unwritable_config'] = 'Your config.php file does not appear to have the proper file permissions.  Please set the file permissions to 666 (or the equivalent write permissions for your server) on the following file: expressionengine/config/config.php';
$lang['unwritable_cache_folder'] = 'Your cache folder does not appear to have proper permissions.  Please set the folder permissions to 777 (or the equivalent write permissions for your server) on the following folder: expressionengine/cache';

$lang['database_no_config'] = 'Unable to connect to your database using the configuration settings found in the following file: config/config.php file. Please correct the settings so that the update can proceed.';
$lang['database_no_data'] = 'Unable to locate any database connection information.';
$lang['database_no_connect'] = 'Unable to connect to your database using the configuration settings you submitted.';
$lang['database_prefix_invalid_characters'] = 'There are invalid characters in the database prefix. Only 0-9, a-z, A-Z, $, and _ are allowed.';
$lang['database_prefix_contains_exp_'] = 'The database prefix cannot contain the string "exp_".';
$lang['database_prefix_too_long'] = 'The database prefix cannot be longer than 30 characters.';

$lang['unreadable_update'] = 'Unable to read the contents of your /expressionengine/installer/updates directory.  Please check the file permissions and re-run this installation wizard.';
$lang['unreadable_files'] = 'One of your update files is unreadable. Please make sure all of the files located in this folder are readable: expressionengine/installer/updates/';
$lang['unreadable_language'] = 'The language files needed for your current language selection (%x) are unavailable. Please put the language pack in this folder: expressionengine/language/';
$lang['unreadable_email'] = 'Unable to locate the file containing your email templates (email_data.php).  Make sure you have uploaded all components of this software.';
$lang['unreadable_schema'] = 'Unable to locate the following folder:  expressionengine/installer/schema/  Please upload all components before proceeding.';
$lang['unreadable_dbdriver'] = 'Unable to locate the databae schema file in the following folder:  expressionengine/installer/schema/  Please upload all components before proceeding.';
$lang['improper_grants'] = 'Error: Unable to perform the SQL queries. Please make sure your SQL account has the proper GRANT privileges:  CREATE, DROP, ALTER, INSERT, and DELETE';
$lang['empty_fields'] = 'You must fill out all form fields';
$lang['username_short'] = 'Your username must be at least 4 characters in length';
$lang['password_short'] = 'Your password must be at least 5 characters in length';
$lang['password_no_match'] = 'Your passwords and password confirmation do not match';
$lang['password_not_unique'] = 'Your password can not be based on the username';
$lang['password_no_dollar'] = 'Your MySQL password can not contain a dollar sign';
$lang['update_error'] = 'An unexpected error occurred while performing the update';
$lang['update_step_error'] = 'An unexpected error occured while performing the update.  Could not find update step: %x';

$lang['install_detected_msg'] = 'ExpressionEngine appears to already be installed on your database, even though your config and database files are blank. If you are attempting to <strong>UPDATE</strong> ExpressionEngine from a previous version <strong>Do NOT click the button</strong>. Instead, restore your config file first, then run this installation wizard again starting from the first page.';

$lang['please_stand_by'] = 'Please Stand By...';
$lang['currently_installing'] = 'We are currently updating your ExpressionEngine installation.';
$lang['dont_close_browser'] = 'Do not close your browser until the update routine is finished.';

// Install/Upgrade Success
$lang['install_success'] = "ExpressionEngine %s Installed";
$lang['install_success_note'] = '<b>Yay!</b> ExpressionEngine %s is now installed.';
$lang['upgrade_success'] = "ExpressionEngine Upgraded to %s";
$lang['upgrade_success_note'] = '<b>Yay!</b> ExpressionEngine is now upgraded to %s.';
$lang['success_delete'] = 'Please delete the installer folder/directory from your server before proceeding.';
$lang['cp_login'] = 'Control Panel login';

$lang['running_current'] = 'You are now running the most current version of ExpressionEngine!';
$lang['version_warning'] = 'Error: In order to install ExpressionEngine, your server must be running PHP version %x or newer.';
$lang['version_running'] = 'Your server is current running PHP version:';
$lang['switch_hosts'] = 'Contact your hosting provider to see if newer software is available for your server.';

$lang['trackback_removal_options'] = 'Trackback Conversion and Archiving Options';
$lang['trackback_gone_in_200'] = 'The Trackback module has been removed in ExpressionEngine 2.  You can choose to convert existing trackbacks to comments and/or generate a zip archive containing all existing trackbacks.';
$lang['trackbacks_not_recoverable'] = 'All trackbacks will be removed.';

$lang['convert_to_comments'] = 'Convert Trackbacks to Comments';
$lang['archive_trackbacks'] = 'Create XML Archive of Trackback Data';
$lang['trackback_zip_path'] = 'Path to the directory where the archive will be saved.';
$lang['path_must_be_writable'] = 'The path must be writable and must not contain a file called trackback.zip';
$lang['trackback_not_writable'] = 'The trackback path is not writable or already contains a file called trackback.zip';
$lang['update_ee'] = 'Update ExpressionEngine!';

// surveys
$lang['opt_in_survey'] = 'Opt-in Survey';
$lang['help_with_survey'] = "Please consider helping us make ExpressionEngine better by completing the optional survey for this update.";
$lang['participate_in_survey'] = 'Participate in Survey?';
$lang['send_anonymous_server_data'] = 'Send Anonymous Server Data?';
$lang['what_server_data_is_sent'] = '<p>What data is sent?  Answering yes to this survey question will transmit the following:</p>
	<ul>
		<li>A one-way hash of your site URL to prevent duplicate submissions (this cannot be used to identify you)</li>
		<li>PHP version and available extensions</li>
		<li>MySQL version, server operating system</li>
		<li>Server software name</li>
		<li>Whether or not you are using forced query strings on your server</li>
		<li>A list of the add-ons in your third party directory</li>
		<li>Whether or not you have Discussion Forums installed</li>
		<li>Whether or not you have Multiple Site Manager installed</li>
	</ul>
	<p>All data is transmitted anonymously and cannot be associated with your local machine, ExpressionEngine user
	account, your site, or your host.</p>';
$lang['show_hide_to_see_server_data'] = 'Show/hide the server data that will be sent';
$lang['would_you_recommend'] = 'How likely is it that you will recommend ExpressionEngine to a colleague or friend?';
$lang['unlikely'] = 'Unlikely';
$lang['highly_likely'] = 'Highly Likely';
$lang['additional_comments'] = 'What could ExpressionEngine or EllisLab do to delight you?';

// Template Updater Lang
$lang['updating_template_as_files'] = 'Updating templates saved as files.';
$lang['template_folders_not_located'] = 'The following site shortnames have templates saved as text files but no corresponding folder exists for the site:';
$lang['template_folders_not_located_instr'] = 'Please upload the contents of your 1.x system/templates/ directory to the corresponding system/expressionengine/templates/&lt;site_short_name&gt;/  folder and verify permissions on the templates folder is set to 777.';
$lang['template_files_not_located'] = 'Tempates should be saved as text files in the following locations, but the files are not readable.  Please make sure the files exists and have proper permissions:';

$lang['template_missing_explain_retry'] = 'The updater will sync your templates with the database and move the old files to a folder within the templates directory for archival purposes.  If the missing template files cannot be found and read, it is possible the database will not contain the most recent version of your template.  To prevent this, you are encouraged to replace any missing files above and %s.';

$lang['template_missing_explain_ignore'] = '  If the database was already synced to the files or the missing folders are moot, you may %s';

$lang['template_retry'] = 'Resume the Update';
$lang['template_ignore'] = 'Ignore the Template Warning';

$lang['template_move_errors'] = 'There was an error moving your existing template files to an archive folder.  Please manually move any folders in the form system/expressionengine/templates/&lt;site_short_name&gt;/ to a backup location and then %s.';

$lang['template_folder_not_writeable'] = 'The template folder is not writeable, make sure permissions are set to 777 on %s';
$lang['unable_to_read_tmpl_file'] = 'Unable to read the following file:  %s Verify it exists.';
$lang['could_not_create_folder'] = 'Could not create folder for %s.  Please make sure %s is writable';

/* End of file installer_lang.php */
/* Location: ./system/expressionengine/installer/language/english/installer_lang.php */
