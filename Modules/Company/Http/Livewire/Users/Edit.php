<?php

namespace Modules\Company\Http\Livewire\Users;

use App\Models\Company;
use App\Models\Department;
use App\Models\Position;
use App\Models\User;
use Hungnm28\LaravelForm\Facades\LaravelForm;
use Hungnm28\LaravelForm\Traits\WithLaravelFormTrait;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithLaravelFormTrait;
    use WithFileUploads;
	public $logo_file, $logo_url;
    public $name, $email, $email_verified_at, $password, $two_factor_confirmed_at, $current_team_id, $profile_photo_path, $is_admin, $birthday, $gender, $address, $phone, $company_id, $department_id, $position_id, $level, $other_info;

    protected function rules()
    {
        return [
            'name' => 'string',
			'email' => 'email',
			'email_verified_at' => '',
			'password' => 'required|min:8',
			'two_factor_confirmed_at' => '',
			'current_team_id' => '',
			'profile_photo_path' => '',
			'is_admin' => '',
			'birthday' => '',
			'gender' => '',
			'address' => '',
			'phone' => '',
			'company_id' => '',
			'department_id' => '',
			'position_id' => '',
			'level' => '',
			'other_info' => '',
			
        ];
    }

    public function mount()
    {
        $this->authorize("company.users.edit");
        $data = User::findOrFail($this->record_id);
        $this->name = $data->name;
		$this->email = $data->email;
		$this->email_verified_at = $data->email_verified_at;
		$this->password = $data->password;
		$this->two_factor_confirmed_at = $data->two_factor_confirmed_at;
		$this->current_team_id = $data->current_team_id;
		if(isset($data->profile_photo_path)){
			$this->logo_file = $data->profile_photo_path->name;
			$this->logo_url = "/{$data->profile_photo_path->name}";
		}else{
			$this->logo_file = '';
			$this->logo_url = '';
		}

		$this->is_admin = $data->is_admin;
		$this->birthday = $data->birthday;
		$this->gender = $data->gender;
		$this->address = $data->address;
		$this->phone = $data->phone;
		$this->company_id = $data->company_id;
		$this->department_id = $data->department_id;
		$this->position_id = $data->position_id;
		$this->level = $data->level;
		$this->other_info = $data->other_info;
		
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
        $this->authorize("company.users.edit");
        $this->validate();
        $data = User::findOrFail($this->record_id);
		$avatar = [];
        if ($this->logo_file) {
            if (isset($data->profile_photo_path->name) && $this->logo_file === $data->profile_photo_path->name) {
                $avatar = $data->profile_photo_path;
            } else {
                $filename = $this->logo_file->getClientOriginalName();
                $arr = explode(".", $filename);
                $ext = end($arr);

                $data_img = $this->logo_file->storeAs('photos', time() . ".$ext");
                $image = Storage::path($data_img);
                list($width, $height) = getimagesize($image);
                $avatar = [
                    "name" => $data_img, "width" => $width, "height" => $height
                ];
            }
        }
        $data->fill([
            'name' => $this->name,
			'email' => $this->email,
			'email_verified_at' => $this->email_verified_at,
			'password' => Hash::make($this->password),
			'two_factor_confirmed_at' => $this->two_factor_confirmed_at,
			'current_team_id' => $this->current_team_id,
			'profile_photo_path' => $avatar,
			'is_admin' => $this->is_admin,
			'birthday' => $this->birthday,
			'gender' => $this->gender,
			'address' => $this->address,
			'phone' => $this->phone,
			'company_id' => $this->company_id,
			'department_id' => $this->department_id,
			'position_id' => $this->position_id,
			'level' => $this->level,
			'other_info' => $this->other_info,
			
        ]);
        if (!$data->clean) {
            $data->update();
            $this->redirectForm("company.users", $data->id);
        }
    }

    public function render()
    {
        lForm()->setTitle("Users");
        lForm()->pushBreadcrumb(route("company"),"Company");
		lForm()->pushBreadcrumb(route("company.users"),"Users");
		lForm()->pushBreadcrumb(route("company.users.edit",$this->record_id),"Edit");
		$companies = Company::select(Company::$listFields)->pluck("name", "id");
		$departments = Department::select(Department::$listFields)->pluck("name", "id");
		$positions = Position::select(Position::$listFields)->pluck("name", "id");
        return view("company::livewire.users.edit", ['companies' => $companies, 'positions' => $positions, 'departments' => $departments])
            ->layout('company::layouts.master', ['title' => 'Users Edit']);
    }
}
