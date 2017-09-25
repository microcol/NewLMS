# BigBlueButton api integration with Laravel 5.5

This artical will help you to integrate Laravel 5.5 application with bigbluebutton api.

# About Big Blue Button
BigBlueButton is an open source web conferencing system. It is based on GNU/Linux operating system and runs on Ubuntu 16.04. In addition to various web conferencing services, it has integrations for many of the major learning and content management systems. For more detail visit 
[bigbluebutton](https://bigbluebutton.org/)


# Installation Big Blue Button Server
[install bigbluebutton](http://docs.bigbluebutton.org/install/install.html)
after installation run command bbb-conf --secret on bigbluebutton server to get bigbluebutton api url and secret key like
````
$ bbb-conf --secret
URL: http://192.168.200.500/bigbluebutton/
Secret: a7007506f1efffa497922fc34e3184dc
check bigbluebutton api like 
http://192.168.200.500/bigbluebutton/
output should look like
<response>
	<returncode>
		SUCCESS
	</returncode>
	<version>
		1.1
	</version>
</response>

````

# Requirements
- PHP >= 7.0.0
- OpenSSL PHP Extension
- PDO PHP Extension
- Mbstring PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension
- Curl library installed.
- allow_url_fopen = On  (in your php.ini)

# Implementation
- Clone the code from  the given repository
- Configure it in your localhost server i.e xampp,appache etc
- Create a database name "homestead"
- set bbb-conf --secret output in .env file
- BBB_SERVER_BASE_URL=http://192.168.200.500/bigbluebutton/
- BBB_SECURITY_SALT=a7007506f1efffa497922fc34e3184dc
- Run php artisan migrate in composer
- now run the cloned directory in browser i.e http://localhost/bigbluebutton-with-laravel

# Cover following api integration
- Create Meetings
- List Meetings
- Get Meeting Information
- Join Meeting as Moderator
- Join Meeting as Attendee
- Close Meetings 
- List Meetings Recording

# Api calls
- http://localhost/bigbluebutton-with-laravel/meeting/add
- http://localhost/bigbluebutton-with-laravel/meeting/list
- http://localhost/bigbluebutton-with-laravel/meeting/info/852/b04965e6-a9bb-591f-8f8a-1adcb2c8dc39
- http://localhost/bigbluebutton-with-laravel/meeting/join/Moderator%201/852/b04965e6-a9bb-591f-8f8a-1adcb2c8dc39
- http://localhost/bigbluebutton-with-laravel/meeting/join/Demo%201/963/b04965e6-a9bb-591f-8f8a-1adcb2c8dc39
- http://localhost/bigbluebutton-with-laravel/meeting/close/fadsf/91c274f2-9a0d-5ce6-ac3d-7529f452df21
- http://localhost/bigbluebutton-with-laravel/meeting/recordings



