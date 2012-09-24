# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant::Config.run do |config|

  config.vm.box = "precise64"
  config.vm.box_url = "http://files.vagrantup.com/precise64.box"
  config.vm.forward_port 80, 4567
  config.vm.forward_port 3306, 4568

  config.vm.provision :puppet do |puppet|
    puppet.manifests_path = "provision/manifests"
    puppet.manifest_file  = "default.pp"
    puppet.module_path = "provision/modules"
  end

end
