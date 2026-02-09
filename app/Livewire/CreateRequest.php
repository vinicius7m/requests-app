<?php

namespace App\Livewire;

use App\Models\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CreateRequest extends Component
{
    public string $title = ''; // o front só reflete esse estado
    public string $description = '';
    public string $category = '';

    protected function rules(): array
    {
        return [
            'title' => 'required|min:3',
            'description' => 'required|min:10',
            'category' => 'required',
        ];
    }

    public function save()
    {
        $this->validate();

        Request::create([
            'title' => $this->title,
            'description' => $this->description,
            'category' => $this->category,
            'user_id' => Auth::user()->id,
        ]);

        return redirect()
            ->route('requests.list')
            ->with('toast', [
                'message' => 'Solicitação criada com sucesso!',
                'type' => 'success'
            ]);
    }

    public function render()
    {
        return view('livewire.create-request')
            ->layout('components.layouts.app');
    }
}
