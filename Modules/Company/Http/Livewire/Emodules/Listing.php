<?php

namespace Modules\Company\Http\Livewire\Emodules;

use App\Models\emodule;
use Hungnm28\LaravelForm\Traits\WithLaravelFormTrait;
use Livewire\Component;

class Listing extends Component
{
    use WithLaravelFormTrait;

    public $confirm = 0;
    // Filter
    public $fId;
    // Sort
    public $sId = 0;
    public $fields = [
        "id" => ["status" => true, "label" => "Id"],
		"name" => ["status" => true, "label" => "Name"],
		"label" => ["status" => true, "label" => "Label"],
		"slug" => ["status" => true, "label" => "Slug"],
		"icon" => ["status" => true, "label" => "Icon"],
		"permission" => ["status" => true, "label" => "Permission"],
		"created_at" => ["status" => true, "label" => "Created At"],
		"updated_at" => ["status" => true, "label" => "Updated At"],
		
    ];

    public function mount()
    {
        $this->authorize("company.emodules.listing");
    }

    function delete()
    {
        $this->authorize("company.emodules.delete");
        if ($this->confirm > 0) {
            emodule::destroy($this->confirm);
        }
        $this->confirm = 0;
        $this->dispatchBrowserEvent('warning', 'Emodules successfully destroyed.');
    }

    public function render()
    {
        $data = new emodule();

        if ($this->fId > 0) {
            $data = $data->whereId($this->fId);
        }
        if ($this->sId == 1) {
            $data = $data->orderBy("id");
        }
        if ($this->sId == 2) {
            $data = $data->orderByDesc("id");
        }
        $data = $data->paginate(30);

        lForm()->setTitle("Emodules");
        lForm()->pushBreadcrumb(route("company"),"Company");
		lForm()->pushBreadcrumb(route("company.emodules"),"Emodules");
		
        return view("company::livewire.emodules.listing", compact("data"))
            ->layout('company::layouts.master', ['title' => 'Emodules Create']);
    }
}
