<?php
// use Livewire\Livewire;
use Livewire\Component;
use Rivalex\LivewireNotify\Http\Livewire\Notify;
use function Pest\Livewire\livewire;

beforeEach(function(){
    $this->message = [
        'text' => "Let's have fun!"
    ];
    $this->messageFromMessageBag = [
        'text' => "Let's have fun!",
        'title' => '',
        'icon' => '',
        'type' => 'success'
    ];
});
// it('accepts message argument', function () {
//     livewire(Notify::class)->set('message',$this->message)->assertSet('message',$this->message);
// });
it('adds message to message bag received as an argument',function(){
    $livewire = livewire(Notify::class,['message'=>$this->message]);
    $this->assertCount(1,$livewire->messages);
});
it('adds message to message bag by calling addMsg action',function(){
    $livewire = livewire(Notify::class)->call('addMsg',$this->message);
    $this->assertCount(1,$livewire->messages);
    $this->assertEquals($this->messageFromMessageBag,$livewire->messages->pop());
});
it('grab message from session',function(){
    session()->flash('notify',$this->message);
    $livewire = livewire(Notify::class);
    $this->assertCount(1,$livewire->messages);
});
it('reacts on "notify" event',function(){
    $this->message = [
        'text' => "Let's have fun!"
    ];
    $livewire = livewire(Notify::class);
    $livewire->emit('message',$this->message);
    $this->assertCount(1,$livewire->messages);
});
