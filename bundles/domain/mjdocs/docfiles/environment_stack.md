# Environment Setup and Installation

- [Intro](#intro)
- [Git setup](#git)
- [Getting the code](#get_code)
- [Vagrant](#vagrant)

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

This will boot you straight into your new VM, and you can use `sudo` without even having to type a password! Next, we set up a server.

*TO BE CONTINUED*