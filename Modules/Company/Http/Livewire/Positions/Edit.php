<?php

namespace Modules\Company\Http\Livewire\Positions;

use App\Models\Company;
use App\Models\position;
use Hungnm28\LaravelForm\Facades\LaravelForm;
use Hungnm28\LaravelForm\Traits\WithLaravelFormTrait;
use Livewire\Component;


class Edit extends Component
{
    use WithLaravelFormTrait;

    public $name, $company_id, $level;

    protected function rules()
    {
        return [
            'name' => 'required|string|min:6',
			'company_id' => '',
			'level' => 'required',
			
        ];
    }

    public function mount()
    {
        $this->authorize("company.positions.edit");
        $data = position::findOrFail($this->record_id);
        $this->name = $data->name;
		$this->company_id = $data->company_id;
		$this->level = $data->level;
		
    }

    public function updated($field)
    {
        $this->validateOnly($field);
    }

    public function store()
    {
        $this->authorize("company.positions.edit");
        $this->validate();
        $data = position::findOrFail($this->record_id);
        $data->fill([
            'name' => $this->name,
			'company_id' => $this->company_id,
			'level' => $this->level,
			
        ]);
        if (!$data->clean) {
            $data->update();
            $this->redirectForm("company.positions", $data->id);
        }
    }

    public function render()
    {
        lForm()->setTitle("Positions");
        lForm()->pushBreadcrumb(route("company"),"Company");
		lForm()->pushBreadcrumb(route("company.positions"),"Positions");
		lForm()->pushBreadcrumb(route("company.positions.edit",$this->record_id),"Edit");
        $companies = Company::select(Company::$listFields)->pluck("name", "id");
        return view("company::livewire.positions.edit", ['companies' => $companies])
            ->layout('company::layouts.master', ['title' => 'Positions Edit']);
    }
}
