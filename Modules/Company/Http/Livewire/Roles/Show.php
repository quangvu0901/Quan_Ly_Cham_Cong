<?php

namespace Modules\Company\Http\Livewire\Roles;

use App\Models\role;
use Hungnm28\LaravelForm\Traits\WithLaravelFormTrait;
use Livewire\Component;


class Show extends Component
{
    use WithLaravelFormTrait;

    public function mount()
    {
        $this->authorize("company.roles.show");
        role::findOrFail($this->record_id);
    }

    public function render()
    {
        $data =  role::findOrFail($this->record_id);
        lForm()->setTitle("Roles");
        lForm()->pushBreadcrumb(route("company"),"Company");
		lForm()->pushBreadcrumb(route("company.roles"),"Roles");
		lForm()->pushBreadcrumb(route("company.roles.show",$this->record_id),"Show");

        return view("company::livewire.roles.show", compact("data"))
            ->layout('company::layouts.master', ['title' => 'Roles Show']);
    }
}
