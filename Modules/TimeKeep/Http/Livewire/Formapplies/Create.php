<?php

namespace Modules\TimeKeep\Http\Livewire\Formapplies;

use App\Models\Application;
use App\Models\Company;
use App\Models\Department;
use App\Models\formapply;
use Hungnm28\LaravelForm\Facades\LaravelForm;
use Hungnm28\LaravelForm\Traits\WithLaravelFormTrait;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class   Create extends Component
{
    use WithLaravelFormTrait;

    public $user_id, $company_id, $department_id, $apply_id, $creator, $sensor, $from, $to, $reason, $status, $salary_rate, $total_dayoff, $day_off, $has_day, $days;
    protected $rules = [
        'user_id' => '',
		'company_id' => '',
		'department_id' => '',
		'apply_id' => '',
        'salary_rate' => '',
        'total_dayoff' => '',
        'day_off' => '',
        'has_day' => '',
		'creator' => '',
		'sensor' => '',
		'from' => '',
		'to' => '',
		'reason' => '',
		'status' => '',

    ];

    public function mount()
    {
        $this->authorize("time-keep.formapplies.create");
        $this->done = 1;
        $this->user_id = Auth::user()->id;
        $this->creator = Auth::user()->name;
        $days = $this->days;

    }

    public function updatedApplyId(){
        $allApply = Application::where("id",$this->apply_id)->get();
        foreach ($allApply as $key => $salary){
            $this->salary_rate = $salary->salary_rate;
        }
        foreach ($allApply as $key => $totalDayOff){
            $this->total_dayoff = $salary->day_off;
        }
    }

    public function updatedTo(){
        $day_from =  date('d',strtotime($this->from));
        $day_to =  date('d' ,strtotime($this->to));

        $dayFrom = intval($day_from);
        $dayTo = intval($day_to);
        $this->days = $dayTo - $dayFrom + 1;
    }

    public function updated($field)
    {
        $this->validateOnly($field);

    }

    public function store()
    {
        $this->authorize("time-keep.formapplies.create");
        $this->validate();
        $data = formapply::create([
            'user_id' => $this->user_id,
			'company_id' => Auth::user()->company_id,
			'department_id' => Auth::user()->department_id,
			'apply_id' => $this->apply_id,
			'creator' => $this->creator,
			'sensor' => $this->sensor,
			'from' => $this->from,
			'to' => $this->to,
			'reason' => $this->reason,
			'status' => $this->status,
        ]);

        if ($data) {
            $this->redirectForm("time-keep.formapplies", $data->id);
        }
    }

    public function render()
    {
        lForm()->setTitle("Formapplies");
        lForm()->pushBreadcrumb(route("time-keep"),"Time Keep");
		lForm()->pushBreadcrumb(route("time-keep.formapplies"),"Formapplies");
		lForm()->pushBreadcrumb(route("time-keep.formapplies.create"),"Create");
        $nameApply = Application::all()->pluck('name','id');
        $statusApply = [
          0 => 'Chờ duyệt',
          1 => 'Đã duyệt',
          2 => 'Không duyệt',
        ];
        $companyName = Company::where("id",Auth::user()->company_id)->get();
        foreach ($companyName as $key => $com){
            $this->company_id = $com->name;
        }
        $departmentName = Department::where("id",Auth::user()->department_id)->get();
        foreach ($departmentName as $key => $depart){
            $this->department_id = $depart->name;
        }


        return view("time-keep::livewire.formapplies.create",compact('nameApply','statusApply'))
            ->layout('time-keep::layouts.master', ['title' => 'Formapplies Create']);
    }
}
