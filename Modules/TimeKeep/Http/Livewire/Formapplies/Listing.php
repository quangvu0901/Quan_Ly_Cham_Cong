<?php

namespace Modules\TimeKeep\Http\Livewire\Formapplies;

use App\Models\Application;
use App\Models\Company;
use App\Models\Department;
use App\Models\formapply;
use Hungnm28\LaravelForm\Traits\WithLaravelFormTrait;
use Illuminate\Support\Facades\Auth;
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
		"user_id" => ["status" => true, "label" => "User Id"],
		"company_id" => ["status" => true, "label" => "Company Id"],
		"department_id" => ["status" => true, "label" => "Department Id"],
		"apply_id" => ["status" => true, "label" => "Apply Id"],
		"creator" => ["status" => true, "label" => "Creator"],
		"sensor" => ["status" => true, "label" => "Sensor"],
		"from" => ["status" => true, "label" => "From"],
		"to" => ["status" => true, "label" => "To"],
		"reason" => ["status" => true, "label" => "Reason"],
		"status" => ["status" => true, "label" => "Status"],
		"created_at" => ["status" => true, "label" => "Created At"],
		"updated_at" => ["status" => true, "label" => "Updated At"],

    ];

    public function mount()
    {
        $this->authorize("time-keep.formapplies.listing");

    }

    function delete()
    {
        $this->authorize("time-keep.formapplies.delete");
        if ($this->confirm > 0) {
            formapply::destroy($this->confirm);
        }
        $this->confirm = 0;
        $this->dispatchBrowserEvent('warning', 'Formapplies successfully destroyed.');
    }

    public function render()
    {
        $data = new formapply();

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

        lForm()->setTitle("Formapplies");
        lForm()->pushBreadcrumb(route("time-keep"),"Time Keep");
		lForm()->pushBreadcrumb(route("time-keep.formapplies"),"Formapplies");


        $companyName = Company::where("id",Auth::user()->company_id)->get();
        $departmentName = Department::where("id",Auth::user()->department_id)->get();

        return view("time-keep::livewire.formapplies.listing", compact("data",'companyName','departmentName'))
            ->layout('time-keep::layouts.master', ['title' => 'Formapplies Listing']);
    }
}
