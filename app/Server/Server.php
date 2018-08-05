<?php

namespace App\Server;

use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;

// use App\Http\Controllers\Server\CharacterController;

class Server implements MessageComponentInterface
{
    const CTRL_NAMESPACE = "App\Http\Controllers\Server\\";

    /**
     * When a new connection is opened it will be passed to this method
     * @param  ConnectionInterface $conn The socket/connection that just connected to your application
     * @throws \Exception
     */
    function onOpen(ConnectionInterface $conn)
    {
        // TODO: Implement onOpen() method.
    }

    /**
     * This is called before or after a socket is closed (depends on how it's closed).  SendMessage to $conn will not result in an error if it has already been closed.
     * @param  ConnectionInterface $conn The socket/connection that is closing/closed
     * @throws \Exception
     */
    function onClose(ConnectionInterface $conn)
    {
        // TODO: Implement onClose() method.
    }

    /**
     * If there is an error with one of the sockets, or somewhere in the application where an Exception is thrown,
     * the Exception is sent back down the stack, handled by the Server and bubbled back up the application through this method
     * @param  ConnectionInterface $conn
     * @param  \Exception $e
     * @throws \Exception
     */
    function onError(ConnectionInterface $conn, \Exception $e)
    {
        // TODO: Implement onError() method.
    }

    /**
     * Triggered when a client sends data through the socket
     * @param  \Ratchet\ConnectionInterface $from The socket/connection that sent the message to your application
     * @param  string $msg The message received
     * @throws \Exception
     */
    function onMessage(ConnectionInterface $from, $msg)
    {
        $msg = json_decode($msg, true);

        $controller = self::CTRL_NAMESPACE.ucfirst($msg['route'].'Controller');
        $action = $msg['action'];

        if (class_exists($controller) && method_exists($controller, $action))
            $controller::{$action}($from, $msg['key']);
        else
            $from->send('page not found');
    }
}