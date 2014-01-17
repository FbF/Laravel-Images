Laravel Images
==============

A Laravel 4 package for uploading images to a website

## Includes

* Migration for a database table to store references to the uploaded image
* Model for accessing the database table
* FrozenNode Administrator config for uploading and managing images

## Installation

Add the following to you composer.json file

    "fbf/laravel-images": "dev-master"

Run

    composer update

Add the following to app/config/app.php

    'Fbf\LaravelImages\LaravelImagesServiceProvider'

Publish the config

    php artisan config:publish fbf/laravel-images

Run the migration

    php artisan migrate --package="fbf/laravel-images"

Create the relevant image upload directories that you specify in your config, e.g.

    public/uploads/packages/fbf/laravel-images/original
    public/uploads/packages/fbf/laravel-images/admin_thumb

## Administrator

You can use the excellent Laravel Administrator package by frozennode to administer your images.

http://administrator.frozennode.com/docs/installation

A ready-to-use model config file for the Image model (images.php) is provided in the src/config/administrator directory of the package, which you can copy into the app/config/administrator directory (or whatever you set as the model_config_path in the administrator config file).