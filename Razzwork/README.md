This file shall explain how to initialize everything to make it work!

1. Give the apache-user www-data access to the gpio-pins

# Add www-data to the gpio group
usermod -G gpio -a www-data
#restart apache to make the changes effective
/etc/init.d/apache2 restart

2. Code your application using the classes from the framwork

3. Profit!

----------------
How to use the I2C-Bus with php (serverscripts) - necessary for many sensors with ADCs

1. enable I2C in raspi-config: sudo raspi-config
2. install the i2ctools: sudo apt-get install i2c-tools
3. add www-data to the i2c-group: sudo usermod -a -G i2c www-data
4. restart apache: sudo apache2ctl restart

