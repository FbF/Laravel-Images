<?php

return array(

	/**
	 * This is always required. It is the settings for the original file uploaded.
	 */
	'original' => array(
		/**
		 * The path, relative to the public_path() directory, where the original images are stored.
		 */
		'dir' => '/uploads/packages/fbf/laravel-images/original/',
	),

	/**
	 * You may not have any elements in here. These are for alternative sizes of the image that are automatically
	 * generated after uploading an original image.
	 */
	'sizes' => array(
		/**
		 * Configuration options for the thumbnails shown in the administrator index screen
		 */
		'admin_thumb' => array(
			'width'     => 150,
			'height'    => 150,
			'dir'       => '/uploads/packages/fbf/laravel-images/admin_thumb/',
		),
	),

);