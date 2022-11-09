<div>
    <div class="container mx-auto">
        <button type="button"
                wire:click="openDiv"
                class="px-4 py-2 text-purple-100 bg-purple-500">Show & Hide Div
        </button>
        @if ($showDiv)
            <div>
                <p>Show and Hide Dive Elements in laravel livewire</p>
            </div>
        @endif
    </div>
</div>
