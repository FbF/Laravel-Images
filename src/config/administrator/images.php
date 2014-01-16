<?php

return array(

	/**
	 * Model title
	 *
	 * @type string
	 */
	'title' => 'Images',

	/**
	 * The singular name of your model
	 *
	 * @type string
	 */
	'single' => 'image',

	/**
	 * The class name of the Eloquent model that this config represents
	 *
	 * @type string
	 */
	'model' => 'Fbf\LaravelImages\Image',

	/**
	 * The columns array
	 *
	 * @type array
	 */
	'columns' => array(
		'filename' => array(
			'title' => 'Image',
			'output' => '<a href="' . Config::get('laravel-images::original.dir') . '(:value)" title="' . Config::get('laravel-images::original.dir') . '(:value)" target="_blank"><img src="' . Config::get('laravel-images::sizes.admin_thumb.dir') . '(:value)" width="' . Config::get('laravel-images::sizes.admin_thumb.width') . '" height="' . Config::get('laravel-images::sizes.admin_thumb.height') . '" /></a><br /><nowrap style="font-size:50%">' . Config::get('laravel-images::original.dir') . '(:value)</nowrap>',
		),
		'internal_ref' => array(
			'title' => 'Internal Reference'
		),
		'width' => array(
			'title' => 'Width',
			'output' => '(:value)px',
		),
		'height' => array(
			'title' => 'Height',
			'output' => '(:value)px',
		),
	),

	/**
	 * The edit fields array
	 *
	 * @type array
	 */
	'edit_fields' => array(
		'filename' => array(
			'title' => 'Image',
			'type' => 'image',
			'naming' => 'random',
			'length' => 20,
			'location' => public_path() . Config::get('laravel-images::original.dir'),
			'size_limit' => 5,
			'sizes' => array(
				array(
					Config::get('laravel-images::sizes.admin_thumb.width'),
					Config::get('laravel-images::sizes.admin_thumb.height'),
					'crop',
					public_path() . Config::get('laravel-images::sizes.admin_thumb.dir'),
					100
				),
			),
		),
		'alt' => array(
			'title' => 'ALT text',
			'type' => 'textarea',
		),
		'internal_ref' => array(
			'title' => 'Internal Reference (helps you find this image again in future)',
			'type' => 'textarea',
		),
		'width' => array(
			'title' => 'Original width (pixels)',
			'type' => 'text',
			'editable' => false,
		),
		'height' => array(
			'title' => 'Original height (pixels)',
			'type' => 'text',
			'editable' => false,
		),
		'created_at' => array(
			'title' => 'Created',
			'type' => 'datetime',
			'editable' => false,
		),
		'updated_at' => array(
			'title' => 'Updated',
			'type' => 'datetime',
			'editable' => false,
		),
	),

	/**
	 * The filter fields
	 *
	 * @type array
	 */
	'filters' => array(
		'alt' => array(
			'title' => 'ALT text',
			'type' => 'text',
		),
		'internal_ref' => array(
			'title' => 'Internal Reference',
			'type' => 'text',
		),
		'created_at' => array(
			'title' => 'Created Date',
			'type' => 'date',
		),
		'updated_at' => array(
			'title' => 'Updated Date',
			'type' => 'date',
		),
	),

	/**
	 * The width of the model's edit form
	 *
	 * @type int
	 */
	'form_width' => 300,

	/**
	 * The validation rules for the form, based on the Laravel validation class
	 *
	 * @type array
	 */
	'rules' => array(
		'filename' => 'required|image',
		'alt' => 'max:255',
		'internal_ref' => 'max:255',
	),

	/**
	 * The sort options for a model
	 *
	 * @type array
	 */
	'sort' => array(
		'field' => 'updated_at',
		'direction' => 'desc',
	),

	/**
	 * If provided, this is run to construct the front-end link for your model
	 *
	 * @type function
	 */
	'link' => function($model)
		{
			return $model->getRelativePath('original');
		},

);