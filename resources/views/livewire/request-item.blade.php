<div>
    <li class="border p-3 rounded flex justify-between items-start">
        <div>
            <strong>{{ $request->title }}</strong>
            <p class="text-sm text-gray-700">{{ $request->description }}</p>

            <span class="text-xs text-gray-500">
                {{ ucfirst($request->status) }}
            </span>
        </div>

        @if ($request->status === 'open')
            <button
                wire:click="openCancelModal"
                class="text-red-600 hover:underline text-sm"
            >
                Cancelar
            </button>
        @endif

        {{-- MODAL --}}

        @if($showConfirmModal)
        <div class="fixed inset-0 bg-black/40 flex items-center justify-center z-50">
            <div class="bg-white rounded-lg p-6 w-full max-w-md">
                <h2 class="text-lg font-semibold mb-2">
                    Cancelar solicitação
                </h2>

                <p class="text-sm text-gray-600 mb-4">
                    Tem certeza que deseja cancelar esta solicitação?
                </p>

                <div class="flex justify-end gap-2">
                    <button
                        wire:click="$set('showConfirmModal', false)"
                        class="px-4 py-2 border rounded"
                    >
                        Voltar
                    </button>

                    <button
                        wire:click="cancel"
                        wire:loading.attr="disabled"
                        class="px-4 py-2 bg-red-600 text-white rounded"
                    >
                        <span wire:loading.remove>Confirmar</span>
                        <span wire:loading>Cancelando...</span>
                    </button>
                </div>
            </div>
        </div>
        @endif
    </li>
</div>
