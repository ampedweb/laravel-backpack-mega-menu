<?php


namespace AmpedWeb\LaravelBackpackMegaMenu\Http\Controllers\Admin;


use AmpedWeb\LaravelBackpackMegaMenu\Models\MegaMenu;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class MegaMenuController extends CrudController
{
    use ListOperation;
    use CreateOperation;
    use UpdateOperation;
    use DeleteOperation;
    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(MegaMenu::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/mega-menu');
        CRUD::setEntityNameStrings('menu', 'menus');
        $this->crud->setCreateView('ampedweb.laravel-backpack-mega-menu.create');
        $this->crud->setEditView('ampedweb.laravel-backpack-mega-menu.edit');

    }


    public function setupListOperation()
    {
        $this->crud->setColumns(['name', 'description']);
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {

        $this->crud->addField(
            [
                'name'    => 'name',
                'type'    => 'text',
                'label'   => 'Menu name',
                'wrapper' => ['class' => 'form-group col-md-6']
            ]
        );

        $this->crud->addField(
            [
                'name'    => 'description',
                'type'    => 'textarea',
                'label'   => 'Menu description',
                'wrapper' => ['class' => 'form-group col-md-6']
            ]
        );


        $this->crud->addField(
            [
                'name'    => 'menu_json',
                'type'    => 'hidden',
                'attributes' => [
                    'id'=>'original_menu_json'
                ]
            ]
        );
    }

    public function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
