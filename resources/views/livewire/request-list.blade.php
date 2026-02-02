<div class="space-y-6">

    {{-- CABEÇALHO --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">
                Minhas solicitações
            </h1>
            <p class="text-sm text-gray-600 dark:text-gray-400">
                {{ $requests->total() }} solicitações encontradas
            </p>
        </div>

        <select
            wire:model.live="status"
            class="border rounded-lg px-3 py-2 text-sm text-gray-400 dark:bg-gray-800 dark:border-gray-700"
        >
            <option value="all">Todas</option>
            <option value="open">Abertas</option>
            <option value="approved">Aprovadas</option>
            <option value="rejected">Rejeitadas</option>
            <option value="cancelled">Canceladas</option>
        </select>
    </div>

    {{-- LISTA --}}
    @if($requests->count())
        <ul class="space-y-4">
            @foreach($requests as $request)
                <livewire:request-item
                    :request="$request"
                    :key="$request->id"
                />
            @endforeach
        </ul>

        <div class="pt-4">
            {{ $requests->links() }}
        </div>
    @else
        <div class="bg-white dark:bg-gray-800 border rounded-lg p-6 text-center">
            <p class="text-gray-500">Nenhuma solicitação encontrada.</p>
        </div>
    @endif

</div>
