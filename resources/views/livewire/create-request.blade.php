<div class="min-h-screen bg-slate-900 py-10">
    <div class="max-w-2xl mx-auto px-4">
        <form wire:submit.prevent="save" class="bg-slate-800 border border-slate-700 rounded-xl shadow-lg p-6">
            <div class="mb-6">
                <h1 class="text-xl font-semibold text-white">
                    Nova Solicitação
                </h1>
                <p class="text-sm text-slate-400">
                    Preencha os dados abaixo para enviar sua solicitação
                </p>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-slate-300 mb-1">
                    Título
                </label>

                <input type="text"
                    wire:model.defer="title"
                    class="w-full rounded-lg bg-slate-900 border-slate-700 text-white
                        focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Ex: Solicitação de equipamento">
                @error('title') <span class="text-sm text-slate-400">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-slate-300 mb-1">
                    Descrição
                </label>

                <textarea wire:model.defer="description"
                    rows="4"
                    class="w-full rounded-lg bg-slate-900 border-slate-700 text-white
                            focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Explique o motivo da solicitação">
                </textarea>
                @error('description') <span class="text-sm text-slate-400">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-slate-300 mb-1">
                    Categoria
                </label>
                <select
                    class="w-full rounded-lg bg-slate-900 border-slate-700 text-white
                        focus:ring-blue-500 focus:border-blue-500"
                    wire:model.defer="category"
                    name=""
                    id=""
                >
                    <option value="">Selecione</option>
                    <option value="ti">TI</option>
                    <option value="financeiro">Financeiro</option>
                    <option value="manutencao">Manutenção</option>
                </select>
                @error('category') <span class="text-sm text-slate-400">{{ $message }}</span> @enderror
            </div>

            <div class="flex justify-end">
                <button
                    wire:loading.attr="disabled"
                    type="submit"
                    class="inline-flex items-center gap-2 px-6 py-2.5
                        bg-blue-600 hover:bg-blue-700
                        text-white font-medium rounded-lg
                        transition
                        opacity-100 wire:loading:opacity-70"
                >

                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 4v16m8-8H4"/>
                    </svg>

                    Enviar solicitação
                </button>
            </div>

            @if (session()->has('success'))
                <p>{{ session('success') }}</p>
            @endif

        </form>
    </div>
</div>