<?php
/**
 * Author variable replacer.
 *
 * @since      0.3.0
 * @package    Classic_SEO
 * @subpackage Classic_SEO\Replace_Variables
 */


namespace Classic_SEO\Replace_Variables;

defined( 'ABSPATH' ) || exit;

/**
 * Author_Variables class.
 */
class Author_Variables extends Term_Variables {

	/**
	 * Hold counter variable data.
	 *
	 * @var array
	 */
	protected $counters = [];

	/**
	 * Setup author variables.
	 */
	public function setup_author_variables() {
		$user_id = get_current_user_id();
		if ( $this->is_post_edit ) {
			$post   = $this->get_post();
			$author = get_userdata( $post->post_author );
		}

		$this->register_replacement(
			'userid',
			[
				'name'        => esc_html__( 'Author ID', 'cpseo' ),
				'description' => esc_html__( 'Author\'s user id of the current post, page or author archive.', 'cpseo' ),
				'variable'    => 'userid',
				'example'     => $this->is_post_edit ? $post->post_author : $user_id,
			],
			[ $this, 'get_userid' ]
		);

		$this->register_replacement(
			'name',
			[
				'name'        => esc_html__( 'Post Author', 'cpseo' ),
				'description' => esc_html__( 'Display author\'s nicename of the current post, page or author archive.', 'cpseo' ),
				'variable'    => 'name',
				'example'     => $this->is_post_edit && $author ? $author->display_name : get_the_author_meta( 'display_name', $user_id ),
			],
			[ $this, 'get_name' ]
		);

		$this->register_replacement(
			'user_description',
			[
				'name'        => esc_html__( 'Author Description', 'cpseo' ),
				'description' => esc_html__( 'Author\'s biographical info of the current post, page or author archive.', 'cpseo' ),
				'variable'    => 'user_description',
				'example'     => get_the_author_meta( 'description', $user_id ),
			],
			[ $this, 'get_user_description' ]
		);
	}

	/**
	 * Get the post author's user ID to use as a replacement.
	 *
	 * @return string
	 */
	public function get_userid() {
		return ! empty( $this->args->post_author ) ? $this->args->post_author : get_query_var( 'author' );
	}

	/**
	 * Get the post author's "nice name" to use as a replacement.
	 *
	 * @return string|null
	 */
	public function get_name() {
		$user_id = $this->get_userid();
		$name    = get_the_author_meta( 'display_name', $user_id );

		return '' !== $name ? $name : null;
	}

	/**
	 * Get the post author's user description to use as a replacement.
	 *
	 * @return string|null
	 */
	public function get_user_description() {
		$user_id     = $this->get_userid();
		$description = get_the_author_meta( 'description', $user_id );

		return '' !== $description ? $description : null;
	}
}
