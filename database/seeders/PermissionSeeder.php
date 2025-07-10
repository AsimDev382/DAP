<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            // 'company management',

            // 'company',
            'view company',
            'create company',
            'edit company',
            'delete company',

            // 'brand',
            'view brand',
            'create brand',
            'edit brand',
            'delete brand',

            // 'product',
            'view product',
            'create product',
            'edit product',
            'delete product',

            // 'case management',
            'view case management',
            'create case management',
            'edit case management',
            'delete case management',

            // 'investigation management',
            // 'investigation',
            'view investigation',
            'create investigation',
            'edit investigation',
            'delete investigation',

            // 'tasks',
            'view tasks',
            'create tasks',
            'edit tasks',
            'delete tasks',

            // 'evidence',
            'view evidence',
            'create evidence',
            'edit evidence',
            'delete evidence',

            // 'assign task',
            'view assign task',
            'create assign task',
            'edit assign task',
            'delete assign task',

            // 'user management',
            // 'department',
            'view department',
            'create department',
            'edit department',
            'delete department',

            // 'sub department',
            'view sub department',
            'create sub department',
            'edit sub department',
            'delete sub department',

            // 'user',
            'view user',
            'create user',
            'edit user',
            'delete user',

            // 'groups',
            'view groups',
            'create groups',
            'edit groups',
            'delete groups',

            // 'enforcement / raid actions',
            // 'raid plaining & execution',
            'view raid plaining & execution',
            'create raid plaining & execution',
            'edit raid plaining & execution',
            'delete raid plaining & execution',

            // 'raid documentation',
            'view raid documentation',
            'create raid documentation',
            'edit raid documentation',
            'delete raid documentation',

            // 'destruction management',
            // 'pending destruction',
            'view pending destruction',
            'create pending destruction',
            'edit pending destruction',
            'delete pending destruction',

            // 'completed destruction',
            'view completed destruction',
            'create completed destruction',
            'edit completed destruction',
            'delete completed destruction',

            // 'finance',
            // 'currency',
            'view currency',
            'create currency',
            'edit currency',
            'delete currency',

            // 'recieved payments',
            'view recieved payments',
            'create recieved payments',
            'edit recieved payments',
            'delete recieved payments',

            // 'due tracking',
            'view due tracking',
            'create due tracking',
            'edit due tracking',
            'delete due tracking',

            // 'profit & expences',
            'view profit & expences',
            'create profit & expences',
            'edit profit & expences',
            'delete profit & expences',

            // 'disbursement',
            'view disbursement',
            'create disbursement',
            'edit disbursement',
            'delete disbursement',

            // 'invoices',
            'view invoices',
            'create invoices',
            'edit invoices',
            'delete invoices',

            // 'reports',
            // 'case report',
            'view case report',
            'create case report',
            'edit case report',
            'delete case report',

            // 'client reports',
            'view client reports',
            'create client reports',
            'edit client reports',
            'delete client reports',

            // 'finance reports',
            'view finance reports',
            'create finance reports',
            'edit finance reports',
            'delete finance reports',

            'follow-up',
            'settings',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => strtolower($permission)]);
        }
    }
}
