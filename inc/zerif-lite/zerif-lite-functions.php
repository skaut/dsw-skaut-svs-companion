<?php
/**
 * Companion code for Zerif-Lite
 *
 * @author Themeisle
 * @package themeisle-companion
 */


function scout_populate_custom_text(){
    set_theme_mod( 'zerif_bigtitle_title_2', __( 'SKAUT', 'scout-theme' ));


    set_theme_mod( 'zerif_ourfocus_title_2', __( 'ODDÍLY', 'scout-theme' ));


    set_theme_mod( 'zerif_aboutus_title', __( 'O STŘEDISKU', 'scout-theme' ));

    set_theme_mod( 'zerif_aboutus_biglefttitle', __( 'Skautské středisko', 'scout-theme' ));

    set_theme_mod( 'zerif_aboutus_text', __( '<strong>Celý název:</strong> Junák - český skaut, středisko, z. s.<br><strong>Číslo střediska: </strong><span> 123.45</span><br><strong>IČO:</strong> 12345678<br><strong>Sídlo:</strong> Ulice 123, 123 45 Město<br><strong>Počet registrovaných členů:</strong><span> 123 (rok 2017)<br></span><strong>WWW:</strong><span> https://stredisko.skauting.cz<br><strong>Vůdce střediska:</strong>  JANA NOVÁKOVÁ', 'scout-theme' ));


    set_theme_mod( 'zerif_ourteam_title', __( 'Vedení střediska', 'scout-theme' ));

    set_theme_mod( 'zerif_testimonials_title', __( 'Říkají o nás', 'scout-theme' ));

    set_theme_mod( 'zerif_ribbonright_text', __( 'Najít kamarády – zažít dobrodružství','scout-theme' ));

    set_theme_mod( 'zerif_bottomribbon_text',  __( 'Skauting je příležitost pro nové zážitky v každém věku','scout-theme' ));

    set_theme_mod( 'zerif_contactus_title', __( 'Napište nám','scout-theme' ));

    $file = get_stylesheet_directory_uri() . "/images/skaut_logo_header.png";;
    $filename = basename($file);
    $upload_file = wp_upload_bits($filename, null, file_get_contents($file));
    if (!$upload_file['error']) {
        $wp_filetype = wp_check_filetype($filename, null );
        $attachment = array(
            'post_mime_type' => $wp_filetype['type'],
            'post_title' => preg_replace('/\.[^.]+$/', '', $filename),
            'post_content' => '',
            'post_status' => 'inherit'
        );
        $attachment_id = wp_insert_attachment( $attachment, $upload_file['file'] );
        if (!is_wp_error($attachment_id)) {
            require_once(ABSPATH . "wp-admin" . '/includes/image.php');
            $attachment_data = wp_generate_attachment_metadata( $attachment_id, $upload_file['file'] );
            wp_update_attachment_metadata( $attachment_id,  $attachment_data );
        }
    }

    set_theme_mod( 'custom_logo',$attachment_id);

}


/**
 * Populate Zerif frontpage widgets areas with default widgets for scout theme
 */
function scout_populate_with_default_widgets() {

	$zerif_lite_sidebars = array( 'sidebar-ourfocus'     => 'sidebar-ourfocus',
	                              'sidebar-testimonials' => 'sidebar-testimonials',
	                              'sidebar-ourteam'      => 'sidebar-ourteam',
	                              'sidebar-aboutus'      => 'sidebar-aboutus'
	);

	$active_widgets = get_option( 'sidebars_widgets' );

	/**
	 * Populate the Our Focus sidebar
	 */
	if ( empty ( $active_widgets[ $zerif_lite_sidebars['sidebar-ourfocus'] ] ) ) {

		$zerif_lite_counter = 1;

		/* our focus widget #1 */

		$active_widgets['sidebar-ourfocus'][0] = 'ctup-ads-widget-' . $zerif_lite_counter;

		if ( file_exists( get_stylesheet_directory() . '/images/skaut_svetlusky.png' ) ) {
			$ourfocus_content[ $zerif_lite_counter ] = array(
				'title'     => 'Světlušky',
				'text'      => 'Roj světlušel<br> dívky ve&nbsp;věku 6-12 let.',
				'link'      => '#',
				'image_uri' => get_stylesheet_directory_uri() . "/images/skaut_svetlusky.png"
			);
		} else {
			$ourfocus_content[ $zerif_lite_counter ] = array(
                'title'     => 'Světlušky',
                'text'      => 'Roj světlušel<br> dívky ve&nbsp;věku 6-12 let.',
                'link'      => '#',
				'image_uri' => get_template_directory_uri() . "/images/skaut_svetlusky.png"
			);
		}

		update_option( 'widget_ctup-ads-widget', $ourfocus_content );

		$zerif_lite_counter ++;

		/* our focus widget #2 */

		$active_widgets['sidebar-ourfocus'][] = 'ctup-ads-widget-' . $zerif_lite_counter;

		if ( file_exists( get_stylesheet_directory() . '/images/skaut_vlcata.png' ) ) {
			$ourfocus_content[ $zerif_lite_counter ] = array(
				'title'     => 'Vlčata',
				'text'      => 'Smečka vlčat<br> chlapci ve&nbsp;věku 6-12 let.',
				'link'      => '#',
				'image_uri' => get_stylesheet_directory_uri() . "/images/skaut_vlcata.png"
			);
		} else {
			$ourfocus_content[ $zerif_lite_counter ] = array(
				'title'     => 'Vlčata',
				'text'      => 'Smečka vlčat<br> chlapci ve&nbsp;věku 6-12 let.',
				'link'      => '#',
				'image_uri' => get_template_directory_uri() . "/images/skaut_vlcata.png"
			);
		}

		update_option( 'widget_ctup-ads-widget', $ourfocus_content );

		$zerif_lite_counter ++;

		/* our focus widget #3 */

		$active_widgets['sidebar-ourfocus'][] = 'ctup-ads-widget-' . $zerif_lite_counter;

		if ( file_exists( get_stylesheet_directory() . '/images/skaut_skautky.png' ) ) {
			$ourfocus_content[ $zerif_lite_counter ] = array(
				'title'     => 'Skautky',
				'text'      => 'Oddíl skautek<br>dívky ve věku 12-16 let.',
				'link'      => '#',
				'image_uri' => get_stylesheet_directory_uri() . "/images/skaut_skautky.png"
			);
		} else {
			$ourfocus_content[ $zerif_lite_counter ] = array(
                'title'     => 'Skautky',
                'text'      => 'Oddíl skautek<br>dívky ve věku 12-16 let.',
                'link'      => '#',
				'image_uri' => get_template_directory_uri() . "/images/skaut_skautky.png"
			);
		}

		update_option( 'widget_ctup-ads-widget', $ourfocus_content );

		$zerif_lite_counter ++;

		/* our focus widget #4 */

		$active_widgets['sidebar-ourfocus'][] = 'ctup-ads-widget-' . $zerif_lite_counter;

		if ( file_exists( get_stylesheet_directory() . '/images/skaut_skauti.png' ) ) {
			$ourfocus_content[ $zerif_lite_counter ] = array(
				'title'     => 'Skauti',
				'text'      => 'Oddíl skautů<br>chlapci ve věku 12-16 let.',
				'link'      => '#',
				'image_uri' => get_stylesheet_directory_uri() . "/images/skaut_skauti.png"
			);
		} else {
			$ourfocus_content[ $zerif_lite_counter ] = array(
                'title'     => 'Skauti',
                'text'      => 'Oddíl skautů<br>chlapci ve věku 12-16 let.',
                'link'      => '#',
				'image_uri' => get_template_directory_uri() . "/images/skaut_skauti.png"
			);
		}

		update_option( 'widget_ctup-ads-widget', $ourfocus_content );

		$zerif_lite_counter ++;

		update_option( 'sidebars_widgets', $active_widgets );

	}

	/**
	 * Populate the Testimonials sidebar
	 */
	if ( empty ( $active_widgets[ $zerif_lite_sidebars['sidebar-testimonials'] ] ) ) {

		$zerif_lite_counter = 1;

		/* testimonial widget #1 */

		$active_widgets['sidebar-testimonials'][0] = 'zerif_testim-widget-' . $zerif_lite_counter;

		if ( file_exists( get_stylesheet_directory() . '/images/testimonial1.jpg' ) ) {
			$testimonial_content[ $zerif_lite_counter ] = array(
				'title'     => 'Jiří Menzel',
				'text'      => 'Nějak se nám víc a víc nejrůznějšími cestami vtlouká do hlavy, že si každý mladý člověk musí po vzoru těch filmových a seriálových hrdinů své místo na slunci vydobýt sám, a to třeba i na úkor ostatních. Ve skautu, nebo jak nás pokřtili přátelé českého jazyka, v Junáku, jsme byli soudržnější a učili se věrnosti a smyslu pro solidaritu. Bylo nám vštěpeno, že nejsme na světě jenom pro sebe, ale jsme v rytířském duchu mušketýrů „Jeden za všechny, všichni za jednoho“. Všeobecně se má za to, že skauting vychovává mladé duše k úctě k přírodě, k šetrnosti k životnímu prostředí, naučí samostatnosti.',
				'image_uri' => get_stylesheet_directory_uri() . "/images/testimonial1.jpg"
			);
		} else {
			$testimonial_content[ $zerif_lite_counter ] = array(
                'title'     => 'Jiří Menzel',
                'text'      => 'Nějak se nám víc a víc nejrůznějšími cestami vtlouká do hlavy, že si každý mladý člověk musí po vzoru těch filmových a seriálových hrdinů své místo na slunci vydobýt sám, a to třeba i na úkor ostatních. Ve skautu, nebo jak nás pokřtili přátelé českého jazyka, v Junáku, jsme byli soudržnější a učili se věrnosti a smyslu pro solidaritu. Bylo nám vštěpeno, že nejsme na světě jenom pro sebe, ale jsme v rytířském duchu mušketýrů „Jeden za všechny, všichni za jednoho“. Všeobecně se má za to, že skauting vychovává mladé duše k úctě k přírodě, k šetrnosti k životnímu prostředí, naučí samostatnosti.',
                'image_uri' => get_template_directory_uri() . "/images/testimonial1.jpg"
			);
		}

		update_option( 'widget_zerif_testim-widget', $testimonial_content );

		$zerif_lite_counter ++;

		/* testimonial widget #2 */

		$active_widgets['sidebar-testimonials'][] = 'zerif_testim-widget-' . $zerif_lite_counter;

		if ( file_exists( get_stylesheet_directory() . '/images/testimonial2.jpg' ) ) {
			$testimonial_content[ $zerif_lite_counter ] = array(
				'title'     => 'Václav Havel',
				'text'      => 'Rád vzpomínám na dobu, kdy jsem se svým skautským oddílem také sjížděl řeky a prožíval podobná dobrodružství jako vy. Vím, co vše pro vás skauting znamená, a raduji se z toho, že jeho myšlenky jsou stále aktuální a oslovují mladé lidi.',
				'image_uri' => get_stylesheet_directory_uri() . "/images/testimonial2.jpg"
			);
		} else {
			$testimonial_content[ $zerif_lite_counter ] = array(
                'title'     => 'Václav Havel',
                'text'      => 'Rád vzpomínám na dobu, kdy jsem se svým skautským oddílem také sjížděl řeky a prožíval podobná dobrodružství jako vy. Vím, co vše pro vás skauting znamená, a raduji se z toho, že jeho myšlenky jsou stále aktuální a oslovují mladé lidi.',
                'image_uri' => get_template_directory_uri() . "/images/testimonial2.jpg"
			);
		}

		update_option( 'widget_zerif_testim-widget', $testimonial_content );

		$zerif_lite_counter ++;

		/* testimonial widget #3 */

		$active_widgets['sidebar-testimonials'][] = 'zerif_testim-widget-' . $zerif_lite_counter;

		if ( file_exists( get_stylesheet_directory() . '/images/testimonial3.jpg' ) ) {
			$testimonial_content[ $zerif_lite_counter ] = array(
				'title'     => 'Eva Holubová',
				'text'      => 'Forma skautingu je jenom hra. Způsob, jak se dostat k těm důležitým věcem, které skauting obsahuje. Dostat se k sounáležitosti, k pokoře a k tomu myslet na bližního stejně, jako na sebe samého. Takhle jsem skauting cítila…',
				'image_uri' => get_stylesheet_directory_uri() . "/images/testimonial3.jpg"
			);
		} else {
			$testimonial_content[ $zerif_lite_counter ] = array(
                'title'     => 'Eva Holubová',
                'text'      => 'Forma skautingu je jenom hra. Způsob, jak se dostat k těm důležitým věcem, které skauting obsahuje. Dostat se k sounáležitosti, k pokoře a k tomu myslet na bližního stejně, jako na sebe samého. Takhle jsem skauting cítila…',
                'image_uri' => get_template_directory_uri() . "/images/testimonial3.jpg"
			);
		}

		update_option( 'widget_zerif_testim-widget', $testimonial_content );

		$zerif_lite_counter ++;

		update_option( 'sidebars_widgets', $active_widgets );
	}

	/**
	 * Populate the Our team sidebar
	 */
	if ( empty ( $active_widgets[ $zerif_lite_sidebars['sidebar-ourteam'] ] ) ) {

		$zerif_lite_counter = 1;

		/* our team widget #1 */

		$active_widgets['sidebar-ourteam'][0] = 'zerif_team-widget-' . $zerif_lite_counter;

		$ourteam_content[ $zerif_lite_counter ] = array(
			'name'        => 'Jana Nováková',
			'position'    => 'Vedoucí střediska',
			'description' => '',
			'fb_link'     => '',
			'tw_link'     => '',
			'bh_link'     => '',
			'db_link'     => '',
			'ln_link'     => '',
			'image_uri'   => get_template_directory_uri() . "/images/team1.png"
		);

		update_option( 'widget_zerif_team-widget', $ourteam_content );

		$zerif_lite_counter ++;

		/* our team widget #2 */

		$active_widgets['sidebar-ourteam'][] = 'zerif_team-widget-' . $zerif_lite_counter;

		$ourteam_content[ $zerif_lite_counter ] = array(
            'name'        => 'Karel Svoboda',
            'position'    => 'Zástupce vedoucí střediska',
            'description' => '',
            'fb_link'     => '',
            'tw_link'     => '',
            'bh_link'     => '',
            'db_link'     => '',
            'ln_link'     => '',
			'image_uri'   => get_template_directory_uri() . "/images/team2.png"
		);

		update_option( 'widget_zerif_team-widget', $ourteam_content );

		$zerif_lite_counter ++;

		/* our team widget #3 */

		$active_widgets['sidebar-ourteam'][] = 'zerif_team-widget-' . $zerif_lite_counter;

		$ourteam_content[ $zerif_lite_counter ] = array(
            'name'        => 'Lenka Novotná',
            'position'    => 'Vedoucí skautek',
            'description' => '',
            'fb_link'     => '',
            'tw_link'     => '',
            'bh_link'     => '',
            'db_link'     => '',
            'ln_link'     => '',
			'image_uri'   => get_template_directory_uri() . "/images/team3.png"
		);

		update_option( 'widget_zerif_team-widget', $ourteam_content );

		$zerif_lite_counter ++;

		/* our team widget #4 */

		$active_widgets['sidebar-ourteam'][] = 'zerif_team-widget-' . $zerif_lite_counter;

		$ourteam_content[ $zerif_lite_counter ] = array(
            'name'        => 'Pepa Dvořák',
            'position'    => 'Vedoucí skautů',
            'description' => '',
            'fb_link'     => '',
            'tw_link'     => '',
            'bh_link'     => '',
            'db_link'     => '',
            'ln_link'     => '',
			'image_uri'   => get_template_directory_uri() . "/images/team4.png"
		);

		update_option( 'widget_zerif_team-widget', $ourteam_content );

		$zerif_lite_counter ++;

		update_option( 'sidebars_widgets', $active_widgets );
	}

	update_option( 'themeisle_companion_flag', 'installed' );

}

/**
 * Register Zerif Widgets
 */
function themeisle_register_widgets() {

	register_widget( 'zerif_ourfocus' );
	register_widget( 'zerif_testimonial_widget' );
	register_widget( 'zerif_clients_widget' );
	register_widget( 'zerif_team_widget' );

	$theme = wp_get_theme();

	/* Populate the sidebar only for Zerif Lite */
	if ( 'Zerif Lite' == $theme->name || 'Zerif Lite' == $theme->parent_theme ) {

		$themeisle_companion_flag = get_option( 'themeisle_companion_flag' );
		if ( empty( $themeisle_companion_flag ) && function_exists( 'scout_populate_with_default_widgets' ) ) {
			scout_populate_with_default_widgets();
		}

        if ( empty( $themeisle_companion_flag ) && function_exists( 'scout_populate_custom_text' ) ) {
            scout_populate_custom_text();
        }
	}
}

add_action( 'widgets_init', 'themeisle_register_widgets' );

/* Require The Widget Files */
require_once THEMEISLE_COMPANION_PATH . 'inc/zerif-lite/widgets/widget-focus.php';
require_once THEMEISLE_COMPANION_PATH . 'inc/zerif-lite/widgets/widget-testimonial.php';
require_once THEMEISLE_COMPANION_PATH . 'inc/zerif-lite/widgets/widget-clients.php';
require_once THEMEISLE_COMPANION_PATH . 'inc/zerif-lite/widgets/widget-team.php';
