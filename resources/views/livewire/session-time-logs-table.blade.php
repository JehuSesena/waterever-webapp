<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <button wire:click="loadSessionTimeLogs" type="button" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">Recargar</button>
    <table class="w-full text-sm text-left text-gray-500">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Nombre del usuario
                </th>
                <th scope="col" class="px-6 py-3">
                    Tiempo de inicio
                </th>
                <th scope="col" class="px-6 py-3">
                    Tiempo de fin
                </th>
                <th scope="col" class="px-6 py-3">
                    Duración
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sessionTimeLogs as $key => $sessionTimeLog)
                @if ($key % 2 == 0)
                    <tr class="bg-white border-b">
                @else
                    <tr class="border-b bg-gray-50">
                @endif
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                    {{ $sessionTimeLog->user->name }}
                </th>
                <td class="px-6 py-4">
                    {{ $sessionTimeLog->start_time }}
                </td>
                <td class="px-6 py-4">
                    {{ $sessionTimeLog->end_time }}
                </td>
                <td class="px-6 py-4">
                    {{ $sessionTimeLog->duration }}s
                </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
