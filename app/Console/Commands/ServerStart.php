<?php

namespace App\Console\Commands;

use App\Server\Server;
use Illuminate\Console\Command;
use Ratchet\App as RatchetApp;

class ServerStart extends Command
{
    protected $signature = "server:start";
    protected $description = "Start game server";

    public function handle()
    {
        $server = new RatchetApp(env('SERVER_HOST'), env('SERVER_PORT'));
        $server->route('/api', new Server());
        $server->run();
    }
}