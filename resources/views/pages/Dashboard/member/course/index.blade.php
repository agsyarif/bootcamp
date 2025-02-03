@extends('layouts.app')

@section('title', 'Class')
@section('content')

    @if ($courses->count() !== 0)

        <main class="h-full overflow-y-auto">

            <x-title.title-page label="Kelas Saya" description="Belajar dengan giat, untuk masa depan yang lebih baik." />

            <section class="container px-6 mx-auto mt-5">
                <div class="grid gap-5 md:grid-cols-12">
                    <main class="col-span-12 p-4 md:pt-0">

                        <div class="p-6 bg-grey rounded-xl">

                            <div class="sm:grid sm:h-32 sm:grid-flow-row sm:gap-4 sm:grid-cols-3">

                                @forelse ($courses as $course)

                                    <x-card.card-course
                                        route="courses.show"
                                        id='{{$course->course->id}}'
                                        image='{{$course->course->image}}'
                                        name='{{$course->course->name}}'
                                        level='{{$course->course->level->name}}'
                                        role="mentor"
                                    />

                                @empty
                                    {{-- empty --}}
                                @endforelse

                            </div>

                        </div>

                    </main>
                </div>
            </section>
        </main>
    @else
        <x-page.null-page
            h2="There is No Request Yet"
            description="It seems that you haven’t ordered any service. <br> Let’s order your first service!"
            label="Find Services"
            img="/assets/images/empty-illustration.svg"
            url="explore.landing"
        />
    @endif


@endsection
