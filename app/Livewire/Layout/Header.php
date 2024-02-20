<?php

namespace App\Livewire\Layout;

use App\Livewire\Actions\Logout;
use App\Models\MenusModel;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Locked;
use Livewire\Component;
use Livewire\Attributes\On;

class Header extends Component
{
    #[Locked]
    public $notifications;
    #[Locked]
    public $unreadedCount;
    #[Locked]
    public $isLoadedAll = false;
    #[Locked]
    public $user;
    public $menus;

    public function mount()
    {
        $this->user = Auth::user();
        $this->menus = MenusModel::where('location','topbar')->where("is_active","1")->orderBy('order','asc')->get();
        $this->getNotifs();
        $this->countUnreaded();
    }

    public function getListeners()
    {
        return [
            "echo-private:App.Models.User.{$this->user->id},.Illuminate\\Notifications\\Events\\BroadcastNotificationCreated" => 'addNotification',
        ];
    }

    public function addNotification($notification)
    {
        $this->notifications = collect($this->notifications)->prepend($notification)->splice(0,5)->toArray();
        $this->countUnreaded();
    }

    public function markAsRead($id)
    {
        $this->user->notifications()->where("id", $id)->update(['read_at' => now()]);
        $this->notifications =[];
        $this->getNotifs();
        $this->dispatch("notifs-changed");
    }

    public function markAllAsRead(){
        $this->user->notifications()->whereIn("id",collect($this->notifications)->pluck("id"))->update([
            "read_at"=>now()
        ]);
        $this->getNotifs($this->isLoadedAll ? null : 5);
    }

    public function showAll(){
        $this->getNotifs(null);
        $this->dispatch("notifs-changed");
        $this->isLoadedAll = true;
    }

    public function showLess(){
        $this->notifications = collect($this->notifications)->slice(0,5)->toArray();
        $this->isLoadedAll = false;
    }

    public function getNotifs($limit = 5)
    {
        $this->countUnreaded();
        $this->notifications = $this->user->notifications()->latest()->limit($limit)->get()->map(function ($notif) {
            return [
                'id' => $notif->id,
                'type' => $notif->type,
                'read_at' => $notif->read_at,
                'created_at' => $notif->created_at->diffForHumans(),
                ...$notif->data
            ];
        })->toArray();
    }

    public function countUnreaded()
    {
        $this->unreadedCount = $this->user->unreadNotifications->count();
    }

    public function logout(){
        $user = Auth::user();

        // Find the token with the name 'api-token' and delete it
        $token = $user->tokens()->where('name', 'api-token')->first();
        if ($token) {
            $token->delete();
        }

        (new Logout())->__invoke();

        $this->redirectRoute('login');
    }



    public function render()
    {
        return view('livewire.layout.header');
    }
}
