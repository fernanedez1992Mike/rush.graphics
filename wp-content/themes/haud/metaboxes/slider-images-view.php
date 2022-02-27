<div>
	<draggable v-model="options.slider_images" class="images" v-bind:options="{ handle: 'img' }" element="ul">
		<li v-for='image in options.slider_images' :key="image">
			<img :src="image" width="100px;" class="draggable" />
			<a @click="options.slider_images.splice(options.slider_images.indexOf(image), 1)">X</a>
		</li>
	</draggable>
	<p>
		<blahlab-upload-image-to-collection @add="options.slider_images.push(arguments[0])"><?php esc_html_e('Upload Image', 'haud-by-honryou') ?></blahlab-upload-image-to-collection>
	</p>
</div>

<div class="inline-hide">
	<h3><?php esc_html_e('Slider background', 'haud-by-honryou') ?></h3>
	<ul class="images" v-if="options.slider_bg">
		<li>
			<img :src="options.slider_bg" width="100px;" />
			<a @click='options.slider_bg = null'>X</a>
		</li>
	</ul>
	<p>
		<blahlab-upload-image-to-collection @add="options.slider_bg = arguments[0]"><?php esc_html_e('Upload Image', 'haud-by-honryou') ?></blahlab-upload-image-to-collection>
	</p>
</div>

