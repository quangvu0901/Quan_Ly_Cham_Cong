<?php

namespace Modules\Company\Http\Livewire\Emodules;

use App\Models\emodule;
use Hungnm28\LaravelForm\Facades\LaravelForm;
use Hungnm28\LaravelForm\Traits\WithLaravelFormTrait;
use Livewire\Component;


class Edit extends Component
{
    use WithLaravelFormTrait;

    public $name, $label, $slug, $icon, $permission;

    protected function rules()
    {
        return [
            'name' => 'string',
			'label' => '',
			'slug' => '',
			'icon' => '',
			'permission' => '',
			
        ];
    }

    public function mount()
    {
        $this->authorize("company.emodules.edit");
        $data = emodule::findOrFail($this->record_id);
        $this->name = $data->name;
		$this->label = $data->label;
		$this->slug = $data->slug;
		$this->icon = $data->icon;
		$this->permission = $data->permission;
		
    }

    public function updated($field)
    {
        $this->validateOnly($field);
    }

    public function store()
    {
        $this->authorize("company.emodules.edit");
        $this->validate();
        $data = emodule::findOrFail($this->record_id);
        $data->fill([
            'name' => $this->name,
			'label' => $this->label,
			'slug' => $this->slug,
			'icon' => $this->icon,
			'permission' => $this->permission,
			
        ]);
        if (!$data->clean) {
            $data->update();
            $this->redirectForm("company.emodules", $data->id);
        }
    }

    public function render()
    {
        lForm()->setTitle("Emodules");
        lForm()->pushBreadcrumb(route("company"),"Company");
		lForm()->pushBreadcrumb(route("company.emodules"),"Emodules");
		lForm()->pushBreadcrumb(route("company.emodules.edit",$this->record_id),"Edit");

        return view("company::livewire.emodules.edit")
            ->layout('company::layouts.master', ['title' => 'Emodules Edit']);
    }
}
