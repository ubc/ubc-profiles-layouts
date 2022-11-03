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

add_action( 'init', 'ubc_profiles_layouts_unregister_core_query_patterns', 11 );

/**
 * Unregister the WP Core block patterns for the query loop.
 *
 * @since 1.0.0
 */
function ubc_profiles_layouts_unregister_core_query_patterns() {

	$patterns_to_remove = array(
		'core/query-standard-posts',
		'core/query-standard-posts',
		'core/query-medium-posts',
		'core/query-small-posts',
		'core/query-grid-posts',
		'core/query-large-title-posts',
		'core/query-offset-posts',
	);

	foreach ( $patterns_to_remove as $id => $pattern_name ) {
		unregister_block_pattern( $pattern_name );
	}

}//end ubc_profiles_layouts_unregister_core_query_patterns()


add_action( 'init', 'ubc_profiles_register_profiles_block_pattern_category' );

/**
 * Register our Profiles Patterns Category.
 */
function ubc_profiles_register_profiles_block_pattern_category() {
	register_block_pattern_category( 'profiles', array(
		'label' => __( 'Profiles', 'ubc-profiles-layout' )
	) );
}//end ubc_profiles_register_profiles_block_pattern_category()



add_action( 'init', 'ubc_profiles_layouts_register_patterns', 8 );

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
<!-- wp:query {"queryId":0,"query":{"perPage":"9","pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"title","author":"","search":"","exclude":[],"sticky":"","inherit":false,"taxQuery":{"category":[9]}},"displayLayout":{"type":"flex","columns":3}} -->
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
			'categories'  => array( 'query', 'profiles' ),
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
<!-- wp:query {"queryId":0,"query":{"perPage":"10","pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"title","author":"","search":"","exclude":[],"sticky":"","inherit":false}} -->
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
			'categories'  => array( 'query', 'profiles' ),
			'postTypes'   => array( 'post', 'page' ),
			'keywords'    => array( 'profile', 'people', 'profiles' ),
		)
	);

	register_block_pattern(
		'ubc-profiles-layouts/profile-grid-with-cover-block',
		array(
			'title'       => __( 'Profile Grid with Cover Block', 'ubc-profiles-layouts' ),
			'description' => _x( 'Each person has their profile photo used in a cover block with their name placed on top. Name is placed near the bottom.', 'Block pattern description', 'ubc-profiles-layouts' ),
			'content'     => '
<!-- wp:query {"queryId":0,"query":{"perPage":"9","pages":0,"offset":0,"postType":"post","order":"asc","orderBy":"title","author":"","search":"","exclude":[],"sticky":"","inherit":false,"taxQuery":{"category":[9]}},"displayLayout":{"type":"flex","columns":3}} -->
<div class="wp-block-query"><!-- wp:post-template -->
<!-- wp:cover {"useFeaturedImage":true,"dimRatio":60,"overlayColor":"ubc-black","minHeight":25,"minHeightUnit":"vh","contentPosition":"bottom center","className":"ubc-profiles-with-cover"} -->
<div class="wp-block-cover has-custom-content-position is-position-bottom-center ubc-profiles-with-cover" style="min-height:25vh"><span aria-hidden="true" class="wp-block-cover__background has-ubc-black-background-color has-background-dim-60 has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:post-title {"isLink":true} /--></div></div>
<!-- /wp:cover -->
<!-- /wp:post-template -->

<!-- wp:query-pagination {"paginationArrow":"arrow","layout":{"type":"flex","justifyContent":"center"}} -->
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
			'categories'  => array( 'query', 'profiles' ),
			'postTypes'   => array( 'post', 'page' ),
			'keywords'    => array( 'profile', 'people', 'profiles' ),
		)
	);

	register_block_pattern(
		'ubc-profiles-layouts/person-profile-with-photo-and-tabs',
		array(
			'title'       => __( 'Inidividual Photo with Tabs', 'ubc-profiles-layouts' ),
			'description' => _x( 'A single person\'s profile which has their photo, details, and tabs with their scholatstic details.', 'Block pattern description', 'ubc-profiles-layouts' ),
			'content'     => '
<!-- wp:group {"className":"ubc-profile-photo-details-tabs"} -->
<div class="wp-block-group ubc-profile-photo-details-tabs"><!-- wp:columns -->
<div class="wp-block-columns"><!-- wp:column {"width":"30%"} -->
<div class="wp-block-column" style="flex-basis:30%"><!-- wp:post-featured-image /--></div>
<!-- /wp:column -->

<!-- wp:column {"width":"2%"} -->
<div class="wp-block-column" style="flex-basis:2%"></div>
<!-- /wp:column -->

<!-- wp:column {"width":"68%"} -->
<div class="wp-block-column" style="flex-basis:68%"><!-- wp:heading -->
<h2>Associate Professor</h2>
<!-- /wp:heading -->

<!-- wp:group -->
<div class="wp-block-group"><!-- wp:paragraph -->
<p>Email: firstname.lastname@ubc.ca</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Office: Scarfe 123</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Office Hours: Tues 10:00-1100, Wed 14:00-15:00</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><a href="https://docs.google.ca/some.pdf">View Curriculum Vitae (pdf)</a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:social-links {"iconColor":"ubc-blue","iconColorValue":"#002145","className":"is-style-logos-only"} -->
<ul class="wp-block-social-links has-icon-color is-style-logos-only"><!-- wp:social-link {"url":"https://twitter.com/ubc","service":"twitter","label":"Twitter Account"} /-->

<!-- wp:social-link {"url":"https://scholar.google.com/person","service":"google"} /--></ul>
<!-- /wp:social-links --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:ubc/tabs {"tabTitles":["Biography","Degrees","Expertise","Awards","Presentations","Publications","Grad Students","Courses"],"className":"is-style-clf"} -->
<section class="wp-block-ubc-tabs ubc-accordion-tabs is-style-clf" data-selected-tab="0"><ul class="ubc-accordion-tabs__tab-list" role="tablist"><li id="biography" role="presentation"><a role="tab" id="biography" aria-controls="section1 " aria-selected="true" class="ubc-accordion-tabs__tabs-trigger js-tabs-trigger" href="#section1">Biography</a></li><li id="degrees" role="presentation"><a role="tab" id="degrees" aria-controls="section2 " aria-selected="false" class="ubc-accordion-tabs__tabs-trigger js-tabs-trigger" href="#section2">Degrees</a></li><li id="expertise" role="presentation"><a role="tab" id="expertise" aria-controls="section3 " aria-selected="false" class="ubc-accordion-tabs__tabs-trigger js-tabs-trigger" href="#section3">Expertise</a></li><li id="awards" role="presentation"><a role="tab" id="awards" aria-controls="section4 " aria-selected="false" class="ubc-accordion-tabs__tabs-trigger js-tabs-trigger" href="#section4">Awards</a></li><li id="presentations" role="presentation"><a role="tab" id="presentations" aria-controls="section5 " aria-selected="false" class="ubc-accordion-tabs__tabs-trigger js-tabs-trigger" href="#section5">Presentations</a></li><li id="publications" role="presentation"><a role="tab" id="publications" aria-controls="section6 " aria-selected="false" class="ubc-accordion-tabs__tabs-trigger js-tabs-trigger" href="#section6">Publications</a></li><li id="grad-students" role="presentation"><a role="tab" id="grad-students" aria-controls="section7 " aria-selected="false" class="ubc-accordion-tabs__tabs-trigger js-tabs-trigger" href="#section7">Grad Students</a></li><li id="courses" role="presentation"><a role="tab" id="courses" aria-controls="section8 " aria-selected="false" class="ubc-accordion-tabs__tabs-trigger js-tabs-trigger" href="#section8">Courses</a></li></ul><!-- wp:ubc/tab {"index":0,"title":"Biography"} -->
<section index="1" class="wp-block-ubc-tab ubc-accordion-tabs__tabs-panel js-tabs-panel active" id="section1" role="tabpanel" aria-labelledby="tab1"><div class="ubc-accordion-tabs__accordion-trigger js-accordeon-trigger" aria-controls="section1" tabindex="0">Biography<div class="ubc-accordion-tabs__accordion-trigger-icon"><span class="label--open">Open</span><span class="label--close">Close</span><svg aria-hidden="true" focusable="false" viewBox="0 0 20 20"><rect class="vert" height="18" width="2" fill="currentColor" y="1" x="9"></rect><rect height="2" width="18" fill="currentColor" y="9" x="1"></rect></svg></div></div><div class="content"><!-- wp:paragraph -->
<p>Consed quo molum quidita as voluptia sequam, coreptate am, con rem accum fuga. Moluptur?<br>Serchic atius, comnimusaes dolo quibusda prorporror as et ellamentur sequam quas molorro vitatat. Olest, con cum re ne et, quatium facerum am, sunti derum autem et esciet labo. Itatior aut ut est hari- busam, soluptatur aut etusape ruptate cusam, quat rate rem venietur, experi offictati quid utendus ma quid que solenest aut pliqui di doluptam quam aria doloratquis volorepel ipsae. Ita porit ped maximod explaut latet aditia cume quam eaqui occulla borias doluptur, to con cum ea ium non re, ute molores tionse volupid ut pra et autet illuptate velecti oribusci nectincia sunt a id eum ditiist, consedi genihil magnimil iur? Qui aut landa sequuntur sunti unt volupta tibus, sus dit, veliqui atinus alibus sum in prore num vit, torepelibus et aut eos ut mincien imusam aruntiunt dolupit hari am eum fugit autecta turempos endelent rendus, quae nimusant aut labo. Epero</p>
<!-- /wp:paragraph --></div></section>
<!-- /wp:ubc/tab -->

<!-- wp:ubc/tab {"index":1,"title":"Degrees"} -->
<section index="2" class="wp-block-ubc-tab ubc-accordion-tabs__tabs-panel js-tabs-panel" id="section2" role="tabpanel" aria-labelledby="tab2"><div class="ubc-accordion-tabs__accordion-trigger js-accordeon-trigger" aria-controls="section2" tabindex="0">Degrees<div class="ubc-accordion-tabs__accordion-trigger-icon"><span class="label--open">Open</span><span class="label--close">Close</span><svg aria-hidden="true" focusable="false" viewBox="0 0 20 20"><rect class="vert" height="18" width="2" fill="currentColor" y="1" x="9"></rect><rect height="2" width="18" fill="currentColor" y="9" x="1"></rect></svg></div></div><div class="content"><!-- wp:list -->
<ul><li>Lorem Ipsum(hons) dolor sit</li><li>Amet (hons) per secitum</li></ul>
<!-- /wp:list --></div></section>
<!-- /wp:ubc/tab -->

<!-- wp:ubc/tab {"index":2,"title":"Expertise"} -->
<section index="3" class="wp-block-ubc-tab ubc-accordion-tabs__tabs-panel js-tabs-panel" id="section3" role="tabpanel" aria-labelledby="tab3"><div class="ubc-accordion-tabs__accordion-trigger js-accordeon-trigger" aria-controls="section3" tabindex="0">Expertise<div class="ubc-accordion-tabs__accordion-trigger-icon"><span class="label--open">Open</span><span class="label--close">Close</span><svg aria-hidden="true" focusable="false" viewBox="0 0 20 20"><rect class="vert" height="18" width="2" fill="currentColor" y="1" x="9"></rect><rect height="2" width="18" fill="currentColor" y="9" x="1"></rect></svg></div></div><div class="content"></div></section>
<!-- /wp:ubc/tab -->

<!-- wp:ubc/tab {"index":3,"title":"Awards"} -->
<section index="4" class="wp-block-ubc-tab ubc-accordion-tabs__tabs-panel js-tabs-panel" id="section4" role="tabpanel" aria-labelledby="tab4"><div class="ubc-accordion-tabs__accordion-trigger js-accordeon-trigger" aria-controls="section4" tabindex="0">Awards<div class="ubc-accordion-tabs__accordion-trigger-icon"><span class="label--open">Open</span><span class="label--close">Close</span><svg aria-hidden="true" focusable="false" viewBox="0 0 20 20"><rect class="vert" height="18" width="2" fill="currentColor" y="1" x="9"></rect><rect height="2" width="18" fill="currentColor" y="9" x="1"></rect></svg></div></div><div class="content"></div></section>
<!-- /wp:ubc/tab -->

<!-- wp:ubc/tab {"index":4,"title":"Presentations"} -->
<section index="5" class="wp-block-ubc-tab ubc-accordion-tabs__tabs-panel js-tabs-panel" id="section5" role="tabpanel" aria-labelledby="tab5"><div class="ubc-accordion-tabs__accordion-trigger js-accordeon-trigger" aria-controls="section5" tabindex="0">Presentations<div class="ubc-accordion-tabs__accordion-trigger-icon"><span class="label--open">Open</span><span class="label--close">Close</span><svg aria-hidden="true" focusable="false" viewBox="0 0 20 20"><rect class="vert" height="18" width="2" fill="currentColor" y="1" x="9"></rect><rect height="2" width="18" fill="currentColor" y="9" x="1"></rect></svg></div></div><div class="content"></div></section>
<!-- /wp:ubc/tab -->

<!-- wp:ubc/tab {"index":5,"title":"Publications"} -->
<section index="6" class="wp-block-ubc-tab ubc-accordion-tabs__tabs-panel js-tabs-panel" id="section6" role="tabpanel" aria-labelledby="tab6"><div class="ubc-accordion-tabs__accordion-trigger js-accordeon-trigger" aria-controls="section6" tabindex="0">Publications<div class="ubc-accordion-tabs__accordion-trigger-icon"><span class="label--open">Open</span><span class="label--close">Close</span><svg aria-hidden="true" focusable="false" viewBox="0 0 20 20"><rect class="vert" height="18" width="2" fill="currentColor" y="1" x="9"></rect><rect height="2" width="18" fill="currentColor" y="9" x="1"></rect></svg></div></div><div class="content"></div></section>
<!-- /wp:ubc/tab -->

<!-- wp:ubc/tab {"index":6,"title":"Grad Students"} -->
<section index="7" class="wp-block-ubc-tab ubc-accordion-tabs__tabs-panel js-tabs-panel" id="section7" role="tabpanel" aria-labelledby="tab7"><div class="ubc-accordion-tabs__accordion-trigger js-accordeon-trigger" aria-controls="section7" tabindex="0">Grad Students<div class="ubc-accordion-tabs__accordion-trigger-icon"><span class="label--open">Open</span><span class="label--close">Close</span><svg aria-hidden="true" focusable="false" viewBox="0 0 20 20"><rect class="vert" height="18" width="2" fill="currentColor" y="1" x="9"></rect><rect height="2" width="18" fill="currentColor" y="9" x="1"></rect></svg></div></div><div class="content"></div></section>
<!-- /wp:ubc/tab -->

<!-- wp:ubc/tab {"index":7,"title":"Courses"} -->
<section index="8" class="wp-block-ubc-tab ubc-accordion-tabs__tabs-panel js-tabs-panel" id="section8" role="tabpanel" aria-labelledby="tab8"><div class="ubc-accordion-tabs__accordion-trigger js-accordeon-trigger" aria-controls="section8" tabindex="0">Courses<div class="ubc-accordion-tabs__accordion-trigger-icon"><span class="label--open">Open</span><span class="label--close">Close</span><svg aria-hidden="true" focusable="false" viewBox="0 0 20 20"><rect class="vert" height="18" width="2" fill="currentColor" y="1" x="9"></rect><rect height="2" width="18" fill="currentColor" y="9" x="1"></rect></svg></div></div><div class="content"></div></section>
<!-- /wp:ubc/tab --></section>
<!-- /wp:ubc/tabs -->

<!-- wp:spacer {"height":"25px"} -->
<div style="height:25px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button {"backgroundColor":"ubc-blue","textColor":"ubc-white","style":{"border":{"radius":"4px"}}} -->
<div class="wp-block-button"><a class="wp-block-button__link has-ubc-white-color has-ubc-blue-background-color has-text-color has-background wp-element-button" href="/faculty/" style="border-radius:4px">View All Faculty</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons -->

<!-- wp:spacer {"height":"25px"} -->
<div style="height:25px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer --></div>
<!-- /wp:group -->
',
			'categories'  => array( 'query', 'profiles' ),
			'postTypes'   => array( 'post', 'page' ),
			'keywords'    => array( 'profile', 'people', 'profiles' ),
		)
	);

}//end ubc_profiles_layouts_register_patterns()



add_action( 'enqueue_block_assets', 'ubc_profiles_layouts_enqueue_stylesheet' );

/**
 * Register and enqueue the block patterns stylesheet.
 */
function ubc_profiles_layouts_enqueue_stylesheet() {

	wp_register_style( 'ubc-profiles-layouts', plugin_dir_url( __FILE__ ) . 'css/ubc-profiles-layouts.css' );
	wp_enqueue_style( 'ubc-profiles-layouts' );

}//end ubc_profiles_layouts_enqueue_stylesheet()
