<?php

namespace Modules\Company\Http\Livewire\Companies;

use App\Models\company;
use Hungnm28\LaravelForm\Facades\LaravelForm;
use Hungnm28\LaravelForm\Traits\WithLaravelFormTrait;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithLaravelFormTrait;
    use WithFileUploads;
    public $name, $slug, $teaser, $logo_file, $logo_url, $address, $phone, $parent_id, $active = 1;

    protected function rules()
    {
        return [
            'name' => 'required|string|min:6',
            'slug' => 'required|string|min:6',
            'teaser' => 'required|string|min:6',
            'address' => 'required|string|min:6',
            'phone' => 'required|string|min:6',
            'parent_id' => '',
            'active' => '',

        ];
    }

    public function mount()
    {
        $this->authorize("company.companies.edit");
        $data = Company::findOrFail($this->record_id);
        $this->logo_file = $data->logo->name;
        $this->name = $data->name;
        $this->slug = $data->slug;
        $this->teaser = $data->teaser;
        $this->address = $data->address;
        $this->phone = $data->phone;
        $this->parent_id = $data->parent_id;
        $this->active = $data->active;
        $this->logo_url = "/{$data->logo->name}";
    }

    public function updated($field)
    {
        $this->validateOnly($field);
    }

    public function  updatedLogoFile()
    {
        $this->validate([
            'logo_file' => 'image|max:2044',
        ]);
        // dd($this->logo_file);
        if ($this->logo_file) {
            $this->logo_url = $this->logo_file->temporaryUrl();
        }
    }
    public function store()
    {
        $this->authorize("company.companies.edit");
        $this->validate();
        $data = Company::findOrFail($this->record_id);
        $logo = [];
        if ($this->logo_file) {
            if ($this->logo_file === $data->logo->name) {
                $logo = $data->logo;
            } else {
                $filename = $this->logo_file->getClientOriginalName();
                $arr = explode(".", $filename);
                $ext = end($arr);

                $data_img = $this->logo_file->storeAs('photos', time() . ".$ext");
                $image = Storage::path($data_img);
                list($width, $height) = getimagesize($image);
                $logo = [
                    "name" => $data_img, "width" => $width, "height" => $height
                ];
            }
        }
        $data->fill([
            'name' => $this->name,
            'slug' => $this->slug,
            'teaser' => $this->teaser,
            'logo' => $logo,
            'address' => $this->address,
            'phone' => $this->phone,
            'parent_id' => $this->parent_id,
            'active' => $this->active,

        ]);
        if (!$data->clean) {
            $data->update();
            $this->redirectForm("company.companies", $data->id);
        }
    }

    public function render()
    {
        lForm()->setTitle("Companies");
        lForm()->pushBreadcrumb(route("company"), "Company");
        lForm()->pushBreadcrumb(route("company.companies"), "Companies");
        lForm()->pushBreadcrumb(route("company.companies.edit", $this->record_id), "Edit");
        $companies = Company::select(Company::$listFields)->pluck("name", "id");
        return view("company::livewire.companies.edit",  ['companies' => $companies])
            ->layout('company::layouts.master', ['title' => 'Companies Edit']);
    }
}
