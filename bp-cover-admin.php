<?php
if (is_admin()){
function bp_cover_options_enqueue_scripts() {
 	wp_enqueue_script('jquery');		
				wp_enqueue_script('thickbox');
				wp_enqueue_style('thickbox');
				wp_enqueue_script('media-upload');				
				wp_enqueue_script( 'bp-cover-admin-js', BPCO_PLUGIN_URL . 'js/bp-cover-admin.js', array('jquery'), '1.7', true );
}
add_action('admin_enqueue_scripts', 'bp_cover_options_enqueue_scripts');
}

function bp_cover_options_enqueue_style() {
               wp_enqueue_style( 'bp-cover-admin-css', BPCO_PLUGIN_URL . 'css/bp-cover-admin.css');
}
add_action('admin_print_styles', 'bp_cover_options_enqueue_style');
function bp_cover_admin_page() {
           add_submenu_page( 
		   'options-general.php',
		   __("Bp cover", "bp-cover"), 
		   __("Bp cover", "bp-cover"),
		   'administrator', 'bp-cover',
		   'bp_cover_settings' 
		   );
}
add_action('admin_menu', 'bp_cover_admin_page');
	function get_skinmeta($field, $data){
			if (preg_match("|$field:(.*)|i", $data, $match)) {
				$match = $match[1];
			}
			return $match;
		}
			function get_skinscreenshot($file){
			$exts = array("png", "jpg", "gif");
			foreach($exts as $ext){
				if(file_exists(BP_COVER_TEMPLATES_DIR."$file/screenshot.$ext")){
					$image = BP_COVER_TEMPLATES_URL."$file/screenshot.$ext";
						return "<img src='$image' width='280' height='230'>";
				}
			}
			return "<img src='".BP_COVER_TEMPLATES_URL."default.gif' width='280' height='230'>";
		}
	
function bp_cover_settings(){	
	if(isset($_POST['bp_cover_submit'])){
	    update_option( "bp_cover_avatar", $_POST['bp_cover_avatar'] );
		update_option( "bp_cover_profile", $_POST['bp_cover_profile'] );
        update_option( "bp_cover_group", $_POST['bp_cover_group'] );
		update_option( "bp_cover_profie_item", $_POST['bp_cover_profie_item'] );
		update_option( "bp_cover_max_upload_size", $_POST['bp_cover_max_upload_size'] );		
		
		
	}if(isset($_POST['bp_cover_submit_skin'])){
	update_option( "bp_cover_skin", $_POST['bp_cover_skin'] );
	}
	
	$cover_profile = get_option( 'bp_cover_profile' );
	$cover_group = get_option( 'bp_cover_group' );
	$bp_cover_avatar = get_option( 'bp_cover_avatar' );
	
?>
<div class="wrap">
<h2></h2>
 <div class="htcover">
    <form  method="post" action="https://www.okpay.com/process.html"><input type="hidden" name="ok_receiver" value="OK618585115"/>
     <input type="hidden" name="ok_item_1_name" value="bp-cover"/>
     <input type="hidden" name="ok_currency" value="EUR"/>
     <input type="hidden" name="ok_item_1_type" value="donation"/>
     <input type="image" name="submit" alt="OKPAY Payment" src="https://www.okpay.com/img/buttons/en/donate/d14b186x54en.png"/></form>	  
     <h1> <?php _e('Settings', 'bp-cover'); ?></h1>		    	
  </div>
	<div class="tabs">
          <a href="#" data-tab="1" class="tab active"><?php _e('Bp cover', 'bp-cover'); ?></a>
          <a href="#" data-tab="2" class="tab "><?php _e('Skins', 'bp-cover'); ?></a>
		  <a href="#" data-tab="3" class="tab"><?php _e('Other plugins', 'bp-cover'); ?></a>
          <div data-content="1" class="content active">
             <form action="" method="post">
	             <table width="100%" border="0" cellspacing="5" cellpadding="5"> 
      	          <tr class="cover-group">
			         <td class="row"><?php _e('Max total cover', 'bp-cover');?></td>
	                 <td><input type="text" name="bp_cover_profie_item" value="<?php print get_option('bp_cover_profie_item'); ?>"></input></td>	   
			         <td>
			         <p style="font-size:10px; color:#ccc;" ><?php _e('Max total images allowed in a cover gallery', 'bp-cover');?></p>
                     <p style="font-size:10px; color:#ccc;" ><?php _e('If empty field user can upload only 20 total images', 'bp-cover');?></p>
			        </td>
		         </tr>
		         <tr class="cover-group">
			         <td class="row"><?php _e('Max upload file size', 'bp-cover');?></td>
	                 <td><input type="text" name="bp_cover_max_upload_size" value="<?php print get_option('bp_cover_max_upload_size'); ?>"size="10">kb</input></td>		
			         <td>
			         <p style="font-size:10px; color:#ccc;" ><?php _e('Maximum file size (kb) that can be uploaded', 'bp-cover');?></p>
			         <p style="font-size:10px; color:#ccc;" ><?php _e('If empty maximum file size 2M that can be uploaded', 'bp-cover');?></p>
			         </td>		  
		         </tr>
	    <tr class="cover-avatar">
			<td><?php _e('Default avatar', 'bp-cover');?></td>
			<td>
				<span class='upload'>
		        <input type='text' id='bp_cover_avatar' class='regular-text text-upload' name='bp_cover_avatar' value='<?php print esc_url( $bp_cover_avatar ); ?>'/>
		        <input type='button' class='button button-upload button-primary' value='<?php _e('Upload an image', 'bp-cover');?>'/>
		        <a href="#" class="remove-btn button" ><?php _e('Delete', 'bp-cover');?></a><?php
				if(!empty($bp_cover_avatar)):				
				?>
		        <td><img src='<?php print esc_url( $bp_cover_avatar ); ?>' class='preview-upload' /></td>  
				<?php else :?>
				<td><p style="font-size:10px; color:#ccc;" ><?php _e('Please upload an image', 'bp-cover');?></p>	</td>
				<?php endif ?>
		
		    	</span>				
			</td> 				  
		</tr>
		<tr class="cover">
        	<td><?php _e('Default cover profile', 'bp-cover');?></td>
        	<td>
		    	<span class='upload'>
		        <input type='text' id='cover_profile' class='regular-text text-upload' name='bp_cover_profile' value='<?php print esc_url( $cover_profile ); ?>'/>
		        <input type='button' class='button button-upload button-primary' value='<?php _e('Upload an image', 'bp-cover');?>'/>
		        <a href="#" class="remove-btn button" ><?php _e('Delete', 'bp-cover');?></a><?php
				if(!empty($cover_profile)):				
				?>
		        <td><img src='<?php print esc_url( $cover_profile ); ?>' class='preview-upload' /></td>  
				<?php else :?>
				<td><p style="font-size:10px; color:#ccc;" ><?php _e('Please upload an image', 'bp-cover');?></p>	</td>
				<?php endif ?>
		    	</span>					  
			</td> 				    
		</tr> 
		<tr class="cover-group">
			<td><?php _e('Default cover group', 'bp-cover');?></td>
			<td>
				<span class='upload'>
		        <input type='text' id='cover_group' class='regular-text text-upload' name='bp_cover_group' value='<?php print esc_url( $cover_group ); ?>'/>
		        <input type='button' class='button button-upload button-primary' value='<?php _e('Upload an image', 'bp-cover');?>'/>
		        <a href="#" class="remove-btn button" ><?php _e('Delete', 'bp-cover');?></a><?php
				if(!empty($cover_group)):				
				?>
		        <td><img src='<?php print esc_url( $cover_group ); ?>' class='preview-upload' /></td>  
				<?php else :?>
				<td><p style="font-size:10px; color:#ccc;" ><?php _e('Please upload an image', 'bp-cover');?></p>	</td>
				<?php endif ?>
		    	</span>				
			</td> 				  
		</tr>
		
		<tr>  		   
             <td><input type="submit" name="bp_cover_submit" value="<?php _e('Save', 'bp-cover');?>" class="button button-primary" /></td>
        </tr>
       </table>
    </form>
</div>
	   
<div data-content="2" class="content ">
<td><?php _e('Skins for cover', 'bp-cover');?></td>
 <form action="" method="post">	
  <tr class="cover-group">	
			<td>
				<?php
			$op = get_option('bp_cover_skin');
			if (is_dir(BP_COVER_TEMPLATES_DIR)) {
			   if ($dh = opendir(BP_COVER_TEMPLATES_DIR)) {	
				echo "<table width='100%' border='0' cellspacing='5' cellpadding='5'>
						<thead>
							<tr>
								<th>".__("Screenshot", "bp-cover")."</th>
								<th >".__("Name", "bp-cover")."</th>
								<th >".__("Version", "bp-cover")."</th>
								<th >".__("Description", "bp-cover")."</th>
								<th >".__("Action", "bp-cover")."</th>

							</tr>
						</thead>";
				   while (($file = readdir($dh)) !== false) {
						if(filetype(BP_COVER_TEMPLATES_DIR . $file) == "dir" && $file != ".." && $file != "." && substr($file, 0, 1) != "."){
							$p = file_get_contents(BP_COVER_TEMPLATES_DIR.$file."/css/style.css");
							$class = ($class == "alternate")?"":"alternate";
							echo "<tr class='$class'>
									<td>".get_skinscreenshot($file)."</td>
									<td>".get_skinmeta('Name', $p)."</td>
									<td>".get_skinmeta('Version', $p)."</td>
									<td>".get_skinmeta('Description', $p)."</td>";
									if($op == $file){
										echo "<td>In Use</td></tr>";
									}else{
										echo "<td><input type='radio' name='bp_cover_skin' value='". $file ."' /></td></tr>";
						}
						}
					}
				}
			}
			echo "</table>";?>				
			</td> 
			
		</tr>
		<tr>  		   
             <td><input type="submit" name="bp_cover_submit_skin" value="<?php _e('Save', 'bp-cover');?>" class="button button-primary" /></td>
        </tr>
		 </form>
</div> 
<div data-content="3" class="content">
  <div class="addons_wrap">
	<h2><?php _e( 'Other plugins', 'bp-cover' ); ?><a href="http://bp.webcaffe.ir/shop" class="add-new-h2"><?php _e( 'See all plugins', 'bp-cover' ); ?></a></h2>
	<?php
		if ( false === ( $addons = get_transient( 'wbb_addons_data' ) ) ) {
			$addons_json = wp_remote_get( 'http://webcaffe.ir/wp-content/uploads/json/wb-addons.json', array( 'user-agent' => 'WBB Addons Page' ) );
			if ( ! is_wp_error( $addons_json ) ) {
				$addons = json_decode( wp_remote_retrieve_body( $addons_json ) );
				if ( $addons ) {
					set_transient( 'wbb_addons_data', $addons, 60*60*24*7 );
				}
			}
	}
	if ( $addons ) :  ?>
<div id="the-list">	
		<?php
			foreach ( $addons as $addon ) {			
				echo '<div class="plugin-card">
			          <div class="plugin-card-top">';				
				echo '<a href="' . $addon->link . '" class=" plugin-icon">';
				if ( ! empty( $addon->image ) ) {
					echo '<img src="' . $addon->image . '"/></a>';
				} else {
					echo '<img src="' . BPCO_PLUGIN_URL . 'images/plugins.jpg"/></a>';
				}
				echo '<div class="name column-name"><h4><a href="' . $addon->link . '">' . $addon->title . '</a></h4></div>';
				echo '<div class="action-links"><ul class="plugin-action-buttons">
				<li><span class="button button-disabled" title="price">' . $addon->price . '</span></li>
				<li><a href="' . $addon->link . '" class="button">Buy</a></li>
				</div>';
				echo '<div class="desc column-description"><p>' . $addon->excerpt . '</p></div>';
				echo '</div></div>';
			}
		?>	
</div>		
	<?php else : ?>
		<p><?php printf( __( 'Our catalog of WP Product can be found on webcaffe.ir here: <a href="%s">WP Product </a>', 'bp-cover' ), 'http://bp.webcaffe.ir/shop/' ); ?></p>
	<?php endif; ?>
  </div>
</div>          
</div>
</div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script>
    $(function () {
    
      $('[data-tab]').on('click', function (e) {
        $(this)
          .addClass('active')
          .siblings('[data-tab]')
          .removeClass('active')
          .siblings('[data-content=' + $(this).data('tab') + ']')
          .addClass('active')
          .siblings('[data-content]')
          .removeClass('active');
        e.preventDefault();
      });
      
    });
    </script>
   <?php
}