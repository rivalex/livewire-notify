<?php

namespace Rivalex\LivewireNotify\Http\Livewire;

use Illuminate\Support\Collection;
use Livewire\Component;

class NotifyMessage extends Component
{
    /**
     * Message from attributes bag
     *
     * @var String
     */
    public $message;
    /**
     * Time in ms which message is shown
     * 0 for unlimited time
     * @var integer
     */
    public $duration;

    public $msgClass;
    public $progressClass;
    /**
     * Whether message is closable by click
     *
     * @var boolean
     */
    public $closable = true;
    /**
     * Mount lifecycle action
     *
     * @return void
     */
    public function mount(){
        $this->duration = $this->duration ?? config('livewire-notify.duration');
        $this->closable = $this->closable ?? config('livewire-notify.closable');
        $this->msgClass = $this->msgClass ?? config('livewire-notify.types.' . ($this->message['type'] ?? 'default') . '.msgClass',config('livewire-notify.types.default.msgClass'));
        $this->progressClass = $this->progressClass ?? config('livewire-notify.types.' . ($this->message['type'] ?? 'default') . '.progressClass',config('livewire-notify.types.default.progressClass'));
    }
    
    public function render()
    {
        $this->message = array_merge([
            'text'=>'',
            'title' => '',
            'icon' => '',
            'type' => 'success',
            'duration' => $this->duration,
            'msgClass' =>  $this->msgClass,
            'progressClass' =>  $this->progressClass,
            'closable' => $this->closable,
        ], $this->message);
        return view('livewire-notify::livewire.notify-message');
    }
}
