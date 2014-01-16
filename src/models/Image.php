<?php namespace Fbf\LaravelImages;

class Image extends \Eloquent {

	/**
	 * Name of the table to use for this model
	 * @var string
	 */
	protected $table = 'fbf_images';

	/**
	 * The "booting" method of the model.
	 *
	 * @return void
	 */
	protected static function boot()
	{
		parent::boot();

		static::saving(function(\Eloquent $model)
		{
			// If a new image file is uploaded, could be create or edit...
			$dirty = $model->getDirty();
			if (array_key_exists('filename', $dirty))
			{
				// Set the width and height in the database
				list($width, $height) = getimagesize($model->getAbsolutePath('original'));
				$model->width = $width;
				$model->height = $height;
				// Now if editing only...
				if ($model->exists)
				{
					$oldFilename = self::where($model->getKeyName(),'=',$model->id)->first()->pluck('filename');
					$newFilename = $dirty['filename'];
					// Delete the old files, rename the newly uploaded files to the same as the old files and set the
					// filename field back to the old filename. This is all required because when uploading a new file
					// it is given a different, random filename, but when we're editing an image, we want to replace the
					// old with the new
					$model->deleteFiles($oldFilename);
					$model->renameFiles($newFilename, $oldFilename); // Rename new files back to the same as the old files
					$model->filename = $oldFilename;
				}
			}
		});

		static::deleted(function($model)
		{
			$model->deleteFiles();
		});
	}

	/**
	 * Returns the path, relative to public_path(), for the given type and filename. If filename is not passed, use the
	 * current record's filename. If the the type is not supplied, assume it the original that is wanted.
	 *
	 * @param string $type
	 * @param string $filename
	 * @return string
	 */
	public function getRelativePath($type = 'original', $filename = null)
	{
		if ($type != 'original' && substr($type, 0, 6) != 'sizes.')
		{
			$type = 'sizes.'.$type;
		}
		if (is_null($filename))
		{
			$filename = $this->filename;
		}
		return \Config::get("laravel-images::$type.dir") . $filename;
	}

	/**
	 * Returns the absolute path on the server to the file for the given type and filename. If the the type is not
	 * supplied, assume it the original that is wanted.
	 *
	 * @param string $type
	 * @param string $filename
	 * @return string
	 */
	public function getAbsolutePath($type = 'original', $filename = null)
	{
		return public_path($this->getRelativePath($type, $filename));
	}

	/**
	 * Deletes all the files for the given filename. If filename is not passed, use the current record's filename.
	 *
	 * @param string $filename
	 */
	protected function deleteFiles($filename = null)
	{
		unlink($this->getAbsolutePath('original', $filename));
		foreach (\Config::get("laravel-images::sizes") as $type => $settings)
		{
			unlink($this->getAbsolutePath($type, $filename));
		}
	}

	/**
	 * Renames all the files for the given from filename to the given to filename.
	 *
	 * @param string $from
	 * @param string $to
	 */
	protected function renameFiles($from, $to)
	{
		rename($this->getAbsolutePath('original', $from), $this->getAbsolutePath('original', $to));
		foreach (\Config::get('laravel-images::sizes') as $type => $settings)
		{
			rename($this->getAbsolutePath($type, $from), $this->getAbsolutePath($type, $to));
		}
	}

}