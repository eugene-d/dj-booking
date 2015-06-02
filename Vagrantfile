Vagrant.configure("2") do |config|
  config.vm.box = "hashicorp/precise64"
  config.vm.provision :shell, :path => "vagrantSetup.sh"
  #config.vm.network "forwarded_port", guest: 80, host: 8080
  config.vm.network "public_network", ip: "192.168.0.111"
  config.vm.provider "virtualbox" do |v|
    #v.memory = 2024
    #v.gui = true
  end
end