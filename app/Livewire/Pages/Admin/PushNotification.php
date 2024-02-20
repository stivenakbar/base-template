<?php

namespace App\Livewire\Pages\Admin;

use App\Models\User;
use App\Notifications\PaymentSuccessfullNotification;
use Livewire\Attributes\Title;
use Livewire\Component;

class PushNotification extends Component
{
    #[Title('Push Notification')]

    public $user_id = "";


    public function notify(){
        $validated = $this->validate([
            'user_id' => 'required',
        ]);

        $user = User::find($validated['user_id']);
        if(empty($user)){
            $this->dispatch("swal", [
                'type' => "error",
                'text' => "User not found"
            ]);
            return;
        }
        $user->notify(new PaymentSuccessfullNotification("admin", 1000));
        $this->dispatch("swal", [
            'type' => "success",
            'text' => "Notification sent successfully"
        ]);
    }

    public function render()
    {
        return view('livewire.pages.admin.push-notification', [
            'users' => User::all()
        ]);
    }
}
