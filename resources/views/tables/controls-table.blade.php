<!-- resources/views/filament/components/controls-table.blade.php -->
@if($controls)

    <table class="w-full text-sm text-left rtl:text-right text-black dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
            <th scope="col" class="border px-4 py-2">Code</th>
            <th scope="col" class="border px-4 py-2">Title</th>
            <th scope="col" class="border px-4 py-2">description</th>
            </tr>
        </thead>
        <tbody>

        @foreach ($controls as $control)
        <tr>
            <td class="border px-4 py-2"> {{ $control->code }}</1234td>
            <td class="border px-4 py-2">{{ $control->title }}</td>
            <td class="border px-4 py-2"> {!! $control->description !!} </td>
            </tr>
        @endforeach

        </tbody>
        </table>
@else
    <p>No sub-controls.</p>
@endif
