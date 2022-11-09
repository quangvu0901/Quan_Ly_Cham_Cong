<?php

namespace Modules\Admin\Http\Livewire\Menus;

use Hungnm28\LaravelForm\Traits\WithLaravelFormTrait;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Livewire\Component;
use Nwidart\Modules\Facades\Module;


class Create extends Component
{
    use WithLaravelFormTrait;

    public $module, $route, $label, $icon, $permission, $parent_id = -1, $sort = -1;
    public $queryString = ["module"];

    protected $rules = [
        "permission" => "string|required"
        , "label" => "string|required"
        ,"module"=> "string|required"
    ];

    public function mount()
    {
        $this->done = 1;
        $this->onlyLocalhost();
    }

    public function store()
    {
        $this->onlyLocalhost();
        $module = Module::findOrFail($this->module);
        $navbars = config($module->getLowerName() . '.menu', []);
        if ($this->parent_id == -1) {
            $siblings = $navbars;
        } else {
            $siblings = data_get($navbars, $this->parent_id . ".children", []);
        }
        $data = [
            "label" => $this->label
            , "icon" => $this->icon
            , "route" => $this->route
            , "permission" => $this->permission
            , "children" => []
        ];
        if ($this->sort == -1) {
            $siblings = Arr::prepend($siblings, $data);
        } else {
            $temp = [];
            foreach ($siblings as $k => $item) {
                $temp[] = $item;
                if ($k == $this->sort) {
                    $temp[] = $data;
                }

            }
            $siblings = $temp;
        }
        if ($this->parent_id == -1) {
            $navbars = $siblings;
        } else {
            $navbars[$this->parent_id]["children"] = $siblings;
        }
        $this->saveNavbar($this->module, $navbars);
        session()->flash('message', 'done');
        $this->redirectForm("admin.menus", 1, ["module" => $this->module]);
    }

    public function render()
    {

        $modules = ["Select Module"];
        foreach (Module::all() as $m => $md) {
            $modules[$m] = lfHeadLine($m);
        }
        $parents = [-1 => "ROOT"];
        $sorts = [-1 => "Đầu tiên"];
        $routes = ["" => "Chọn Route"];
        $permissions = ["" => "Chọn Permission"];
        $allNav = [];

        if($this->module !=""){
            $module = Module::findOrFail($this->module);
            $navbars = config($module->getLowerName() . '.menu', []);
            foreach ($navbars as $k => $item) {
                $parents[$k] = $item["label"];
                $allNav[$item["route"]] = $item["route"];

                foreach ($item["children"] as $child) {
                    $allNav[$child["route"]] = $child["route"];
                }
            }
            if ($this->parent_id == -1) {
                $siblings = $navbars;
            } else {
                $siblings = data_get($navbars, $this->parent_id . ".children", []);
            }
            foreach ($siblings as $k => $sibling) {
                $sorts[$k] = "Sau " . $sibling["label"];
            }

            $prefix = Str::slug(lfHeadLine($module->getName()));
            foreach (Route::getRoutes() as $route) {
                if (Str::is($prefix . '.*', $route->getName())) {
                    $name = $route->getName();
                    if (!in_array($name, $allNav) && !Str::contains($route->uri,"{")) {
                        foreach ($route->middleware() as $mid) {
                            if (Str::is("can:" . $prefix . ".*", $mid)) {
                                $permission = Str::after($mid, "can:");
                                $permissions[$permission] = $permission;
                            }
                        }
                        $routes[$name] = $name;

                    }//if(!in_array($name,$allNav))

                }//foreach (Route::getRoutes() as $route)
            }
        }// if($this->module !=""){


        lForm()->setTitle("Menu Create");
        lForm()->pushBreadCrumb(route("admin"), "Admin");
        lForm()->pushBreadCrumb(route("admin.menus"), "Menu");
        lForm()->pushBreadCrumb(route("admin.menus.create"), "Create");
        return view("admin::livewire.menus.create", compact("modules", "parents", "sorts", "routes", "permissions"))
            ->layout('admin::layouts.master', ['title' => 'Menu Create']);
    }

}
