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


class Edit extends Component
{
    use WithLaravelFormTrait;

    public $user_id, $company_id, $department_id, $apply_id, $creator, $sensor, $from, $to, $reason, $status, $salary_rate, $total_dayoff, $day_off, $has_day, $days;

    protected function rules()
    {
        return [
            'user_id' => '',
			'company_id' => '',
			'department_id' => '',
			'apply_id' => '',
			'creator' => '',
			'sensor' => '',
			'from' => '',
			'to' => '',
			'reason' => '',
			'status' => '',
        ];
    }

    public function mount()
    {
        $this->authorize("time-keep.formapplies.edit");
        $data = formapply::findOrFail($this->record_id);
        $this->user_id = $data->user_id;
        $companyName = Company::where("id",Auth::user()->company_id)->get();
        foreach ($companyName as $key => $com){
            $this->company_id = $com->name;
        }
        $departmentName = Department::where("id",Auth::user()->department_id)->get();
        foreach ($departmentName as $key => $depart){
            $this->department_id = $depart->name;
        }

		$this->apply_id = $data->apply_id;
        $apply = Application::where("id",$data->apply_id)->first();
        $this->salary_rate = $apply->salary_rate;
        $this->total_dayoff = $apply->day_off;
		$this->creator = $data->creator;
		$this->sensor = $data->sensor;
		$this->from = $data->from;
		$this->to = $data->to;
		$this->reason = $data->reason;
		$this->status = $data->status;

        $day_from =  date('d',strtotime($this->from));
        $day_to =  date('d' ,strtotime($this->to));
        $dayFrom = intval($day_from);
        $dayTo = intval($day_to);
        $this->days = $dayTo - $dayFrom + 1;

    }

    public function updatedTo(){
        $day_from =  date('d',strtotime($this->from));
        $day_to =  date('d' ,strtotime($this->to));

        $dayFrom = intval($day_from);
        $dayTo = intval($day_to);
        $this->days = $dayTo - $dayFrom + 1;
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

    public function updated($field)
    {
        $this->validateOnly($field);
    }

    public function store()
    {
        $this->authorize("time-keep.formapplies.edit");
        $this->validate();
        $data = formapply::findOrFail($this->record_id);
        $data->fill([
//          'user_id' => $this->user_id,
//			'company_id' => $this->company_id,
//			'department_id' => $this->department_id,
//			'apply_id' => $this->apply_id,
//            'salary_rate' => $this->salary_rate,
//            'total_dayoff' => $this->total_dayoff,
//            'day_off' => $this->day_off,
//            'has_day' => $this->has_day,
//			'creator' => $this->creator,
//			'sensor' => $this->sensor,
			'from' => $this->from,
			'to' => $this->to,
			'reason' => $this->reason,
			'status' => $this->status,

        ]);
        if (!$data->clean) {
            $data->update();
            $this->redirectForm("time-keep.formapplies", $data->id);
        }
    }

    public function render()
    {
        lForm()->setTitle("Formapplies");
        lForm()->pushBreadcrumb(route("time-keep"),"Time Keep");
		lForm()->pushBreadcrumb(route("time-keep.formapplies"),"Formapplies");
		lForm()->pushBreadcrumb(route("time-keep.formapplies.edit",$this->record_id),"Edit");

        $nameApply = Application::all()->pluck('name','id');
        $all = Application::all();

        $statusApply = [
            0 => 'Chờ duyệt',
            1 => 'Đã duyệt',
            2 => 'Không duyệt',
        ];
        return view("time-keep::livewire.formapplies.edit",compact('nameApply','statusApply','all'))
            ->layout('time-keep::layouts.master', ['title' => 'Formapplies Edit']);
    }
}
