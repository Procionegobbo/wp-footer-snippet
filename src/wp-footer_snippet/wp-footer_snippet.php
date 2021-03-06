<?php
/*
Plugin Name: wp_footer snippet
Plugin URI: http://www.procionegobbo.it/
Description: Inserisce codice html/javascript nel footer del blog. Ha bisogno di un tema che supporti l'hook wp_footer<hr>. Attenzione il plugin non esegue controlli su quello che viene inserito!!!
Author: Federico Maiorini aka Procionegobbo
Version: 1.0
Author URI: http://www.procionegobbo.it/
*/
update_option( 'procione_wpfs_script_version', '1.0' );

function procione_wpfs_script() {
	$procione_wpfs_script = get_option( 'procione_wpfs_script' );

	//debug
	//echo "<hr>try wp_footer snippet<hr>";

	if ( $procione_wpfs_script ) {
		echo $procione_wpfs_script;
	}
}

function procione_wpfs_option_panel() {
	if ( isset( $_POST['info_update'] ) ) {
		if ( ! current_user_can( 'manage_options' ) ) {
			die( __( 'Cheatin&#8217; uh?' ) );
		}
		$result = '';
		update_option( 'procione_wpfs_script', stripslashes( $_POST['procione_wpfs_script'] ) );
		echo "<div class='updated'><p><strong>";
		if ( $result == '' ) {
			$result = 'Opzioni aggiornate.';
		}
		_e( $result, 'Localization name' );
		echo "</strong></p></div>";
	}

	echo "
<div class=wrap><div id='poststuff' class='metabox-holder'>
					<h2>wp_footer snippets " . get_option( 'procione_wpfs_script_version' ) . "</h2>
	<div id='wpfs_code' class='postbox'>
		<h3 class='hndle'><span>Inserire il codice da inserire nel footer del blog.</span></h3>
		<div class='inside'>
			<form method='post'>
				<textarea name='procione_wpfs_script' id='procione_wpfs_script' cols='80' rows='20'>" . get_option( 'procione_wpfs_script' ) . "</textarea>				
					<div class='submit'>
						<input type='submit' name='info_update' value='Aggiorna snippet &raquo;' />
					</div>
			</form>
		</div>
	</div>
	<hr/>
</div> </div>  
";
}

function procione_wpfs_options() {
	if ( function_exists( 'add_options_page' ) ) {
		add_submenu_page( 'options-general.php', 'wp_footer snippets', 'wp-footer snippets', 8, basename( __FILE__ ), 'procione_wpfs_option_panel' );
	}
}

add_action( 'admin_menu', 'procione_wpfs_options' );
add_action( 'wp_footer', 'procione_wpfs_script' );