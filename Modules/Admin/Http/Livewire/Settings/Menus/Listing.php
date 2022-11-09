<?php
namespace Modules\Admin\Http\Livewire\Settings\Menus;
use Hungnm28\LaravelForm\Traits\WithLaravelFormTrait;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Artisan;
use Livewire\Component;
use Nwidart\Modules\Facades\Module;

class Listing extends Component
{
    use WithLaravelFormTrait;

    public function mount(){
        Artisan::call("config:clear");
        Artisan::call("cache:clear");
        Artisan::call("route:clear");
    }

    public function delete($moduleName,$record){
        if(!lfCheckLocalhost()){
            return abort(403);
        }
        $module = Module::findOrFail($moduleName);
        $data = config($module->getLowerName() . ".navbar",[]);
        Arr::forget($data,$record);
        $this->saveNavbar($moduleName,$data);
        Artisan::call("config:clear");
        Artisan::call("cache:clear");
        Artisan::call("route:clear");
        $this->redirect(route("admin.settings.menus"));
    }

    public function render(){
        $modules = Module::all();
        $data = [];
        foreach($modules as $module){
            $data[$module->getName()] = config($module->getLowerName().".navbar",[]);
        }
        lForm()->setTitle("Menu");
        lForm()->pushBreadCrumb(route("admin"),"Admin");
        lForm()->pushBreadCrumb(route("admin.settings"),"Setting");
        lForm()->pushBreadCrumb(route("admin.settings.menus"),"Menu");

        return view("admin::livewire.settings.menus.listing",compact("data"))
            ->layout('admin::layouts.master', ['title' => 'Menu']);
    }
}
