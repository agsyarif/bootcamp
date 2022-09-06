<div>
    {{-- <p class="white" style="color: darkgrey">Ujian Bab : {{ $materiTerakhir }}
    </p> --}}
    <a class="white hover p-2 nav-bg rounded-pill" style="height: 40px"
        href="{{ route('member.course.materi', [$materiTerakhir[0] + 1]) }}">
        {{-- {{ route('member.course.materi', [$MateriActive[0]->id + 1]) }} --}}
        Next Video
    </a>
    {{-- @livewire('next', [$ChapterActive[0]->id, $MateriActive->id, $aksesCourse[0]->id]) --}}
</div>
