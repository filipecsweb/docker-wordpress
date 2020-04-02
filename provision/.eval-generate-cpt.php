<?php
/**
 * Generates a CPT and its dependent files.
 *
 * Arguments:
 * single, archive, loop
 *
 * Dependencies:
 * Controller SingleCpt.
 * Controller ArchiveCpt.
 * Controller LoopCpt.
 * template archive/template-cpt.
 * template single/template-cpt.
 * partial loop/cpt/layout-default.
 */

$args = $args ?? [];

foreach ( $args as $arg ) {
	if ( strpos( $arg, 'slug=' ) !== false ) {
		$slug      = str_replace( 'slug=', '', $arg );
		$camelSlug = str_replace( ' ', '', ucwords( str_replace( '_', ' ', $slug ) ) );
		break;
	}
}

//_var_dump( $camelSlug );
//exit;

if ( empty( $slug ) ) {
	echo 'Argument slug is missing. Set your slug the following way: "slug=my-slug" w/o the quotes.' . "\n";

	exit;
}

$cpt_dir             = STYLESHEETPATH . '/app/cpt';
$controllers_dir     = STYLESHEETPATH . '/app/Controllers';
$loop_dir            = STYLESHEETPATH . '/partials/loop';
$templates_parts_dir = STYLESHEETPATH . '/template-parts';
$cpt_model           = "$cpt_dir/.model.php";

copy( $cpt_model, "$cpt_dir/$slug.php" );

if ( in_array( 'archive', $args ) ) {
	$original = file_get_contents( "$controllers_dir/ArchiveModel.php" );
	$custom   = str_replace( 'Model', $camelSlug, $original );
	$custom   = str_replace( 'model', $slug, $custom );

	file_put_contents( "$controllers_dir/Archive{$camelSlug}.php", $custom );

	$original = file_get_contents( "$templates_parts_dir/archive/template-model.php" );
	$custom   = str_replace( 'Model', $camelSlug, $original );
	$custom   = str_replace( 'model', $slug, $custom );

	file_put_contents( "$templates_parts_dir/archive/template-$slug.php", $custom );
}

if ( in_array( 'loop', $args ) ) {
	$original = file_get_contents( "$controllers_dir/LoopModel.php" );
	$custom   = str_replace( 'Model', $camelSlug, $original );
	$custom   = str_replace( 'model', $slug, $custom );

	file_put_contents( "$controllers_dir/Loop{$camelSlug}.php", $custom );

	$original = file_get_contents( "$loop_dir/layout-model.php" );
	$custom   = str_replace( 'Model', $camelSlug, $original );
	$custom   = str_replace( 'model', $slug, $custom );

	if ( ! is_dir( "$loop_dir/$slug" ) ) {
		mkdir( "$loop_dir/$slug" );
	}

	file_put_contents( "$loop_dir/$slug/layout-default.php", $custom );
}

if ( in_array( 'single', $args ) ) {
	$original = file_get_contents( "$controllers_dir/SingleModel.php" );
	$custom   = str_replace( 'Model', $camelSlug, $original );
	$custom   = str_replace( 'model', $slug, $custom );

	file_put_contents( "$controllers_dir/Single{$camelSlug}.php", $custom );

	$original = file_get_contents( "$templates_parts_dir/single/template-model.php" );
	$custom   = str_replace( 'Model', $camelSlug, $original );
	$custom   = str_replace( 'model', $slug, $custom );

	file_put_contents( "$templates_parts_dir/single/template-$slug.php", $custom );
}
