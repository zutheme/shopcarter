<?php
/**
 * The template for displaying product price filter widget.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-widget-price-filter.php
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.7.1
 */

defined( 'ABSPATH' ) || exit;
?>

<?php do_action( 'woocommerce_widget_price_filter_start', $args ); ?>
<div class="widget-filters__item">
    <div class="filter filter--opened" data-collapse-item>
        <button type="button" class="filter__title" data-collapse-trigger>
            Price
            <svg class="filter__arrow" width="12px" height="7px">
                <use xlink:href="<?php echo get_template_directory_uri()  . '/images/sprite.svg'; ?>#arrow-rounded-down-12x7"></use>
            </svg>
        </button>
        <div class="filter__body" data-collapse-content>
            <div class="filter__container">
                <div class="filter-price" data-min="<?php echo esc_attr( $min_price ); ?>" data-max="<?php echo esc_attr( $max_price ); ?>" data-from="<?php echo esc_attr( $current_min_price ); ?>" data-to="<?php echo esc_attr( $current_min_price + $current_min_price*0.3 ); ?>">
                    <div class="filter-price__slider"></div>
                    <div class="filter-price__title"><?php esc_html_e( 'Price: ', 'woocommerce' );  echo get_woocommerce_currency_symbol(); ?><span class="filter-price__min-value"></span> –  <?php echo get_woocommerce_currency_symbol(); ?><span class="filter-price__max-value"></span></div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php do_action( 'woocommerce_widget_price_filter_end', $args ); ?>
