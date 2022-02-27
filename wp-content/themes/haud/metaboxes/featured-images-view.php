<?php
	// *-spec.php is optional if you don't need to specify options for the metabox
	// *-view.php is always required
	// $blahlab_framework_mb->the_field('FILED_SLUG');
	// FIELD_SLUG could be any value
?>

<div>
	<div>
		<draggable v-model="options.featured_images" class="images" v-bind:options="{ handle: 'img' }" element="ul">
			<li v-for='image in options.featured_images' :key="image">
				<img :src="image" width="100px;" class="draggable" />
				<a @click="options.featured_images.splice(options.featured_images.indexOf(image), 1)">X</a>
			</li>
		</draggable>
	</div>

	<p>
		<blahlab-upload-image-to-collection @add="options.featured_images.push(arguments[0])"><?php esc_html_e('Upload Image', 'haud-by-honryou') ?></blahlab-upload-image-to-collection>
	</p>
</div>
