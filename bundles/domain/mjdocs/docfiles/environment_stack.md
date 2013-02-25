# Environment Setup and Installation

- [Intro](#intro)
- [Git setup](#git)
- [Getting the code](#get_code)
- [Vagrant](#vagrant)
- [Your server](#your_server)

<a name="intro"></a>
### The stack

If you are a developer using Windows, it is non-trivial to setup an environment where you have access to all the software Musejam needs to function correctly. This guide is for developers using Windows 7 who don't want to lose their tools but also would like to run Musejam in an environment it is most comfortable in. Note that where `yourusername` is specified, you need to replace with your Windows user name.

Our first goal is to see the successful "Welcome to Laravel" in the project root. You will need about 2 to 3 hours time (your internet speed is a factor). Just follow these instructions:

<a name="git"></a>
###Git for Windows

Download and install [Git for Windows](http://git-scm.com/downloads). Note that you don't need to do this if you already have TortoiseGit or Github for Windows, you just need access to a Git shell (which is actually mSysGit, is actually an implementation of Bash for Windows, along with a ton of packaged awesome Unix s/w like curl, ssh, grep, awk, sed...).

**Setup an SSH key to easily work with Github**

There's an awesome guide from Github themselves to help with this. Launch the "Git Shell" (aka Git Bash program). Then [go finish following all the steps](https://help.github.com/articles/generating-ssh-keys) from *within* the Git shell you opened.

<a name="get_code"></a>
###Get Musejam's source

You can do this in any folder you like. The author likes keeping it in a place where it is easily reachable. We suggest you make a folder called C:\code, allowing you to reach the place super fast. Through the rest of this guide, this is where we assume you have your code; so be sure to change the path to the right one if you spot it and you used something else.

You need to clone the Musejam application. Go back to the Git Shell, and type the following commands (hit enter after each line to execute the command):

	cd C:
	mkdir code
	cd code
	git clone git@github.com:Musejam/mj-app.git

You now have the code for Musejam in C:\code\mj-app; go ahead, take a peek.\

<a name="vagrant"></a>
###Vagrant
**Install Vagrant**:

First, install [Oracle Virtual Box](https://www.virtualbox.org). Then, download and install [Vagrant](http://www.vagrantup.com).

**Configure Vagrant (and your new VM (Virtual Machine))**:

Execute in the Git shell:

	cd C:
	mkdir vagrants
	cd vagrants
	mkdir pangolin
	cd pangolin
	vagrant init

There is now a `vagrants` folder in `C:`, which can store all your vagrant boxes in an organized fashion. `pangolin` is the name of your first Vagrant.

Open the file C:\vagrants\pangolin\Vagrantfile in your favorite text editor. Backup this file into another file called Vagrantfile.bak in the same folder, so you can refer to it later for comments to see what's happening and what's possible. Then delete all contents from the file, and copy and paste the following:

	# -*- mode: ruby -*-
	# vi: set ft=ruby :

	Vagrant::Config.run do |config| config.vm.box = "precise32"
		config.vm.box_url = "http://files.vagrantup.com/precise32.box"
		config.vm.network :hostonly, "192.168.33.10" config.vm.share_folder "mj-app", "/mnt/mj-app", "C:/wamp/www/mj-app", :owner => "www-data", :group => "www-data"
	end

That will get you the "Precise Pangolin", 32 bit version of the latest stable Ubuntu at the time of writing.

In Git Shell:
	cd /c/vagrants/pangolin
	vagrant up

With that, Vagrant will download Ubuntu, set it up, mount the right folders (with perfect permissions) and boot the VM, all without ever having you to touch the underlying VirtualBox software.

In the meanwhile, you want to be able to access Musejam easily. Open `C:\Windows\System32\drivers\etc\hosts` in your favorite editor. At the bottom, add this:

	192.168.33.10	musejam.dev

Save and close. This will allow you to access your VM with a clean domain name from the browser.

Next, you need to set up an easy way to access SSH of your VM. Open `C:\Users\yourusername\.bashrc` in a text editor, and add this line:

	alias vagrant_ssh='ssh vagrant@127.0.0.1 -p 2222 -i /c/Users/yourusername/.vagrant.d/insecure_private_key'

After Vagrant is done booting your brand new VM, it will quit the command line and allow you to type the next line. Close the Git Shell and open again, because restarting is required for new Bash Aliases (you create one just now) to work.

Now execute:

	vagrant_ssh

This will boot you straight into your new VM, and you can use `sudo` without even having to type a password!

<a name="your_server"></a>
###Your server
You are inside your own virtual linux environment without having to give up your customized Windows environment. Have you finished gloating? Good, let's get started on the server.

If you followed the instructions above, you are using the Ubunut Precise Pangolin long term support release. You do not, unfortunately, have access to the latest PHP or Redis from aptitude. Sure you could compile but we want to get started quickly.

Let's pimp up aptitude. You'll be using nano to do this, please read up on how to edit, save and do other stuff in it. Then:
	
	sudo nano /etc/apt/sources.list

Delete the contents of that file, and paste in the following:

	###### Ubuntu Main Repos
	deb http://in.archive.ubuntu.com/ubuntu/ precise main restricted universe multiverse
	deb-src http://in.archive.ubuntu.com/ubuntu/ precise main restricted universe multiverse

	###### Ubuntu Update Repos
	deb http://in.archive.ubuntu.com/ubuntu/ precise-security main restricted universe multiverse
	deb http://in.archive.ubuntu.com/ubuntu/ precise-updates main restricted universe multiverse
	deb-src http://in.archive.ubuntu.com/ubuntu/ precise-security main restricted universe multiverse
	deb-src http://in.archive.ubuntu.com/ubuntu/ precise-updates main restricted universe multiverse

You now have the India mirrors of Ubuntu package updates. Now, tell aptitude to fetch stuff from these new places:

	sudo aptitude update

Wait till the process completes. Follow along with these steps to avoid further problems (and allow your VM to update programs easily later):

	sudo aptitude upgrade
	sudo aptitude install make
	sudo /etc/init.d/vboxadd setup
	exit

You are now out of the server. Restart it to allow any pending actions to complete themselves:

	# make sure you are the in the folder where Vagrantfile resides
	vagrant reload
	vagrant_ssh

Now, we need a way to get PHP 5.4 and the latest Redis, because those versions are still not available from the official repositories. So:

	sudo aptitude install python-software-properties
	sudo add-apt-repository ppa:ondrej/php5
	sudo add-apt-repository ppa:rwky/redis
	sudo aptitude update
	sudo aptitude upgrade

Finally! We get to install the actual s/w we need:

	sudo aptitude install nginx php5 php5-fpm mysql-client mysql-server redis-server php5-cli php5-mysql php5-gd

That should get you everything you need. Just keep answering 'Y' and configure mysql when it asks you to.

Remember how you mounted the code on your HDD in Windows into the Virtual Machine? You now need to configure a website in nginx that points to that directory. Instructions:

	cd /etc/nginx/sites-available
	sudo vim musejam.dev

This will open a new file. Paste the following configuration in there:

	server {
	    server_name musejam.dev;
	    root /mnt/mj-app/public;

	    index index.php index.html;

	    # serve static files directly
	    location ~* \.(jpg|jpeg|gif|css|png|js|ico|html)$ {
	        access_log off;
	        expires max;
	    }

	    # removes trailing slashes (prevents SEO duplicate content issues)
	    # We don't do that on this site due to existing urls
	    if (!-d $request_filename)
	    {
	        rewrite ^/(.+)/$ /$1 permanent;
	    }

	    location /swf {
	        autoindex on;
	    }

	    # enforce NO www
	    if ($host ~* ^www\.(.*))
	    {
	        set $host_without_www $1;
	        rewrite ^/(.*)$ $scheme://$host_without_www/$1 permanent;
	    }

	    # unless the request is for a valid file (image, js, css, etc.), send to bootstrap
	    if (!-e $request_filename)
	    {
	        rewrite ^/(.*)$ /index.php/$1 last;
	        break;
	    }

	    # catch all
	    error_page 404 /index.php;

	    location ~ \.php {
	           fastcgi_split_path_info ^(.+\.php)(/.+)$;
	           # NOTE: You should have "cgi.fix_pathinfo = 0;" in php.ini

	           # With php5-fpm:
	           fastcgi_pass unix:/var/run/php5-fpm.sock;
	           fastcgi_index index.php;
	           include fastcgi_params;
	    }

	    access_log /var/log/nginx/musejam.dev.access.log;
	    error_log  /var/log/nginx/musejam.dev.error.log;
	}

Save the file and exit by hitting `Esc` key then `:x` (in case you didn't know). Then do:

	cd ../sites-enabled
	sudo ln -s ../sites-available/musejam.dev
	sudo service nginx restart

This should show you a message `Restarting nginx: nginx.`, which means it restarted successfully. Anything else indicates a problem and you should debug.

Go visit `http://musejam.dev` in your browser. It should show an error page saying:

	Unhandled Exception
	Message: Redis database [default] is not defined..

That's because we still need to configure Musejam itself. But congratulations! The environment setup is complete. We're almost there. Let's configure musejam:
	
First, we need a database:

	sudo mysql -u root -p
	# Enter the password you chose in the steps above when it prompts you
	# In the mysql prompt, type:
	CREATE DATABASE musejam_dev;
	exit;

Now, we need to tell Musejam how to find that database. The best part is you can use Windows OR the Linux VM to edit your config files. Create a directory called local/ in application/config. Then create a file called database.php with these contents (change the password as indicated by the comment):

	<?php

	return array(

		'profile' => true,

		'fetch' => PDO::FETCH_CLASS,

		'default' => 'local',

		'connections' => array(

			'local' => array(
				'driver'   => 'mysql',
				'host'     => 'localhost',
				'database' => 'musejam_dev',
				'username' => 'root',
				'password' => 'password', // CHANGE THIS TO THE RIGHT PASSWORD
				'charset'  => 'utf8',
				'prefix'   => '',
			),

		),

		'redis' => array(

			'default' => array(
				'host'     => '127.0.0.1',
				'port'     => 6379,
				'database' => 0
			),
		),

	);

Musejam has a convenient installation script. Let's use it:

	sudo ./setup.sh local

`WARNING`: We assume that you are on the right branch when doing all this. You need to `git checkout` to the right branch with all the latest commits in order to get all the right migrations. We suggest you speak to your project manager to get this info.

Navigate now to musejam.dev in your browser, and behold the glory of a properly installed Musejam app. Good luck with your dev adventures!