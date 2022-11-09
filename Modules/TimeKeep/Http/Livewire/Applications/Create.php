<?php

namespace Modules\TimeKeep\Http\Livewire\Applications;

use App\Models\application;
use Hungnm28\LaravelForm\Facades\LaravelForm;
use Hungnm28\LaravelForm\Traits\WithLaravelFormTrait;
use Livewire\Component;

class   Create extends Component
{
    use WithLaravelFormTrait;

    public $name, $salary_rate, $day_off, $note, $status= '1';
    protected $rules = [
        'name' => '',
		'salary_rate' => '',
		'day_off' => '',
		'note' => '',
		'status' => '',
		
    ];

    public function mount()
    {
        $this->authorize("time-keep.applications.create");
        $this->done = 1;
    }

    public function updated($field)
    {
        $this->validateOnly($field);
    }

    public function store()
    {
        $this->authorize("time-keep.applications.create");
        $this->validate();
        $data = application::create([
            'name' => $this->name,
			'salary_rate' => $this->salary_rate,
			'day_off' => $this->day_off,
			'note' => $this->note,
			'status' => $this->status,
			
        ]);
        if ($data) {
            $this->redirectForm("time-keep.applications", $data->id);
        }
    }

    public function render()
    {
        lForm()->setTitle("Applications");
        lForm()->pushBreadcrumb(route("time-keep"),"Time Keep");
		lForm()->pushBreadcrumb(route("time-keep.applications"),"Applications");
		lForm()->pushBreadcrumb(route("time-keep.applications.create"),"Create");
		
        return view("time-keep::livewire.applications.create")
            ->layout('time-keep::layouts.master', ['title' => 'Applications Create']);
    }
}
