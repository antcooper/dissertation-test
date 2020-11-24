
@extends('layouts.app')

@section('title', 'Sample files')

@section('content')
    @if (session('status'))
        <div class="bg-yellow-200 border border-yellow-500 font-bold py-4 text-center">
            {{ session('status') }}
        </div>
    @endif

    <h1 class="mt-8 font-xl font-bold">Source files<h1>
    <table>
        @foreach ($source as $file)
        <tr class="border-b">
            <td class="p-4">{{ basename($file) }}</td>
            <td class="p-4">
                <a class="text-blue-500" href="{{ preg_replace('/(.*public)/i','', $file) }}">View</a>
                | <a class="text-blue-500" href="/embed?file={{ basename($file) }}&amp;method=blind">Blind Embed</a>
                | <a class="text-blue-500" href="/embed?file={{ basename($file) }}&amp;method=nonBlind">Non-Blind Embed</a>
            </td>
        </tr>
        @endforeach
    </table>

    <h1 class="mt-8 font-xl font-bold">Output files<h1>
    <table>
        @foreach ($output as $file)
        <tr class="border-b">
            <td class="p-4">{{ $file }}</td>
            <td class="p-4">
                <a class="text-blue-500" href="{{ $file }}">View</a>
                | <a class="text-blue-500" href="/blindExtract?file={{ $file }}">Blind Extract</a>
                | <a class="text-blue-500" href="/nonBlindExtract?file={{ $file }}">Non-Blind Extract</a>
            </td>
        </tr>
        @endforeach
    </table>

@endsection