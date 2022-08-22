<?php
/**
 * Plugin Name: UBC Profiles Layouts
 * Plugin URI:
 * Description: Block Layouts (templates, patterns, styles etc.) to help folks who are migrating from the profiles CCT plugin
 * Version: 1.0.0
 * Author: Rich Tape
 * Author URI: http://cms.ubc.ca
 *
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU
 * General Public License as published by the Free Software Foundation; either version 2 of the License,
 * or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * You should have received a copy of the GNU General Public License along with this program; if not, write
 * to the Free Software Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
 *
 * @package UBC PRofiles Layouts
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

/**
 * Register our block pattern category for profiles.
 *
 * @since 1.0.0
 */
function ubc_profiles_layouts_register_pattern_category() {

	register_block_pattern_category(
		'ubcprofiles',
		array( 'label' => __( 'Profiles', 'ubc-profiles-layouts' ) )
	);

}//end ubc_profiles_layouts_register_pattern_category()

add_action( 'init', 'ubc_profiles_layouts_register_pattern_category' );

/**
 * Register our block patterns for profiles.
 *
 * @since 1.0.0
 */
function ubc_profiles_layouts_register_patterns() {

	register_block_pattern(
		'ubc-profiles-layouts/basic-profile-grid-image-title',
		array(
			'title'       => __( 'Basic Profile Grid', 'ubc-profiles-layouts' ),
			'description' => _x( '9 profile posts from the staff category displayed in a 3x3 grid, each which show the featured images and the title. Includes pagination.', 'Block pattern description', 'ubc-profiles-layouts' ),
			'content'     => '
<!-- wp:query {"queryId":0,"query":{"perPage":"9","pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false,"taxQuery":{"category":[9]}},"displayLayout":{"type":"flex","columns":3}} -->
<div class="wp-block-query"><!-- wp:post-template -->
<!-- wp:post-featured-image {"isLink":true} /-->

<!-- wp:post-title {"isLink":true} /-->
<!-- /wp:post-template -->

<!-- wp:query-pagination {"paginationArrow":"arrow","className":"profiles-navigation","layout":{"type":"flex","justifyContent":"center","flexWrap":"nowrap"}} -->
<!-- wp:query-pagination-previous /-->

<!-- wp:query-pagination-numbers /-->

<!-- wp:query-pagination-next /-->
<!-- /wp:query-pagination -->

<!-- wp:query-no-results -->
<!-- wp:paragraph {"placeholder":"Add text or blocks that will display when the query returns no results."} -->
<p>No profiles are available.</p>
<!-- /wp:paragraph -->
<!-- /wp:query-no-results --></div>
<!-- /wp:query -->
',
			'categories'  => array( 'ubcprofiles' ),
			'postTypes'   => array( 'post', 'page' ),
			'keywords'    => array( 'profile', 'people', 'profiles' ),
		)
	);

	register_block_pattern(
		'ubc-profiles-layouts/columns-image-and-title-tags-excerpt',
		array(
			'title'       => __( 'One Per Row, Image on left.', 'ubc-profiles-layouts' ),
			'description' => _x( 'Each profile is on its own row and split into columns with the image on the left, and name, tags, and excerpt on the right.', 'Block pattern description', 'ubc-profiles-layouts' ),
			'content'     => '
<!-- wp:query {"queryId":0,"query":{"perPage":"10","pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false}} -->
<div class="wp-block-query"><!-- wp:post-template -->
<!-- wp:columns -->
<div class="wp-block-columns"><!-- wp:column {"width":"30%"} -->
<div class="wp-block-column" style="flex-basis:30%"><!-- wp:post-featured-image {"isLink":true} /--></div>
<!-- /wp:column -->

<!-- wp:column {"width":"70%"} -->
<div class="wp-block-column" style="flex-basis:70%"><!-- wp:post-title {"isLink":true} /-->

<!-- wp:post-terms {"term":"post_tag"} /-->

<!-- wp:post-excerpt {"moreText":"View Profile"} /--></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->
<!-- /wp:post-template -->

<!-- wp:query-pagination {"paginationArrow":"arrow","layout":{"type":"flex","justifyContent":"center","flexWrap":"nowrap"}} -->
<!-- wp:query-pagination-previous /-->

<!-- wp:query-pagination-numbers /-->

<!-- wp:query-pagination-next /-->
<!-- /wp:query-pagination -->

<!-- wp:query-no-results -->
<!-- wp:paragraph {"placeholder":"Add text or blocks that will display when the query returns no results."} -->
<p></p>
<!-- /wp:paragraph -->
<!-- /wp:query-no-results --></div>
<!-- /wp:query -->
			',
			'categories'  => array( 'ubcprofiles' ),
			'postTypes'   => array( 'post', 'page' ),
			'keywords'    => array( 'profile', 'people', 'profiles' ),
		)
	);

}//end ubc_profiles_layouts_register_patterns()

add_action( 'init', 'ubc_profiles_layouts_register_patterns', 12 );
