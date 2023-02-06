<?php
namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',

            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'user-show',

            'customer-list',
            'customer-create',
            'customer-edit',
            'customer-delete',
            'customer-show',
            'customer-export',
            'customer-active-dis',
            'customer-archive',
            'customer-archive-update',

            'park-list',
            'park-create',
            'park-edit',
            'park-delete',
            'park-active-dis',
            'park-status',

            'interval-list',
            'interval-create',
            'interval-edit',
            'interval-delete',
            'interval-show',
            'interval-active-dis',

            'reservation-list',
            'reservation-export',
            'reservation-create',
            'reservation-delete',
            'reservation-show',
            'reservation-status',
            'reservation-busy',

            'reservation-archive-list',
            'reservation-archive-create',
            'reservation-archive-edit',
            'reservation-archive-delete',
            'reservation-archive-show',
            'reservation-cancel',
            'reservation-finish',

            'payment-list',
            'payment-create',
            'payment-edit',
            'payment-delete',

            'invoice-list',
            'invoice-export',
            'invoice-create',
            'invoice-edit',
            'invoice-delete',
            'invoice-show',
            'invoice-status',
            'invoice-paid',
            'invoice-unpaid',

            'invoice-downloadPDF',
            'invoice-archive-list',
            'invoice-archive-edit',
            'invoice-archive-delete',

            'chat-list',
            'chat-answered',
            'chat-noresponse',
            'chat-create',
            'chat-edit',
            'chat-delete',
            'chat-show',
            'chat-archive-list',
            'chat-archive-delete',


        ];
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
