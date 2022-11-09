<?php

namespace Modules\Company\Http\Livewire\Companies;

use App\Models\company;
use Hungnm28\LaravelForm\Facades\LaravelForm;
use Hungnm28\LaravelForm\Traits\WithLaravelFormTrait;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class   Create extends Component
{
    use WithLaravelFormTrait;
    use WithFileUploads;
    public $name, $slug, $teaser, $logo_file, $logo_url, $address, $phone, $parent_id=0, $active= 1;
    protected $rules = [
        'name' => 'required|string|min:6',
		'slug' => 'required|string|min:6',
		'teaser' => 'required|string|min:6',
		'address' => 'required|string|min:6',
		'phone' => 'required|string|min:6',
		'parent_id' => '',
		'active' => '',
		
    ];

    public function mount()
    {
        $this->authorize("company.companies.create");
        $this->done = 1;
    }

    public function updated($field)
    {
        $this->validateOnly($field);
    }
    public function updatedName($field)
    {
        $this->slug = Str::slug($this->name);
    }
    public function  updatedLogoFile()
    {
        $this->validate([
            'logo_file' => 'image|max:1024',
        ]);
        // dd($this->logo_file);
        if ($this->logo_file) {
            $this->logo_url = $this->logo_file->temporaryUrl();
        }
    }
    public function store()
    {
        $this->authorize("company.companies.create");
        $this->validate();
        $logo =[];
        if($this->logo_file){
            $filename = $this->logo_file->getClientOriginalName();
            $arr = explode(".",$filename);
            $ext = end($arr);

            $data =$this->logo_file->storeAs('photos',time().".$ext");
            $image = Storage::path($data);
            list($width, $height) = getimagesize($image);
            $logo = [
                "name" => $data
                ,"width" =>$width
                ,"height" =>$height
            ];
        }

        $data = company::create([
            'name' => $this->name,
			'slug' => $this->slug,
			'teaser' => $this->teaser,
			'logo' => $logo,
			'address' => $this->address,
			'phone' => $this->phone,
			'parent_id' => $this->parent_id,
			'active' => $this->active,
			
        ]);
        if ($data) {
            $this->redirectForm("company.companies", $data->id);
        }
    }

    public function render()
    {
        lForm()->setTitle("Companies");
        lForm()->pushBreadcrumb(route("company"),"Company");
		lForm()->pushBreadcrumb(route("company.companies"),"Companies");
		lForm()->pushBreadcrumb(route("company.companies.create"),"Create");
        $companies = Company::select(Company::$listFields)->pluck("name", "id");
        return view("company::livewire.companies.create", ['companies' => $companies])
            ->layout('company::layouts.master', ['title' => 'Companies Create']);
    }
}
