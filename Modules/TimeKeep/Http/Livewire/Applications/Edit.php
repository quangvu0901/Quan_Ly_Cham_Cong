<?php

namespace Modules\TimeKeep\Http\Livewire\Applications;

use App\Models\application;
use Hungnm28\LaravelForm\Facades\LaravelForm;
use Hungnm28\LaravelForm\Traits\WithLaravelFormTrait;
use Livewire\Component;


class Edit extends Component
{
    use WithLaravelFormTrait;

    public $name, $salary_rate, $day_off, $note, $status= '1';

    protected function rules()
    {
        return [
            'name' => '',
			'salary_rate' => '',
			'day_off' => '',
			'note' => '',
			'status' => '',
			
        ];
    }

    public function mount()
    {
        $this->authorize("time-keep.applications.edit");
        $data = application::findOrFail($this->record_id);
        $this->name = $data->name;
		$this->salary_rate = $data->salary_rate;
		$this->day_off = $data->day_off;
		$this->note = $data->note;
		$this->status = $data->status;
		
    }

    public function updated($field)
    {
        $this->validateOnly($field);
    }

    public function store()
    {
        $this->authorize("time-keep.applications.edit");
        $this->validate();
        $data = application::findOrFail($this->record_id);
        $data->fill([
            'name' => $this->name,
			'salary_rate' => $this->salary_rate,
			'day_off' => $this->day_off,
			'note' => $this->note,
			'status' => $this->status,
			
        ]);
        if (!$data->clean) {
            $data->update();
            $this->redirectForm("time-keep.applications", $data->id);
        }
    }

    public function render()
    {
        lForm()->setTitle("Applications");
        lForm()->pushBreadcrumb(route("time-keep"),"Time Keep");
		lForm()->pushBreadcrumb(route("time-keep.applications"),"Applications");
		lForm()->pushBreadcrumb(route("time-keep.applications.edit",$this->record_id),"Edit");

        return view("time-keep::livewire.applications.edit")
            ->layout('time-keep::layouts.master', ['title' => 'Applications Edit']);
    }
}
