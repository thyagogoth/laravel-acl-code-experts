<?php

namespace App\Http\Views;

class MenuViewComposer
{

    public function compose($view)
    {

        $roleUser = auth()->user()->role;

        $modulesFiltered = [];

        foreach ($roleUser->modules as $key => $module) {
            $modulesFiltered[$key]['name'] = $module->name;

            foreach ($module->resources as $resource) {
                if ($resource->roles->contains($roleUser) && $resource->is_menu) {
                    $modulesFiltered[$key]['resources'][] = [
                        'name' => $resource->name,
                        'resource' => $resource->resource
                    ];
                }
            }
        }

        return $view->with('modules', $modulesFiltered);
    }
}
