<div class="max-w-5xl mx-auto px-4 py-6">
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
            <a href="{{ route('request.create') }}"
                class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">

                <svg xmlns="http://www.w3.org/2000/svg"
                    class="h-5 w-5"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 4v16m8-8H4"/>
                </svg>

                <span>Nova Solicitação</span>
            </a>

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
</div>