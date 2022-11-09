<?php

namespace Modules\Admin\Http\Livewire\Icons;

use Livewire\Component;
use Livewire\WithFileUploads;

class Listing extends Component
{
    public $data = [], $file, $width = 24, $height = 24, $name, $icon_url = "", $path;

    use WithFileUploads;

    protected function rules()
    {
        return [
            "name" => "required|not_in:" . implode(",", array_keys($this->data))
            , "file" => "image|max:1024|mimes:svg"
        ];
    }

    public function mount()
    {
        $str = file_get_contents(public_path("assets/images/icons.svg"));
        $doms = str_get_html($str);
        $arrIcon = [];
        foreach ($doms->find("symbol") as $dom) {
            $arrIcon[$dom->id] = $dom->outertext;
        }
        ksort($arrIcon);

        $this->data = $arrIcon;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updatedFile()
    {
        $doms = str_get_html(file_get_contents($this->file->getRealPath()));
        $this->icon_url = $this->file->temporaryUrl();
        $dom = $doms->find("svg", 0);
        $this->path = $dom->innertext;
    }

    public function store()
    {
         if(!lfCheckLocalhost()){
             abort("403");
         }
        $this->validate();
        $this->data[$this->name] = '<symbol id="' . $this->name . '" fill="currentColor" viewBox="0 0 ' . $this->width . ' ' . $this->height . '" enable-background="0 0 ' . $this->width . ' ' . $this->height . '">' . $this->path . '</symbol>';;
        $data = $this->data;
        ksort($data);
        $svg = '<?xml version="1.0" encoding="utf-8"?>
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">'
            . implode("\n",$data) .
            '</svg>';

        file_put_contents(public_path("assets/images/icons.svg"), $svg);
        return $this->redirect(route('admin.icons'));
    }

    public function render()
    {
        lForm()->setTitle("Icons");
        lForm()->pushBreadCrumb(route("admin"),"Admin");
        lForm()->pushBreadCrumb(route("admin.icons"),"Icons");

        return view("admin::livewire.icons.listing")
            ->layout('admin::layouts.master', ['title' => 'Icons']);
    }
}
