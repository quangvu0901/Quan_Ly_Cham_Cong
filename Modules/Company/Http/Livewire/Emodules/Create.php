<?php

namespace Modules\Company\Http\Livewire\Emodules;

use App\Models\emodule;
use Hungnm28\LaravelForm\Facades\LaravelForm;
use Hungnm28\LaravelForm\Traits\WithLaravelFormTrait;
use Livewire\Component;

class   Create extends Component
{
    use WithLaravelFormTrait;

    public $name, $label, $slug, $icon, $permission;
    protected $rules = [
        'name' => 'string',
		'label' => '',
		'slug' => '',
		'icon' => '',
		'permission' => '',
		
    ];

    public function mount()
    {
        $this->authorize("company.emodules.create");
        $this->done = 1;
    }

    public function updated($field)
    {
        $this->validateOnly($field);
    }

    public function store()
    {
        $this->authorize("company.emodules.create");
        $this->validate();
        $data = emodule::create([
            'name' => $this->name,
			'label' => $this->label,
			'slug' => $this->slug,
			'icon' => $this->icon,
			'permission' => $this->permission,
			
        ]);
        if ($data) {
            $this->redirectForm("company.emodules", $data->id);
        }
    }

    public function render()
    {
        lForm()->setTitle("Emodules");
        lForm()->pushBreadcrumb(route("company"),"Company");
		lForm()->pushBreadcrumb(route("company.emodules"),"Emodules");
		lForm()->pushBreadcrumb(route("company.emodules.create"),"Create");
		
        return view("company::livewire.emodules.create")
            ->layout('company::layouts.master', ['title' => 'Emodules Create']);
    }
}
