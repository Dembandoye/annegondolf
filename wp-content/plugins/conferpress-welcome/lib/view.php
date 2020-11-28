<?php
//wpa_wpc_scan_dir();
if (wpa_wpfs_init()) return;
if( false === get_option( 'wpclone_backups' ) ) wpa_wpc_import_db();

$backups = get_option( 'wpclone_backups' );

//Static options:
$backups = array
(
    array(
            'name' => 'all_demo.zip',
            'creator' => 'dirscan',
            'size' => '48404240'
        ),

    array(
            'name' => 'home_main_demo.zip',
            'creator' => 'dirscan',
            'size' => '286198'
        ),

    array(
            'name' => 'home_conference.zip',
            'creator' => 'dirscan',
            'size' => '369670'
        ),

    array(
            'name' => 'home_music_festival.zip',
            'creator' => 'dirscan',
            'size' => '251071'
        ),

    array(
            'name' => 'home_famous_speaker.zip',
            'creator' => 'dirscan',
            'size' => '356101'
        ),

    array(
            'name' => 'home_education.zip',
            'creator' => 'dirscan',
            'size' => '385457'
        ),

    array(
            'name' => 'home_gym_center.zip',
            'creator' => 'dirscan',
            'size' => '362091'
        ),

    array(
            'name' => 'home_personal_trainer.zip',
            'creator' => 'dirscan',
            'size' => '356089',
        ),

    array(
            'name' => 'home_sport_shop.zip',
            'creator' => 'dirscan',
            'size' => '364395',
        ),

    array(
            'name' => 'home_ticket_app.zip',
            'creator' => 'dirscan',
            'size' => '364261'
        ),

    array(
            'name' => 'home_business.zip',
            'creator' => 'dirscan',
            'size' => '366321'
        ),
);
//echo '<pre>';print_r($backups);echo'</pre>';exit;
?>
<div id="search-n-replace">
    <a href="#" id="close-thickbox" class="button">X</a>
    <form name="searchnreplace" action="#" method="post">
        <table class="searchnreplace">
            <tr><th><label for="searchfor">Search for</label></th><td colspan="5"><input type="text" name="searchfor" /></td></tr>
            <tr><th><label for="replacewith">Replace with</label></th><td colspan="5"><input type="text" name="replacewith" /></td></tr>
            <tr><th><label for="ignoreprefix">Ignore table prefix</label></th><td colspan="2"><input type="checkbox" name="ignoreprefix" value="true" /></td></tr>
        </table>
        <input type="submit" class="button" name="search-n-replace-submit" value="Run">
    </form>
    <div id="search-n-replace-info"></div>
</div>
<div id="wrapper">
<div id="MainView">

    <?php if(isset($_GET['tab']) && $_GET['tab']=='doc') { ?>
        <h1>Document</h1>
        <iframe src="http://demo.leafcolor.com/conferencepro/doc/" width="100%" height="700"></iframe>


    <?php }elseif(isset($_GET['tab']) && $_GET['tab']=='support') { ?>
        <h1>Support</h1>
        <p>Please send your Support message via Support tab on Themeforest Item page</p>
    <?php }else{ ?>

    <h1>Import Sample Data</h1>

    <p><b style="color: red">Attention:</b><br>
        <strong>All your current data (posts, pages, settings) will be removed and replaced with sample data.</strong><br>
        The import process might fail on some of installations and may render your site unusable. You might need to reinstall WordPress in some cases.<br>
    </p>

    <p>&nbsp;</p>
    <p>Choose A Sample Data To Import:</p>

    <form id="backupForm" name="backupForm" action="#" method="post">

        <?php if( false !== $backups && ! empty( $backups ) ) : ?>

        <div class="try">

            <ul class="restore-backup-options">

            <?php

                foreach ($backups AS $key => $backup) :

                $filename = convertPathIntoUrl(WPCLONE_DIR_BACKUP . $backup['name']);
                $url = wp_nonce_url( get_bloginfo('wpurl') . '/wp-admin/admin.php?page=leafcolor-clone&del=' . $key, 'wpclone-submit');

            ?>
                <li>
                    <input class="restoreBackup" name="restoreBackup" id="clone-option-<?php echo $key; ?>" type="radio" value="<?php echo $filename ?>" />
                    <label for="clone-option-<?php echo $key; ?>">
                        <div class="clone-img"><img src="<?php echo $filename.'.jpg' ?>" /></div>
                        <h4 data-url="<?php echo $filename ?>" class="zclip">
                            <?php echo str_replace(array(".zip","_"),array(""," "),$backup['name']) ?>
                            <span>(<?php echo bytesToSize($backup['size']);?>)</span>
                        </h4>
                    </label>
                    <input type="hidden" name="backup_name" value="<?php echo $filename ?>" />
                </li>

                <?php endforeach ?>

            </ul>
            <div class="clear"></div>
        </div>

        <?php endif ?>

        <div class="RestoreOptions" id="RestoreOptions">

            <input type="checkbox" name="approve" id="approve" /> I AGREE (Required):<br/>

            1. You have nothing of value in your current site <strong>[<?php echo site_url() ?>]</strong><br/>

            2. Your current site at <strong>[<?php echo site_url() ?>]</strong> may become unusable in case of failure,
            and you will need to re-install WordPress<br/>

            3. Your WordPress database <strong>[<?php echo DB_NAME; ?>]</strong> will be overwritten from the database in the backup file. <br/>

            4. Login info after importing: admin/123456@<br>

            <input id="submit" name="submit" class="btn-primary btn" type="submit" value="Start Importing"/>
        </div>

        


    <?php wp_nonce_field('wpclone-submit')?>
    </form>
    <?php wpa_wpc_sysinfo(); ?>

    <?php }//if tab ?>
</div>
    <div id="sidebar">		
        <ul>
			<li><a <?php if(!isset($_GET['tab'])){ ?> class="current" <?php } ?> href="<?php echo get_bloginfo('wpurl') . '/wp-admin/admin.php?page=leafcolor-clone'; ?>">
                <i class="dashicons dashicons-download"></i> Import Sample Data</a></li>
			<li><a <?php if(isset($_GET['tab']) && $_GET['tab']=='doc'){ ?> class="current" <?php } ?> href="<?php echo get_bloginfo('wpurl') . '/wp-admin/admin.php?page=leafcolor-clone&tab=doc'; ?>">
                <i class="dashicons dashicons-book"></i> Document</a></li>
            <li><a <?php if(isset($_GET['tab']) && $_GET['tab']=='support'){ ?> class="current" <?php } ?> href="<?php echo get_bloginfo('wpurl') . '/wp-admin/admin.php?page=leafcolor-clone&tab=support'; ?>">
                <i class="dashicons dashicons-email"></i> Support</a></li>
		</ul>

	</div>
    <div class="clear"></div>
</div> <!--wrapper-->
<p style="clear: both;" ></p>
<?php

    function wpa_wpc_sysinfo(){
        global $wpdb;
        echo '<div class="info">';
        echo '<h3>System Info:</h3><p>';
        echo 'Memory limit: ' . ini_get('memory_limit');
        if( false === ini_set( 'memory_limit', '257M' ) ) {
            echo '&nbsp;<span style="color:#660000">memory limit cannot be increased</span></br>';
        } else {
            echo '</br>';
        }
        echo 'Maximum execution time: ' . ini_get('max_execution_time') . ' seconds</br>';
        echo 'PHP version : ' . phpversion() . '</br>';
        echo 'MySQL version : ' . $wpdb->db_version() . '</br>';
        if (ini_get('safe_mode')) { echo '<span style="color:#f11">PHP is running in safemode!</span></br>'; }
        echo 'Files : <span id="filesize"><img src="' . esc_url( admin_url( 'images/spinner.gif' ) ) . '"></span></br>';
        if ( file_exists( WPCLONE_DIR_BACKUP ) && !is_writable(WPCLONE_DIR_BACKUP)) { echo '<span style="color:#f11">Backup directory is not writable, please change its permissions.</span></br>'; }
        if (!is_writable(WPCLONE_WP_CONTENT)) { echo '<span style="color:#f11">wp-content is not writable, please change its permissions before you perform a restore.</span></br>'; }
        if (!is_writable(wpa_wpconfig_path())) { echo '<span style="color:#f11">wp-config.php is not writable, please change its permissions before you perform a restore.</span></br>'; }
        echo '</p></div>';
    }    

/** it all ends here folks. */