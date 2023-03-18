<?php

/**
  * Add the below code to your child themne functions.php file
  *
*/

/**
  * Add the second image to the shop page
  *
*/
add_action('woocommerce_before_shop_loop_item', 'my_shop_extra_img');
function my_shop_extra_img(){

  /**
    * You can limit this to shop only or archive only by adding the following
    *
    * if(is_shop()) {} // will only apply on shop pages
    * if(is_product_category()) {} // will only apply to archive pages
    * if(is_shop() || is_product_category()) {} // will apply to both shop and archive pages
    * if(is_product_category('shirt')) {} // will only apply tot he category with the slug of shirt
    * 
    * You can also use the not match != to exclude parges and categories
    *
  */
	$product = new WC_product(get_the_id()); 
	$attachment_ids = $product->get_gallery_image_ids();

	echo wp_get_attachment_image($attachment_ids[0], 'shop_catalog', false, array('class' => 'second-product-img'));

}




/**
  * add hover script
  *
  * Note: If the script does not work you may need to inspect element to find the correct class names. Below we are searching for the list item class name of product and the images within that class
*/

add_action('wp_footer', 'my_img_hover_script');
function my_img_hover_script(){
?>
<script>
	(function($) {
    		// When hovering the images trigger the hover function
		$('li.product img').hover(function () {

			// find how many images are available.
			var numProductImgs = $(this).parent().find('img').length;
			
			// find the image to add an extra class to when hovering. The extra class will toggle on and off when entering and leaving hover mode. Only apply if 2 images are available
			if(numProductImgs >= 2){
				$(this).parent().find('.attachment-woocommerce_thumbnail').toggleClass("result_hover");
			}
	
		});
	})( jQuery );
</script>
<?php
}
