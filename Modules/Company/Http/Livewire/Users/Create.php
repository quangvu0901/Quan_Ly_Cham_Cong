<?php

namespace Modules\Company\Http\Livewire\Users;

use App\Models\Company;
use App\Models\Department;
use App\Models\Position;
use App\Models\Team;
use App\Models\User;
use Hungnm28\LaravelForm\Facades\LaravelForm;
use Hungnm28\LaravelForm\Traits\WithLaravelFormTrait;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class   Create extends Component
{
    use WithLaravelFormTrait;
    use WithFileUploads;
	public $logo_file, $logo_url;
    public $name, $email, $email_verified_at, $password, $two_factor_confirmed_at, $current_team_id, $profile_photo_path, $is_admin, $birthday, $gender, $address, $phone, $company_id, $department_id, $position_id, $level, $other_info;
    protected $rules = [
        'name' => 'string',
		'email' => 'email',
		'email_verified_at' => '',
		'password' => 'required|min:8',
		'two_factor_confirmed_at' => '',
		'current_team_id' => '',
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

    public function mount()
    {
        $this->authorize("company.users.create");
        $this->done = 1;
    }

    public function updated($field)
    {
        $this->validateOnly($field);
    }
	// public function  updatedLogoFile()
    // {
    //     $this->validate([
    //         'logo_file' => 'image|max:1024',
    //     ]);
    //     // dd($this->logo_file);
    //     if ($this->logo_file) {
    //         $this->logo_url = $this->logo_file->temporaryUrl();
    //     }
    // }
    public function store()
    {
        $this->authorize("company.users.create");
        $this->validate();
        // $avatar =[];
        // if($this->logo_file){
        //     $filename = $this->logo_file->getClientOriginalName();
        //     $arr = explode(".",$filename);
        //     $ext = end($arr);

        //     $data =$this->logo_file->storeAs('photos',time().".$ext");
        //     $image = Storage::path($data);
        //     list($width, $height) = getimagesize($image);
        //     $avatar = [
        //         "name" => $data
        //         ,"width" =>$width
        //         ,"height" =>$height
        //     ];
        // }

        $data = User::create([
            'name' => $this->name,
			'email' => $this->email,
			'password' => Hash::make($this->password),
			'two_factor_confirmed_at' => $this->two_factor_confirmed_at,
			'current_team_id' => $this->current_team_id,
			// 'profile_photo_path' => $avatar,
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
        if ($data) {
            $this->redirectForm("company.users", $data->id);
        }
    }

    public function render()
    {
        lForm()->setTitle("Users");
        lForm()->pushBreadcrumb(route("company"),"Company");
		lForm()->pushBreadcrumb(route("company.users"),"Users");
		lForm()->pushBreadcrumb(route("company.users.create"),"Create");
		$companies = Company::select(Company::$listFields)->pluck("name", "id");
		$departments = Department::select(Department::$listFields)->pluck("name", "id");
		$positions = Position::select(Position::$listFields)->pluck("name", "id");
		$team = Team::select(Team::$listFields)->pluck("name", "id");
        return view("company::livewire.users.create", 
        ['companies' => $companies, 'positions' => $positions, 'departments' => $departments, 'team' => $team])
            ->layout('company::layouts.master', ['title' => 'Users Create']);
    }
}
