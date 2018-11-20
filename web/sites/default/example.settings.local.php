<?php
/**
 * Add development service settings.
 */
if (file_exists(__DIR__ . '/services.local.yml')) {
  $settings['container_yamls'][] = __DIR__ . '/services.local.yml';
}


/**
 * Disable CSS and JS aggregation.
 */
$config['system.performance']['css']['preprocess'] = FALSE;
$config['system.performance']['js']['preprocess'] = FALSE;


/**
 * Set Hash salt value
 */
$settings['hash_salt'] = '1234567890';


/**
 * Set local db
 */
$databases['default']['default'] = array (
  'database' => 'db',
  'username' => 'root',
  'password' => 'vagrant',
  'prefix' => '',
  'host' => 'localhost',
  'port' => '3306',
  'namespace' => 'Drupal\\Core\\Database\\Driver\\mysql',
  'driver' => 'mysql',
);


/**
 * Set sync path
 */
$config_directories['sync'] = '/vagrant/htdocs/config/sync';

