<?php

namespace Modules\Company\Http\Livewire\Departments;

use App\Models\department;
use Hungnm28\LaravelForm\Traits\WithLaravelFormTrait;
use Livewire\Component;


class Show extends Component
{
    use WithLaravelFormTrait;

    public function mount()
    {
        $this->authorize("company.departments.show");
        department::findOrFail($this->record_id);
    }

    public function render()
    {
        $data =  department::findOrFail($this->record_id);
        lForm()->setTitle("Departments");
        lForm()->pushBreadcrumb(route("company"),"Company");
		lForm()->pushBreadcrumb(route("company.departments"),"Departments");
		lForm()->pushBreadcrumb(route("company.departments.show",$this->record_id),"Show");

        return view("company::livewire.departments.show", compact("data"))
            ->layout('company::layouts.master', ['title' => 'Departments Show']);
    }
}
