
@extends('layouts.app')

@section('title', 'Sample GPX Watermark')

@section('content')
    @if (session('status'))
        <div class="bg-yellow-200 border border-yellow-500 font-bold py-4 text-center">
            {{ session('status') }}
        </div>
    @endif

    <h1 class="mt-8 font-2xl font-bold border-b border-black pb-2 mb-6">Embed Watermark<h1>

    <form class="w-full max-w-lg" action="/embed" method="post">
        @csrf
        <div class="md:flex md:items-center mb-6">
            <div class="md:w-1/3">
                <label class="block text-gray-800 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">
                    Message
                </label>
            </div>
            <div class="md:w-2/3">
                <input class="appearance-none border border-gray-800 rounded w-full py-2 px-4 text-gray-900 leading-tight focus:outline-none focus:bg-yellow-200 focus:border-purple-500" id="inline-full-name" type="text" name="message" value="a.cooper2@lancaster.ac.uk">
            </div>
        </div>
        <div class="md:flex mb-6">
            <div class="md:w-1/3">
                <label class="block text-gray-800 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">
                    Method
                </label>
            </div>
            <div class="md:w-2/3">
                <label class="block"><input type="radio" name="method" value="blind"> Blind</label>
                <label class="block"><input type="radio" name="method" value="nonBlind" checked> Non Blind</label>
            </div>
        </div>
        <div class="md:flex mb-6">
            <div class="md:w-1/3">
                <label class="block text-gray-800 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">
                    Method
                </label>
            </div>
            <div class="md:w-2/3">
                @foreach ($source as $file)
                    <label class="block mb-2"><input type="radio" name="file" value="{{ basename($file) }}" checked> {{ basename($file) }}</label>
                @endforeach

                <button class="mt-6 shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit">Embed</button>
            </div>
        </div>

    </form>

    <h1 class="mt-8 font-2xl font-bold border-b border-black pb-2 mb-6">Output files<h1>
    <table>
        @foreach ($output as $file)
        <tr class="border-b">
            <td class="p-4">{{ $file }}</td>
            <td class="p-4">
                <a class="text-blue-500" href="/map?file={{ $file }}">View</a>
            </td>
        </tr>
        @endforeach
    </table>

@endsection