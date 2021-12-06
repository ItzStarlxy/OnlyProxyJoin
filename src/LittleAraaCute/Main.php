<?php

namespace LittleAraaCute\OnlyProxyJoin;

use pocketmine\Server;
use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\utils\Config;
use pocketmine\event\player\PlayerPreLoginEvent;

class Main extends PluginBase implements Listener {
	
	public function onEnable(): void{
		$this->getLogger()->info("Plugin has Enabled");
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		@mkdir($this->getDataFolder());
        $this->saveResource("config.yml");
        $this->getConfig = new Config($this->getDataFolder() . "config.yml", Config::YAML);
	}
	
	public function onPreLogin(PlayerPreLoginEvent $event){
		$player = $event->getPlayer();
		
		if($player->getNetworkSession()->getIp() !== $this->getConfig()->get("proxy-ip")){
		$event->setKickMessage($this->getConfig()->get("kick-message"));
		$event->setCancelled(true);
	}
}
}
