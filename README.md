This is a project creating an easy-to-use small PHP-Framework to create
php-Apps which directly use the GPIO capabilities of raspberry pi

		--- How to use the project's capabilities ---

1. Give the apache-user www-data access to the gpio-pins

# Add www-data to the gpio group
usermod -G -a gpio www-data
#restart apache to make the changes effective
sudo apache2ctl restart

2. Code your application using the classes from the framwork

# e.G:

require_once __DIR__.'/../../Razzwork/Autoloader.class.php';
Autoloader::register();

$oPin = new Razzwork\GPIO\Pin(23, 'in');
echo $oPin->getValue();

3. Profit!

		--- How to enable the I2C-Bus for usage with php/apache ---

1. enable I2C in raspi-config: sudo raspi-config
2. install the i2ctools: sudo apt-get install i2c-tools
3. add www-data to the i2c-group: sudo usermod -a -G i2c www-data
4. restart apache: sudo apache2ctl restart

