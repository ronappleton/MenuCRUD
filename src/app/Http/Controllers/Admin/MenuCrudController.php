<?php

namespace Backpack\MenuCRUD\app\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

class MenuCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ReorderOperation;

    public function setup()
    {
        $this->crud->setModel("Backpack\MenuCRUD\app\Models\Menu");
        $this->crud->setRoute(config('backpack.base.route_prefix').'/menu');
        $this->crud->setEntityNameStrings('menu', 'menus');

        $this->crud->enableReorder('name', 3);

        $this->crud->operation('list', function () {
            $this->crud->addColumn([
                'name' => 'name',
                'label' => 'Label',
            ]);

            $this->crud->addColumn([
                'name' => 'slug',
                'label' => 'Slug',
            ]);

            $this->crud->addColumn([
                'name' => 'description',
                'label' => 'Description',
            ]);
        });

        $this->crud->operation(['create', 'update'], function () {
            $this->crud->addField([
                'name' => 'name',
                'label' => 'Label',
            ]);

            $this->crud->addField([
                'name' => 'slug',
                'label' => 'Slug',
            ]);

            $this->crud->addField([
                'name' => 'description',
                'label' => 'Description',
            ]);
        });
    }
}
