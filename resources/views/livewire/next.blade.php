<div>

    @if ($tombol == 'uji')
        <button wire:click="kuis()" class="text-white hover p-2 nav-bg rounded-pill" style="height: 40px">Kuis</button>
    @elseif ($tombol == 'next')
        <button wire:click="nextMateri()" class="text-white hover p-2 nav-bg rounded-pill" style="height: 40px">Next
            Materi</button>
    @elseif ($tombol == 'selesai')
        <button wire:click="selesai()" class="text-white hover p-2 nav-bg rounded-pill"
            style="height: 40px">Selesai</button>
    @endif

    {{-- @if ($disabled == true)
        <button wire:click="selesai()" class="text-white hover p-2 nav-bg rounded-pill"
            style="height: 40px">Selesai</button>
    @else
        <button wire:click="nextMateri()" class="text-white hover p-2 nav-bg rounded-pill" style="height: 40px">Next
            Materi</button>
        <p>{{ $tombol }} hgvxgh</p>
    @endif --}}

    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
</div>
