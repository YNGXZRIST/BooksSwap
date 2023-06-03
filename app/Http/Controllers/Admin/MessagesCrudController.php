<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\MessagesRequest;
use App\Models\Chats;
use App\Models\Messages;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class MessagesCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class MessagesCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Messages::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/messages');
        CRUD::setEntityNameStrings('messages', 'messages');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('sender')->wrapper([
            'href' => function ($crud, $column, $entry, $related_key) {
                return backpack_url('user/' .Messages::where('id',$entry->getKey())->first()->sender.'/show');
            }])->label('отправитель');
        CRUD::column('receiver')->wrapper([
            'href' => function ($crud, $column, $entry, $related_key) {
                return backpack_url('user/' .Messages::where('id',$entry->getKey())->first()->receiver.'/show');
            }])->label('получатель');
        CRUD::column('chat_id')->wrapper([
            'href' => function ($crud, $column, $entry, $related_key) {
            $key=$entry->getKey();
            return backpack_url('chats/' .Messages::where('id',$key)->first()->chat_id.'/show');

            }]);
        CRUD::column('content');
        CRUD::column('created_at');
        CRUD::column('updated_at');


        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']);
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(MessagesRequest::class);

        CRUD::field('sender');
        CRUD::field('receiver');
        CRUD::field('content');
        CRUD::field('chat_id');

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number']));
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
