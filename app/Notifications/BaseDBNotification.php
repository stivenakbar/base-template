<?php

namespace App\Notifications;

use BeyondCode\LaravelWebSockets\WebSockets\Channels\PrivateChannel;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;

abstract class BaseDBNotification extends Notification implements ShouldBroadcast
{
    use Queueable;

    protected string $title, $message, $cta;

    public function __construct(string $title)
    {   
        $this->title = $title;
        $this->onConnection("sync");
        $this->afterCommit();
    }

    public abstract function generateMessage():string;
    public abstract function generateCTA():string;

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database', 'broadcast'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toDatabase(object $notifiable): array
    {
        return [
            'title' => $this->title,
            'desc' => method_exists($this,'generateMessage') ? $this->generateMessage() : throw new \Exception("generateMessage() method not found, plz overrive this method first"),
            'cta' => method_exists($this,'generateCTA') ? $this->generateMessage() : throw new Exception("generateCTA() method not found, plz overrive this method first")
        ];
    }

    public function toBroadcast(object $notifiable):BroadcastMessage{
     
        return new BroadcastMessage([
            'title' => $this->title,
            'desc' => method_exists($this,'generateMessage') ? $this->generateMessage() : throw new \Exception("generateMessage() method not found, plz overrive this method first"),
            'cta' => method_exists($this,'generateCTA') ? $this->generateMessage() : throw new Exception("generateCTA() method not found, plz overrive this method first")
        ]);
    }

   


}
