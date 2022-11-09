<?php

namespace Modules\Company\Http\Livewire\Positions;

use App\Models\position;
use Hungnm28\LaravelForm\Traits\WithLaravelFormTrait;
use Livewire\Component;


class Show extends Component
{
    use WithLaravelFormTrait;

    public function mount()
    {
        $this->authorize("company.positions.show");
        position::findOrFail($this->record_id);
    }

    public function render()
    {
        $data =  position::findOrFail($this->record_id);
        lForm()->setTitle("Positions");
        lForm()->pushBreadcrumb(route("company"),"Company");
		lForm()->pushBreadcrumb(route("company.positions"),"Positions");
		lForm()->pushBreadcrumb(route("company.positions.show",$this->record_id),"Show");

        return view("company::livewire.positions.show", compact("data"))
            ->layout('company::layouts.master', ['title' => 'Positions Show']);
    }
}
