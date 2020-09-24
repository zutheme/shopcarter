<?php
/**
 * Cấu hình cơ bản cho WordPress
 *
 * Trong quá trình cài đặt, file "wp-config.php" sẽ được tạo dựa trên nội dung 
 * mẫu của file này. Bạn không bắt buộc phải sử dụng giao diện web để cài đặt, 
 * chỉ cần lưu file này lại với tên "wp-config.php" và điền các thông tin cần thiết.
 *
 * File này chứa các thiết lập sau:
 *
 * * Thiết lập MySQL
 * * Các khóa bí mật
 * * Tiền tố cho các bảng database
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */
// ** Thiết lập MySQL - Bạn có thể lấy các thông tin này từ host/server ** //
/** Tên database MySQL */
define( 'DB_NAME', 'shop_baby' );
/** Username của database */
define( 'DB_USER', 'shop_baby' );
/** Mật khẩu của database */
define( 'DB_PASSWORD', 'baby' );
/** Hostname của database */
define( 'DB_HOST', '45.117.168.156' );
/** Database charset sử dụng để tạo bảng database. */
define( 'DB_CHARSET', 'utf8mb4' );
/** Kiểu database collate. Đừng thay đổi nếu không hiểu rõ. */
define('DB_COLLATE', '');
/**#@+
 * Khóa xác thực và salt.
 *
 * Thay đổi các giá trị dưới đây thành các khóa không trùng nhau!
 * Bạn có thể tạo ra các khóa này bằng công cụ
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * Bạn có thể thay đổi chúng bất cứ lúc nào để vô hiệu hóa tất cả
 * các cookie hiện có. Điều này sẽ buộc tất cả người dùng phải đăng nhập lại.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '![2*q@gcn$gT?^DWe2,117yk*W5:nl3a/)Af<D-)tW_H,$_4gKi]4TgsHSIv{%I%' );
define( 'SECURE_AUTH_KEY',  '<|)Sz^kJs*)&iHB@Q1:V6lMYAb bQJIBO3 DF][{0QZH9UlfFytNzCC!HQqpC}pu' );
define( 'LOGGED_IN_KEY',    '%0KW[;mQz^$hR-sG*p}21CpV5$fTRfx]Th(1u$/{VeCY?a$HC+gik:$Z]hM$K-yM' );
define( 'NONCE_KEY',        'D?et.vB>TPM?Pm6nm|5eTtI{=}q;v$#Y4tm~s6cqiNma[,?dH.W@HD%^8YbMxkd%' );
define( 'AUTH_SALT',        'tc,1:($tRw}@l2epMbTvtpL3Q18qd>C:O.}1Kj67[4u+,Wl.:0/{:|BCZcm3fbBD' );
define( 'SECURE_AUTH_SALT', 'N{wr-Fy|Ew72&8!Vk5}m0;k|{,J$^Z`$JVF+0&|rLx.aqHVg#>^1^NY2w)m)1+az' );
define( 'LOGGED_IN_SALT',   '_uvkl>[^jTFz2X(drMOjmbli>(,jiL:%ft_%MO1z&>tz<Uy;5o/?V>ev5u:#=FJP' );
define( 'NONCE_SALT',       'Ni`&|&S?Ws1rvqEn!e?J.ix/4FcM3?-eM.<M<qL.nA4$kwa#0dyybl41C:}o9w0V' );
/**#@-*/
/**
 * Tiền tố cho bảng database.
 *
 * Đặt tiền tố cho bảng giúp bạn có thể cài nhiều site WordPress vào cùng một database.
 * Chỉ sử dụng số, ký tự và dấu gạch dưới!
 */
$table_prefix  = 'wp_';
/**
 * Dành cho developer: Chế độ debug.
 *
 * Thay đổi hằng số này thành true sẽ làm hiện lên các thông báo trong quá trình phát triển.
 * Chúng tôi khuyến cáo các developer sử dụng WP_DEBUG trong quá trình phát triển plugin và theme.
 *
 * Để có thông tin về các hằng số khác có thể sử dụng khi debug, hãy xem tại Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', true);
/* Đó là tất cả thiết lập, ngưng sửa từ phần này trở xuống. Chúc bạn viết blog vui vẻ. */
/** Đường dẫn tuyệt đối đến thư mục cài đặt WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');
/** Thiết lập biến và include file. */
require_once(ABSPATH . 'wp-settings.php');
