@extends('layouts.app')

@section('title', 'Edit, My Course')

@section('content')

    <main class="h-full overflow-y-auto">

        <div class="container mx-auto">
            <div class="grid w-full gap-5 px-10 mx-auto md:grid-cols-12">
                <div class="col-span-12">

                    <h2 class="mt-8 mb-1 text-2xl font-semibold text-gray-700">
                        Edit Your Course
                    </h2>

                    <p class="text-sm text-gray-400">
                        Upload the Course you provide
                    </p>

                </div>
            </div>
        </div>

        <!-- breadcrumb -->


    </main>

@endsection

@push('after-script')
    <script src="{{ url('https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js') }}"></script>

    <script type="text/javascript">
        // add row
        $("#addAdvantagesRow").click(function() {
            var html = '';
            html +=
                '<input placeholder="Keunggulan Kamu" type="text" name="advantage_user[]" id="advantage_user" autocomplete="advantage_user" class="block w-full py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">';

            $('#newAdvantagesRow').append(html);
        });

        // remove row
        $(document).on('click', '#removeAdvantagesRow', function() {
            $(this).closest('#inputFormAdvantagesRow').remove();
        });
    </script>

    <script type="text/javascript">
        // add row
        $("#addMateriRow").click(function() {
            var html = '';
            html +=
                '<input placeholder="Materi Bootcamp" type="text" name="materi[]" id="materi" autocomplete="materi" class="block w-full py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">';

            $('#newMateriRow').append(html);
        });

        // remove row
        $(document).on('click', '#removeServicesRow', function() {
            $(this).closest('#inputFormServicesRow').remove();
        });
    </script>

    <script type="text/javascript">
        // add row
        $("#addServicesRow").click(function() {
            var html = '';
            html +=
                '<input placeholder="Keunggulan Service" type="text" name="advantage_service[]" id="advantage_service" autocomplete="advantage_service" class="block w-full py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">';

            $('#newServicesRow').append(html);
        });

        // remove row
        $(document).on('click', '#removeServicesRow', function() {
            $(this).closest('#inputFormServicesRow').remove();
        });
    </script>

    <script type="text/javascript">
        // add row
        $("#addTaglineRow").click(function() {
            var html = '';
            html +=
                '<input placeholder="Keunggulan" type="text" name="tagline[]" id="tagline" autocomplete="tagline" class="block w-full py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm" required>';

            $('#newTaglineRow').append(html);
        });

        // remove row
        $(document).on('click', '#removeTaglineRow', function() {
            $(this).closest('#inputFormTaglineRow').remove();
        });
    </script>

    <script type="text/javascript">
        // add row
        $("#addThumbnailRow").click(function() {
            var html = '';
            html +=
                '<input placeholder="Thumbnail" type="file" name="thumbnail[]" id="thumbnail" autocomplete="thumbnail" class="block w-full py-3 pl-5 mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">';

            $('#newThumbnailRow').append(html);
        });

        // remove row
        $(document).on('click', '#removeThumbnailRow', function() {
            $(this).closest('#inputFormThumbnailRow').remove();
        });
    </script>
@endpush
