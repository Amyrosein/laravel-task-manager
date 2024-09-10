<x-app-layout>
    <div class="py-12">
        <div class="max-w-9xl mx-auto sm:px-6 lg:px-8">
            <!-- Edit Task Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="w-full flex justify-between flex-col">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>
                                            <div class="bg-red-100 border-l-4 border-orange-500 text-orange-700 p-4"
                                                 role="alert">
                                                <p class="font-bold">{{ $error }}</p>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif


                        <!-- edit task -->
                        <div class="w-full">
                            <form
                                action="{{ route('admin.pages.update', [$page]) }}"
                                method="POST">
                                @method('PUT')
                                @csrf

                                <div class="mb-4">
                                    {{ __('Edit Page') }} {{ $page->title }}
                                    <hr>
                                </div>

                                @if(session('message'))
                                    <div
                                        class="flex items-center bg-blue-500 text-white text-sm font-bold px-4 py-3"
                                        role="alert">
                                        <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg"
                                             viewBox="0 0 20 20">
                                            <path
                                                d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/>
                                        </svg>
                                        <p>{{ session('message') }}</p>
                                    </div>
                                    <br>
                                @endif
                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                                        {{ __('Title') }}
                                    </label>
                                    <input value="{{ $page->title }}" name="title" id="title" type="text"

                                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                </div>
                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="content-textarea">
                                        {{ __('Content') }}
                                    </label>
                                    <textarea name="content" id="content-textarea"
                                              rows="5"
                                              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ $page->content }}</textarea>
                                </div>
                                <div class="flex items-center justify-between">
                                    <x-primary-button>
                                        {{ __('Save Page') }}
                                    </x-primary-button>

                                </div>
                            </form>
                        </div>
                        <!-- end of edit task -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    @section('scripts')
        <script type="module">
            import {
                ClassicEditor,
                FileRepository,
                Autoformat,
                Bold,
                Italic,
                Underline,
                BlockQuote,
                CloudServices,
                Essentials,
                Heading,
                Image,
                ImageCaption,
                ImageResize,
                ImageStyle,
                ImageToolbar,
                ImageUpload,
                PictureEditing,
                Indent,
                IndentBlock,
                Link,
                List,
                MediaEmbed,
                Mention,
                Paragraph,
                PasteFromOffice,
                Table,
                TableColumnResize,
                TableToolbar,
                TextTransformation,
            } from 'ckeditor5';

           ClassicEditor
                .create(document.querySelector('#content-textarea'), {
                    plugins: [
                        FileRepository,
                        Autoformat,
                        BlockQuote,
                        Bold,
                        CloudServices,
                        Essentials,
                        Heading,
                        Image,
                        ImageCaption,
                        ImageResize,
                        ImageStyle,
                        ImageToolbar,
                        ImageUpload,
                        Indent,
                        IndentBlock,
                        Italic,
                        Link,
                        List,
                        MediaEmbed,
                        Mention,
                        Paragraph,
                        PasteFromOffice,
                        PictureEditing,
                        Table,
                        TableColumnResize,
                        TableToolbar,
                        TextTransformation,
                        Underline,
                        SimpleUploadAdapterPlugin,
                    ],
                    toolbar: [
                        'bold',
                        'italic',
                        'underline',
                        '|',
                        'link',
                        'uploadImage',
                        'insertTable',
                        'blockQuote',
                        'mediaEmbed',
                        '|',
                        'bulletedList',
                        'numberedList',
                        '|',
                        'outdent',
                        'indent',
                    ],
                })
                .catch(error => console.error(error))
        </script>
    @endsection
</x-app-layout>
