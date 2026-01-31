<div>
    <h1 class="text-xl font-bold mb-4">Minhas solicitações</h1>

    <select wire:model.live="status" class="border rounded p-2 mb-4">
        <option value="all">Todas</option>
        <option value="open">Abertas</option>
        <option value="approved">Aprovadas</option>
        <option value="rejected">Rejeitadas</option>
        <option value="cancelled">Canceladas</option>
    </select>

    <p>Status atual: {{ $status }}</p>
    <p>{{ $requests->count() }}</p>

    @if($requests->count())
        <ul class="space-y-2">
            @foreach($requests as $request)
                {{-- Chamada do componente --}}
                <livewire:request-item
                    :request="$request"
                    :key="$request->id"
                />
            @endforeach
        </ul>

        <div class="mt-4">
            {{ $requests->links() }}
        </div>
    @else
        <p class="text-gray-500">Nenhuma solicitação encontrada.</p>
    @endif
</div>
