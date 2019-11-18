<?php
/**
 * Displays the post header
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since 1.0.0
 */

$discussion = ! is_page() && twentynineteen_can_show_post_thumbnail() ? twentynineteen_get_discussion_data() : null; ?>

<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

<?php if ( ! is_page() ) : ?>
<div class="entry-meta">
	<?php twentynineteen_posted_by(); ?>
	<?php twentynineteen_posted_on(); ?>
	<span class="comment-count">
		<?php
		if ( ! empty( $discussion ) ) {
			twentynineteen_discussion_avatars_list( $discussion->authors );
		}
		?>
		<?php twentynineteen_comment_count(); ?>
	</span>
	<?php
	// Edit post link.
		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Post title. Only visible to screen readers. */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'twentynineteen' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			),
			'<span class="edit-link">' . twentynineteen_get_icon_svg( 'edit', 16 ),
			'</span>'
		);
	?>
	<?php 
		$release_date_value = esc_html( rwmb_meta( 'release-date' ) );

		if (!empty($release_date_value)) {
			$release_date_time_string = '<div><span class="release-date">Release Date: <time>%1$s</time></span></div>';
			$release_date_time_string = sprintf( $release_date_time_string, date('F j, Y', $release_date_value) );
			echo $release_date_time_string;
		}
		//m dd, y
	?>
	<?php 
		$values = rwmb_meta( 'contact-information' );
		$contacts = '';
		foreach ( $values as $value ) {
			$contact_name =  esc_html($value['name']);
			$contact_phone = esc_html($value['phone']);
			$contact_email =  esc_html($value['email']);

			$contact_string = '';
			if (!empty($contact_name)) {
				$contact_string .= sprintf('<span class="contact_name">Contact Name: %1$s</span><br>',$contact_name);
			}
			if (!empty($contact_email)) {
				$contact_string .= sprintf('<span class="contact_email">Contact Email: %1$s</span><br>',$contact_email);
			}
			if (!empty($contact_phone)) {
				$contact_string .= sprintf('<span class="contact_phone">Contact Phone: %1$s</span><br>',$contact_phone);
			}

			if (!empty($contact_string)) {
				$contacts .= sprintf('<div class="contact-item"><div>%1$s</div></div>',$contact_string);
			}
		}
		if (!empty($contacts)) {
			echo sprintf('<div class="contact-info">%1$s</div>',$contacts);
		}
	?>
</div><!-- .entry-meta -->
<?php endif; ?>
