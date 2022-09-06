<div>

    @if ($tombol == 'uji')
        <button wire:click="kuis()" class="text-white hover p-2 nav-bg rounded-pill" style="height: 40px">Kuis</button>
        <p class="white">{{ $materiTerakhir }}</p>
    @elseif ($tombol == 'next')
        <button wire:click="nextMateri()" class="text-white hover p-2 nav-bg rounded-pill" style="height: 40px">Next
            Materi</button>
        <p class="white">{{ $materiTerakhir }}</p>
    @elseif ($tombol == 'selesai')
        <button wire:click="selesai()" class="text-white hover p-2 nav-bg rounded-pill"
            style="height: 40px">Selesai</button>
        <p class="white">{{ $materiTerakhir }}</p>
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
