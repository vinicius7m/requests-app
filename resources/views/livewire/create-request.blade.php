<div>
    <form wire:submit.prevent="save" class="space-y-4">

        <div>
            <label for="">Título</label>
            <input type="text" wire:model.defer="title">
            @error('title') <span>{{ $message }}</span> @enderror
        </div>

        <div>
            <label>Descrição</label>
            <textarea wire:model.defer="description"></textarea>
            @error('description') <span>{{ $message }}</span> @enderror
        </div>

        <div>
            <label>Categoria</label>
            <select wire:model.defer="category" name="" id="">
                <option value="">Selecione</option>
                <option value="ti">TI</option>
                <option value="financeiro">Financeiro</option>
                <option value="manutencao">Manutenção</option>
            </select>
            @error('category') <span>{{ $message }}</span> @enderror
        </div>

        <button type="submit">
            Enviar solicitação
        </button>

        @if (session()->has('success'))
            <p>{{ session('success') }}</p>
        @endif
    </form>
</div>
