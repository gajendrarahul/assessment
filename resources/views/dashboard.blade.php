<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @if(Session::has('success'))
                <p class="alert alert-success">{{ Session::get('success') }}</p>
                <script>
                    toastr.options = {
                        "closeButton": true,
                        "progressBar": true
                    }
                    toastr.success('Page Loaded!');
                </script>
                @endif
                @if(Session::has('error'))
                <p class="alert alert-success">{{ Session::get('error') }}</p>
                @endif
                <div class="p-6 text-gray-900">
                    <div class="buttons flex justify-end">
                        <div class="upload-form my-4 flex-end">
                            <form action="{{ route('upload.json_file') }}" method="post" enctype="multipart/form-data"
                                class="flex ">
                                @csrf
                                <input type="file" accept="application/json" name="json_file"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <button type="submit"
                                    class="bg-blue-500 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 ml-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">Upload</button>
                            </form>
                            @error('json_file')
                            <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3 w-8/12">
                                        <!-- col-8 -->
                                        File
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        <!-- col-4 -->
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($jsonFiles as $jsonFile)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td scope="col"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $jsonFile->file_path }}
                                    </td>
                                    <td scope="col" class="px-6 py-4">
                                        <div class="export-btn my-4">
                                            <a href="{{ route('export.to.excel',['json_file_id'=>$jsonFile->id]) }}"
                                                class="bg-blue-500 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 ml-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                Export To Excel
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @empty

                                @endforelse
                            </tbody>
                        </table>
                    </div>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>