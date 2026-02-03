<li class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-5 shadow-sm hover:shadow-md transition">
    <div class="flex justify-between gap-6">

        {{-- CONTEÚDO --}}
        <div class="flex-1 space-y-2">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                {{ $request->title }}
            </h3>

            <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">
                {{ $request->description }}
            </p>

            <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">
                Autor: {{ $request->user()->first()->name }}
            </p>

            <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">
                Categoria: {{ $request->category->label() }}
            </p>

            {{-- STATUS --}}
            <span
                class="inline-flex items-center gap-1 text-xs font-medium px-2.5 py-1 rounded-full
                {{ $request->status->color() }} bg-opacity-10"
            >
                ● {{ $request->status->label() }}
            </span>
        </div>

        {{-- AÇÕES --}}
        @if ($request->status->value === 'open')
            <div class="flex flex-col gap-2 items-end">
                @can('cancel', $request)
                    <button
                        wire:click="openCancelModal"
                        class="inline-flex items-center gap-1 text-sm text-gray-400 hover:text-gray-700 font-medium"
                    >
                        {{-- ícone X --}}
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Cancelar
                    </button>
                @endcan

                @can('manage', $request)
                    <button
                        wire:click="openApproveModal"
                        class="inline-flex items-center gap-1 text-sm text-green-600 hover:text-green-700 font-medium"
                    >
                        {{-- ícone check --}}
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 13l4 4L19 7" />
                        </svg>
                        Aprovar
                    </button>

                    <button
                        wire:click="openRejectModal"
                        class="inline-flex items-center gap-1 text-sm text-red-600 hover:text-red-700 font-medium"
                    >
                        {{-- ícone check --}}
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Reprovar
                    </button>
                @endcan
            </div>
        @endif
    </div>

    {{-- MODAL --}}
    @if($showConfirmModal)
        <div class="fixed inset-0 bg-black/50 flex items-center justify-center z-50">
            <div class="bg-white dark:bg-gray-800 rounded-xl p-6 w-full max-w-md shadow-lg">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-2">
                    Cancelar solicitação
                </h2>

                <p class="text-sm text-gray-600 dark:text-gray-400 mb-6">
                    Tem certeza que deseja cancelar esta solicitação? Essa ação não poderá ser desfeita.
                </p>

                <div class="flex justify-end gap-3">
                    <button
                        wire:click="$set('showConfirmModal', false)"
                        class="px-4 py-2 text-sm border rounded-lg dark:border-gray-600"
                    >
                        Voltar
                    </button>

                    <button
                        wire:click="cancel"
                        wire:loading.attr="disabled"
                        class="px-4 py-2 text-sm bg-red-600 hover:bg-red-700 text-white rounded-lg"
                    >
                        <span wire:loading.remove>Confirmar cancelamento</span>
                        <span wire:loading>Cancelando...</span>
                    </button>
                </div>
            </div>
        </div>
    @endif

    @if($showReviewModal)
        <div class="fixed inset-0 bg-black/50 flex items-center justify-center z-50">
            <div class="bg-white rounded-lg p-6 w-full max-w-md">
                <h2 class="text-lg font-semibold mb-2">
                    {{ $action === 'approve' ? 'Aprovar solicitação' : 'Rejeitar solicitação' }}
                </h2>

                <textarea
                    wire:model.defer="comment"
                    class="w-full border rounded p-2 text-sm"
                    rows="3"
                    placeholder="Comentário (opcional para aprovação)"
                ></textarea>

                @error('comment')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror

                <div class="flex justify-end gap-2 mt-4">
                    <button
                        wire:click="$set('showReviewModal', false)"
                        class="px-4 py-2 border rounded"
                    >
                        Cancelar
                    </button>

                    <button
                        wire:click="confirmReview"
                        class="px-4 py-2 bg-indigo-600 text-white rounded"
                    >
                        Confirmar
                    </button>
                </div>
            </div>
        </div>
    @endif

</li>