<div>


    @if ($disabled == true)
        <button wire:click="selesai()" class="text-white hover p-2 nav-bg rounded-pill"
            style="height: 40px">Selesai</button>
    @else
        <button wire:click="nextMateri()" class="text-white hover p-2 nav-bg rounded-pill" style="height: 40px">Next
            Materi</button>
    @endif

    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
</div>
