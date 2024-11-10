<?php
/**
 * @package Eventos_wpchallenge
 * @version 1.0.0
 */
/*
Plugin Name: Eventos_wpchallenge
 * Version: 1.0.0
 * Plugin URI: https://joaosantos.com
 * Description: Post type Eventos_wpchallenge
 * Author: JoaoSantos
 * Author URI: https://joaosantos.com
*/

add_action('init', 'load_plugin_eventos', 0);
function load_plugin_eventos()
{
	$labels = array(
		'name'                  => _x('Evento', 'Evento General Name', 'text_domain'),
		'singular_name'         => _x('Evento', 'Evento Singular Name', 'text_domain'),
		'menu_name'             => __('Eventos', 'text_domain'),
		'name_admin_bar'        => __('Evento', 'text_domain'),
		'archives'              => __('Arquivo de Evento', 'text_domain'),
		'attributes'            => __('Características de Evento', 'text_domain'),
		'parent_item_colon'     => __('Parent Evento:', 'text_domain'),
		'all_items'             => __('Todos os Eventos', 'text_domain'),
		'add_new_item'          => __('Adicionar Evento', 'text_domain'),
		'add_new'               => __('Adicionar Novo Evento', 'text_domain'),
		'new_item'              => __('Novo Evento', 'text_domain'),
		'edit_item'             => __('Editar Evento', 'text_domain'),
		'update_item'           => __('Atualizar Evento', 'text_domain'),
		'view_item'             => __('Ver Evento', 'text_domain'),
		'view_items'            => __('Ver Eventos', 'text_domain'),
		'search_items'          => __('Procurar Evento', 'text_domain'),
		'not_found'             => __('Not found', 'text_domain'),
		'not_found_in_trash'    => __('Not found in Trash', 'text_domain'),
		'featured_image'        => __('Featured Image', 'text_domain'),
		'set_featured_image'    => __('Set featured image', 'text_domain'),
		'remove_featured_image' => __('Remove featured image', 'text_domain'),
		'use_featured_image'    => __('Use as featured image', 'text_domain'),
		'insert_into_item'      => __('Insert into Evento', 'text_domain'),
		'uploaded_to_this_item' => __('Uploaded to this Evento', 'text_domain'),
		'items_list'            => __('Eventos list', 'text_domain'),
		'items_list_navigation' => __('Eventos list navigation', 'text_domain'),
		'filter_items_list'     => __('Filter Eventos list', 'text_domain'),
	);
	$args = array(
		'label'                 => __('Evento', 'text_domain'),
		'description'           => __('Evento Description', 'text_domain'),
		'labels'                => $labels,
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'show_in_rest'          => true,
		'supports'              => array('title', 'editor', 'thumbnail', 'excerpt'),
		'capability_type'       => 'page',
		'menu_icon'             => 'dashicons-format-aside'
	);
	register_post_type('evento', $args);
	$labels = array(
		'name'                       => _x('Categoria Evento', 'Categoria Evento General Name', 'spinerg'),
		'singular_name'              => _x('Categoria Evento', 'Categoria Evento Singular Name', 'spinerg'),
		'menu_name'                  => __('Categorias de Evento', 'spinerg'),
		'all_items'                  => __('All Categorias de Evento', 'spinerg'),
		'parent_item'                => __('Categoria Evento Item', 'spinerg'),
		'parent_item_colon'          => __('Categoria Evento Item:', 'spinerg'),
		'new_item_name'              => __('New Categoria Evento Name', 'spinerg'),
		'add_new_item'               => __('Add New Categoria Evento', 'spinerg'),
		'edit_item'                  => __('Edit Categoria Evento', 'spinerg'),
		'update_item'                => __('Update Categoria Evento', 'spinerg'),
		'view_item'                  => __('View Categoria Evento', 'spinerg'),
		'separate_items_with_commas' => __('Separate Categorias de Evento with commas', 'spinerg'),
		'add_or_remove_items'        => __('Add or remove Categorias de Evento', 'spinerg'),
		'choose_from_most_used'      => __('Choose from the most used', 'spinerg'),
		'popular_items'              => __('Popular Categorias de Evento', 'spinerg'),
		'search_items'               => __('Search Categorias de Evento', 'spinerg'),
		'not_found'                  => __('Not Found', 'spinerg'),
		'no_terms'                   => __('No Categorias de Evento', 'spinerg'),
		'items_list'                 => __('Categorias de Evento list', 'spinerg'),
		'items_list_navigation'      => __('Categorias de Evento list navigation', 'spinerg'),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_rest' 			     => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	// here we add/register taxonomies to post type
	register_taxonomy('tipo_evento', array('evento'), $args);
}

add_action('admin_enqueue_scripts', 'load_media_plugin_eventos');
function load_media_plugin_eventos()
{
	wp_enqueue_media();
}
/* add image do category */
add_action('tipo_evento_add_form_fields', 'add_category_image_plugin_eventos', 10, 2);
function add_category_image_plugin_eventos($taxonomy)
{
?>
	<div class="form-field term-group">
		<label for="image_id"><?php _e('Image', 'taxt-domain'); ?></label>
		<input type="hidden" id="image_id" name="image_id" class="custom_media_url" value="">
		<div id="image_wrapper"></div>
		<p>
			<input type="button" class="button button-secondary taxonomy_media_button" id="taxonomy_media_button" name="taxonomy_media_button" value="<?php _e('Add Image', 'taxt-domain'); ?>">
			<input type="button" class="button button-secondary taxonomy_media_remove" id="taxonomy_media_remove" name="taxonomy_media_remove" value="<?php _e('Remove Image', 'taxt-domain'); ?>">
		</p>

	</div>
<?php
}
add_action('created_tipo_evento', 'save_category_image_plugin_eventos', 10, 2);
function save_category_image_plugin_eventos($term_id, $tt_id)
{
	if (isset($_POST['image_id']) && '' !== $_POST['image_id']) {
		$image = $_POST['image_id'];
		add_term_meta($term_id, 'category_image_id', $image, true);
	}
}
add_action('tipo_evento_edit_form_fields', 'update_category_image_plugin_eventos', 10, 2);
function update_category_image_plugin_eventos($term, $taxonomy)
{ ?>
	<tr class="form-field term-group-wrap">
		<th scope="row">
			<label for="image_id"><?php _e('Image', 'taxt-domain'); ?></label>
		</th>
		<td>
			<?php $image_id = get_term_meta($term->term_id, 'image_id', true); ?>
			<input type="hidden" id="image_id" name="image_id" value="<?php echo $image_id; ?>">
			<div id="image_wrapper">
				<?php if ($image_id) { ?>
					<?php echo wp_get_attachment_image($image_id, 'thumbnail'); ?>
				<?php } ?>
			</div>
			<p>
				<input type="button" class="button button-secondary taxonomy_media_button" id="taxonomy_media_button" name="taxonomy_media_button" value="<?php _e('Add Image', 'taxt-domain'); ?>">
				<input type="button" class="button button-secondary taxonomy_media_remove" id="taxonomy_media_remove" name="taxonomy_media_remove" value="<?php _e('Remove Image', 'taxt-domain'); ?>">
			</p>
			</div>
		</td>
	</tr>
<?php
}
add_action('edited_tipo_evento', 'updated_category_image_plugin_eventos', 10, 2);
function updated_category_image_plugin_eventos($term_id, $tt_id)
{
	if (isset($_POST['image_id']) && '' !== $_POST['image_id']) {
		$image = $_POST['image_id'];
		update_term_meta($term_id, 'image_id', $image);
	} else {
		update_term_meta($term_id, 'image_id', '');
	}
}

add_action('admin_footer', 'add_custom_script_plugin_eventos');
function add_custom_script_plugin_eventos()
{
?> 
<script>
	jQuery(document).ready(function($) {
		function taxonomy_media_upload(button_class) {
			var custom_media = true,
				original_attachment = wp.media.editor.send.attachment;
			$('body').on('click', button_class, function(e) {
				var button_id = '#' + $(this).attr('id');
				var send_attachment = wp.media.editor.send.attachment;
				var button = $(button_id);
				custom_media = true;
				wp.media.editor.send.attachment = function(props, attachment) {
					if (custom_media) {
						$('#image_id').val(attachment.id);
						$('#image_wrapper').html('<img class="custom_media_image" src="" style="margin:0;padding:0;max-height:100px;float:none;" />');
						$('#image_wrapper .custom_media_image').attr('src', attachment.url).css('display', 'block');
					} else {
						return original_attachment.apply(button_id, [props, attachment]);
					}
				}
				wp.media.editor.open(button);
				return false;
			});
		}
		taxonomy_media_upload('.taxonomy_media_button.button');
		$('body').on('click', '.taxonomy_media_remove', function() {
			$('#image_id').val('');
			$('#image_wrapper').html('<img class="custom_media_image" src="" style="margin:0;padding:0;max-height:100px;float:none;" />');
		});

		$(document).ajaxComplete(function(event, xhr, settings) {
			var queryStringArr = settings.data.split('&');
			if ($.inArray('action=add-tag', queryStringArr) !== -1) {
				var xml = xhr.responseXML;
				$response = $(xml).find('term_id').text();
				if ($response != "") {
					$('#image_wrapper').html('');
				}
			}
		});
	});
</script>
<?php
}
add_filter('manage_edit-category_columns', 'display_image_column_heading_plugin_eventos');
function display_image_column_heading_plugin_eventos($columns)
{
	$columns['category_image'] = __('Image', 'taxt-domain');
	return $columns;
}
add_action('manage_category_custom_column', 'display_image_column_value_plugin_eventos', 10, 3);
function display_image_column_value_plugin_eventos($columns, $column, $id)
{
	if ('category_image' == $column) {
		$image_id = esc_html(get_term_meta($id, 'image_id', true));

		$columns = wp_get_attachment_image($image_id, array('50', '50'));
	}
	return $columns;
}
function fix_categ_svg_plugin_eventos()
{
	echo '<style type="text/css">
		#image_wrapper img {
			width: 60px;
			height:auto;
		}
	</style>';
}
add_action('admin_head', 'fix_categ_svg_plugin_eventos');
