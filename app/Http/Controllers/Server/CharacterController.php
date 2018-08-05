<?php

namespace App\Http\Controllers\Server;

use \App\Models\Location;
use \App\Models\Character;
use Ratchet\ConnectionInterface;

class CharacterController
{
    public static function get(ConnectionInterface $from, $msg)
    {
    	$character = Character::with(['location'])->find($msg);
        if (is_null($character->location)) {
            $default = Location::query()->first();
            $character->update([
                'location_id' => $default->id,
                'position_x' => ($default->width)/2 + 1,
                'position_y' => ($default->height)/2 + 1,
            ]);
            $character->location()->get();
        }

        $from->send(json_encode($character));
	}
}
