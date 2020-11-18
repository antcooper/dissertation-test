
@extends('layouts.app')

@section('title', 'Sample files')

@section('content')

    <table>
        @foreach ($files as $file)
        <tr class="border-b">
            <td class="p-4">{{ basename($file) }}</td>
            <td class="p-4">
                <a class="text-blue-500" href="/embed?file={{ basename($file) }}">Embed</a>
            </td>
        </tr>
        @endforeach
    </table>
@endsection