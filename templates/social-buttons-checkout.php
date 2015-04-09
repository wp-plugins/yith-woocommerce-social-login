<?php
/**
 * Section to show social login buttons
 *
 * @package YITH WooCommerce Social Login
 * @since   1.0.0
 * @author  Yithemess
 */
?>
<?php

if( !empty($label_checkout) ):
?>
    <p class="woocommerce-info"><?php printf( '%s <a href="#" class="show-ywsl-box">'.__('Click here to login', 'ywsl').'</a>', $label_checkout ) ?> </p>
    <form class="login ywsl-box">
<?php
    endif;

foreach( $socials as $key=>$value):
    $enabled = get_option('ywsl_'.$key.'_enable');
        if( $enabled == 'yes'):
    ?>
        <a class="ywsl-social ywsl-<?php echo $key  ?>" href="<?php echo  add_query_arg( array('ywsl_social'=>$key, 'redirect'=> urlencode(ywsl_curPageURL())),site_url('wp-login.php')) ?>">
            <img src="<?php echo YITH_YWSL_ASSETS_URL.'/images/'.$key.'.png' ?>" alt="<?php echo $value  ?>"/>
        </a>
    <?php
        endif;
    endforeach; ?>
</form>