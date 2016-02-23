## Virtual Host
``
### PHP / HTML Application
<VirtualHost *:80>
  ServerName me.wgs
  ServerAlias www.me.wgs

  DocumentRoot /home/wgs-lap116/public_html/
  <Directory /home/wgs-lap116/public_html/>
    Options Indexes
    AllowOverride None
    Order allow,Deny
    Allow from all
    Require all granted
  </Directory>
  
  ErrorLog ${APACHE_LOG_DIR}/error.log
  CustomLog ${APACHE_LOG_DIR}/access.log combined
</VirtualHost>

### RUBY Application
<VirtualHost *:80>
    Servername api.local
    RailsEnv production
    PassengerRuby /home/deploy/.rvm/wrappers/ruby-2.1.2@w-erp/ruby
    DocumentRoot /home/deploy/api/public
    <Directory /home/deploy/api/public>
        Allow from all
        Options -MultiViews
        # Uncomment this if you're on Apache >= 2.4:
        Require all granted
    </Directory>
</VirtualHost>
``

## Sub Directory
Alias /vhostname "/vhostfolder"

## Allowed Direct Access, Public
<Directory "/vhostfolder">
  AllowOverride None
  Order Allow,Deny
  Allow from all
</Directory>

## Not Allowed Direct Access
<Directory "/privatefolder">
  Order Deny,Allow
  Deny from all
</Directory>

## Set Variable
SetEnv industri /home/targetfile.map


## CORS
[Configurasi apache supaya suppoert CORS DOMAIN ACCESS(]http://benjaminhorn.io/code/setting-cors-cross-origin-resource-sharing-on-apache-with-correct-response-headers-allowing-everything-through/)
#### Always set these headers.
Header always set Access-Control-Allow-Origin "*"
Header always set Access-Control-Allow-Methods "POST, GET, OPTIONS, DELETE, PUT"
Header always set Access-Control-Max-Age "1000"
Header always set Access-Control-Allow-Headers "x-requested-with, Content-Type, origin, authorization, accept, client-security-token"
#### Added a rewrite to respond with a 200 SUCCESS on every OPTIONS request.
RewriteEngine On
RewriteCond %{REQUEST_METHOD} OPTIONS
RewriteRule ^(.*)$ $1 [R=200,L]