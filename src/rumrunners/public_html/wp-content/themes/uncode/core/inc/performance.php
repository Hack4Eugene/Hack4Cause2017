<?php

/**
 * Add HTML5 Boilerplate's .htaccess via WordPress
 */
function uncode_add_h5bp_htaccess()
{

	$options = get_option( ot_options_id() );
	$theme_opt = $options['_uncode_htaccess'];
	$saved_opt = get_option("_uncode_htaccess_performace");

	if (($theme_opt === 'on' && $saved_opt !== 'on') || ($theme_opt === 'off' && $saved_opt === 'on'))
	{

		global $wp_rewrite;

		$home_path = function_exists('get_home_path') ? get_home_path() : ABSPATH;
		$htaccess_file = $home_path . '.htaccess';

		$mod_rewrite_enabled = function_exists('got_mod_rewrite') ? got_mod_rewrite() : false;
		if ((!file_exists($htaccess_file) && is_writable($home_path) && $wp_rewrite->using_mod_rewrite_permalinks()) || is_writable($htaccess_file))
		{
			if ($mod_rewrite_enabled)
			{
				$h5bp_rules = extract_from_markers($htaccess_file, 'HTML5 Boilerplate');

				if ($h5bp_rules === array())
				{
					$filename = dirname(__FILE__) . '/h5bp-htaccess';
					update_option("_uncode_htaccess_performace", $theme_opt);
					return insert_with_markers($htaccess_file, 'HTML5 Boilerplate', extract_from_markers($filename, 'HTML5 Boilerplate'));
				}
				else
				{
					if ($theme_opt === 'off')
					{
						update_option("_uncode_htaccess_performace", $theme_opt);
						return insert_with_markers($htaccess_file, 'HTML5 Boilerplate', '');
					}
				}
			}
		}
	}
}

add_filter('ot_after_theme_options_save', 'uncode_add_h5bp_htaccess');
