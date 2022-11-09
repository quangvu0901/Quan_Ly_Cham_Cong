<?php

namespace Modules\Company\Http\Livewire\Departments;

use App\Models\Company;
use App\Models\department;
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
		"company_id" => ["status" => true, "label" => "Company Id"],
		"parent_id" => ["status" => true, "label" => "Parent Id"],
		"root_id" => ["status" => true, "label" => "Root Id"],
		"created_at" => ["status" => true, "label" => "Created At"],
		"updated_at" => ["status" => true, "label" => "Updated At"],
		
    ];

    public function mount()
    {
        $this->authorize("company.departments.listing");
    }

    function delete()
    {
        $this->authorize("company.departments.delete");
        if ($this->confirm > 0) {
            department::destroy($this->confirm);
        }
        $this->confirm = 0;
        $this->dispatchBrowserEvent('warning', 'Departments successfully destroyed.');
    }

    public function render()
    {
        $data = new department();

        if ($this->fId > 0) {
            $data = $data->whereId($this->fId);
        }
        if ($this->sId == 1) {
            $data = $data->orderBy("id");
        }
        if ($this->sId == 2) {
            $data = $data->orderByDesc("id");
        }
        $data = $data->with('company')->with('parent')->paginate(30);

        lForm()->setTitle("Departments");
        lForm()->pushBreadcrumb(route("company"),"Company");
		lForm()->pushBreadcrumb(route("company.departments"),"Departments");
        return view("company::livewire.departments.listing", ['data' => $data])
            ->layout('company::layouts.master', ['title' => 'Departments Create']);
    }
}
