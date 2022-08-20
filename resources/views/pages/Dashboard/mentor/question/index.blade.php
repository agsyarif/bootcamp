@extends('layouts.app')

@section('title', 'Add Chapter')
@section('content')

    <main class="h-full overflow-y-auto">

        <div class="container mx-auto">
            <div class="grid w-full gap-5 px-10 mx-auto md:grid-cols-12">
                <div class="col-span-8">

                    <h2 class="mt-8 mb-1 text-2xl font-semibold text-gray-700">
                        Question From {{ $exam->title }}
                    </h2>

                    <p class="text-sm text-gray-400">
                        {{ $question->count() }} Total Question
                    </p>
                </div>

                <div class="col-span-4 lg:text-right">
                    <div class="relative mt-0 md:mt-6">
                        <a href="{{ route('mentor.question.show', [$exam->id]) }}"
                            class="inline-block px-4 py-2 mt-2 text-left text-white rounded-xl bg-serv-button">
                            + Add Question
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <section class="container px-6 mx-auto mt-5">

            @livewire('mentor.search-question', ['exam' => $exam, 'segment' => 'question'])

        </section>

    </main>

@endsection
