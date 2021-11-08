# -*- mode: ruby -*-
# vi: set ft=ruby :

BOX_NAME = ENV['BOX_NAME'] || "debian/buster64"

Vagrant.configure("2") do |config|
  config.vm.box = BOX_NAME
  config.vm.box_check_update = false


  # Backend (first deployment)
  config.vm.define "BEnd", primary: true do |be|
    be.vm.hostname = "BEnd"
    be.vm.network "private_network", ip: "10.0.0.20", auto_config: true

    be.vm.provider :virtualbox do |vb|
      vb.name = "BEnd"
      vb.customize ["modifyvm", :id, "--memory", "1024"]
      vb.customize ["modifyvm", :id, "--cpus", "1"]
    end

    be.vm.provision "ansible" do |ansible|
      ansible.verbose = "vv"
      ansible.compatibility_mode = '2.0'
      ansible.extra_vars = { ansible_python_interpreter: "/usr/bin/python3" }
      ansible.playbook = "BEnd.yml"
    end         
  end

  # Frontend
  config.vm.define "FEnd" do |fe|
    fe.vm.hostname = "FEnd"

    fe.vm.provider :virtualbox do |vb|
      vb.name = "FEnd"
      vb.customize ["modifyvm", :id, "--memory", "1024"]
      vb.customize ["modifyvm", :id, "--cpus", "1"]
    end

    fe.vm.network "private_network", ip: "10.0.0.10", auto_config: true
    fe.vm.network "forwarded_port", guest: 80, host: 8080, auto_correct: true # http
    fe.vm.network "forwarded_port", guest: 443, host: 8443, auto_correct: true # https

    fe.vm.provision "ansible" do |ansible|
      ansible.verbose = "vv"
      ansible.compatibility_mode = '2.0'
      ansible.extra_vars = { ansible_python_interpreter:"/usr/bin/python3" }
      ansible.playbook = "FEnd.yml"
    end         
  end

end
