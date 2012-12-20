Outglow4
========

###Disclaimer
This project is NOT currently stable. Check it out if you like, but if you're looking
for a good stable framework, I'd highly recommend NOT using this one, YET. Thanks!

#Setup
##Tests
So far, this has been tested with the following setups:

  - Ubuntu 12.04 LTS (precise)
	- Apache2 (with or without .HTACCESS)
	- Nginx (current version)
	- PHP 5.3*
	- MySQL (optional)
	- MongoDB (optional)

So as far as I can tell, so far it seems like it will be fairly flexible. I have
not tested this on any Windows servers.

###Apache
For cleaner URLs with this framework, I have the following in the .HTACCESS usually:

	Options +FollowSymLinks
	Options -Indexes

	RewriteEngine On
	RewriteBase /

	RewriteCond %{REQUEST_FILENAME} -s [OR]
	RewriteCond %{REQUEST_FILENAME} -l [OR]
	RewriteCond %{REQUEST_FILENAME} -d
	RewriteRule ^.*$ - [NC,L,QSA]
	RewriteRule ^.*$ /index.php [NC,L,QSA]

I'm no expert with HTACCESS, but this seems to work pretty well.

###Nginx
Still quite to new with Nginx, but just for now, I'm sticking with somthing like this
in my config:

	location / {
		index  index.php index.html;

		# send url to index.php and append the requested uri to the end unless $
		if (!-e $request_filename){
		rewrite ^/(.*)$ /index.php?/$1? last;
		}
	}

Again, no expert with Nginx yet, but this seems alright for testing purposes,
not for production.