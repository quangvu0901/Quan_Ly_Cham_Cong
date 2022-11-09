<?php

namespace Modules\Admin\Http\Livewire\Settings\Menus;

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

    public function mount()
    {
        $this->done = 1;
        if (!lfCheckLocalhost()) {
            return abort(403);
        }
    }

    public function store()
    {
        if (!lfCheckLocalhost()) {
            return abort(403);
        }
        $module = Module::findOrFail($this->module);
        $navbars = config($module->getLowerName() . '.navbar', []);
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
        $this->saveNavbar( $this->module,$navbars);
        $this->redirectForm("admin.settings.menus", 1, ["module" => $this->module]);
    }

    public function render()
    {

        $modules = ["Select Module"];
        foreach (Module::all() as $m => $md) {
            $modules[$m] = lfHeadLine($m);
        }
        $allNav = [];

        $module = Module::findOrFail($this->module);
        $parents = [-1 => "ROOT"];
        $navbars = config($module->getLowerName() . '.navbar', []);
        foreach ($navbars as $k => $item) {
            $parents[$k] = $item["label"];
            $allNav[$item["route"]] = $item["route"];
            foreach ($item["children"] as $child) {
                $allNav[$item["route"]] = $child["route"];
            }
        }
        $sorts = [-1 => "Đầu tiên"];
        if ($this->parent_id == -1) {
            $siblings = $navbars;
        } else {
            $siblings = data_get($navbars, $this->parent_id . ".children", []);
        }
        foreach ($siblings as $k => $sibling) {
            $sorts[$k] = "Sau " . $sibling["label"];
        }

        $routes = ["" => "Chọn Route"];
        $permissions = ["" => "Chọn Permission"];
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

        lForm()->setTitle("Menu Create");
        lForm()->pushBreadCrumb(route("admin"),"Admin");
        lForm()->pushBreadCrumb(route("admin.settings"),"Setting");
        lForm()->pushBreadCrumb(route("admin.settings.menus"),"Menu");
        lForm()->pushBreadCrumb(route("admin.settings.menus.create"),"Create");
        return view("admin::livewire.settings.menus.create", compact("modules", "parents", "sorts", "routes", "permissions"))
            ->layout('admin::layouts.master', ['title' => 'Menu Create']);
    }

}
