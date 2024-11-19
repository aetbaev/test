<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet"/>

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet"/>
</head>
<body class="antialiased">
<div class="max-w-md mx-auto">

    @if(session('success'))
        <div class="p-4 my-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
             role="alert">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('store') }}" method="POST" class="mt-2">
        @csrf
        <div class="mb-5">
            <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Текст
                сообщения</label>
            <textarea id="message"
                      name="message"
                      rows="4"
                      class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>
        </div>
        <div class="mb-5">
            <label for="phones" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Номера телефонов,
                каждый с новой строки</label>
            <textarea id="phones"
                      name="phones"
                      rows="4"
                      class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>
        </div>
        <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Создать рассылку
        </button>
    </form>

    <h1 class="mt-5">Список рассылок</h1>

    <div class="relative overflow-x-auto mt-5">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Текст
                </th>
                <th scope="col" class="px-6 py-3">
                    Получатели
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($broadcasts as $broadcast)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ $broadcast->message }}
                </th>
                <td class="px-6 py-4">
                    {{ $broadcast->recipients_count }}
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
