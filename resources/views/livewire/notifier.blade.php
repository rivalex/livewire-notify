<div class="{{ config('livewire-notify.positionClass') }} p-2 flex flex-col space-y-4">
    @foreach ($messages as $message)
        <livewire:livewire-notify-message :message="$message" key="{{ $loop->index }}" />
    @endforeach
</div>
