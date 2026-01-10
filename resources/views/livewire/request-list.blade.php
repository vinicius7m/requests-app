<div>
    <h1 class="text-xl font-bold mb-4">Minhas solicitações</h1>

    <select wire:model.live="status" class="border rounded p-2 mb-4">
        <option value="all">Todas</option>
        <option value="open">Abertas</option>
        <option value="approved">Aprovadas</option>
        <option value="rejected">Rejeitadas</option>
    </select>

    <p>Status atual: {{ $status }}</p>


    @if($requests->count())
        <ul class="space-y-2">
            @foreach($requests as $request)
                <p>{{ $requests->count() }}</p>
                <li class="border p-3 rounded">
                    <strong>{{ $request->title }}</strong>
                    <p>{{ $request->description }}</p>
                    <span class="text-sm text-gray-500">
                        {{ ucfirst($request->status) }}
                    </span>
                </li>
            @endforeach
        </ul>

        <div class="mt-4">
            {{ $requests->links() }}
        </div>
    @else
        <p class="text-gray-500">Nenhuma solicitação encontrada.</p>
    @endif
</div>
