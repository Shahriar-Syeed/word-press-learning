<?php

/**
 * PHP file to use when rendering the block type on the server to show on the front end.
 *
 * The following variables are exposed to the file:
 *     $attributes (array): The block attributes.
 *     $content (string): The block default content.
 *     $block (WP_Block): The block instance.
 *
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */
?>
<div style="background-color: <?php echo $attributes['bgColor'] ?>;" class="multiple-choice-frontend" data-wp-interactive="create-block" data-wp-context='{"clickCount": 0}'>
	<p>The button has been clicked <span data-wp-text="context.clickCount"></span> times.</p>
	<button data-wp-on--click="actions.buttonHandler">Click me</button>
	<!-- <p><?php echo $attributes['question'] ?></p>
	<ul>
		<li>Answer 1</li>
		<li>Answer 2</li>
		<li>Answer 3</li>
	</ul> -->
</div>