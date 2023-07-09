<?php

namespace Database\Seeders;

use App\Models\GroupMenus;
use App\Models\Menu;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{    
    public function run()
    {
        $menus = [
            [
                'group' => 'ព័ត៌មានទូទៅ',
                'is_admin' => 0,
                'active'        => 1,
                'data'  => [
                    [
                        'label'         => 'ស្ថានីយ៍',
                        'permission'    => 'dashboard',
                        'url'           => 'dashboard.oil-type.index',
                        'active_url'    => 'dashboard/*',
                        'icon'          => 'dashboard',
                        'url_id'        => 'URL001',
                        'childs'        => [],
                    ],                    
                ],
            ],
            [
                'group' => 'របាយការណ៍',
                'is_admin' => 1,
                'active'        => 1,
                'data' => [
                    [
                        'label' => 'គណនេយ្យ',
                        'permission' => '',
                        'url' => '',
                        'active_url' => 'report/accounting/*',
                        'icon' => 'request_quote',
                        'active'        => 0,
                        'childs' => [
                            [
                                'label' => 'សមតុល្យ',
                                'permission' => '#',
                                'url' => 'report.accounting.balancesheet.index',
                                'active_url' => 'report/accounting/balancesheet/*',
                                'url_id'        => 'URL078',
                                'active'        => 1,
                            ],                           
                            [
                                'label' => 'ចំនូល',
                                'permission' => '#',
                                'url' => 'report.accounting.revenue.index',
                                'active_url' => 'report/accounting/revenue/*',
                                'url_id'        => 'URL077',
                                'active'        => 1,
                            ],  
                            [
                                'label' => 'ចំណាយ',
                                'permission' => '#',
                                'url' => 'report.accounting.expense.index',
                                'active_url' => 'report/accounting/expense/*',
                                'url_id'        => 'URL077',
                                'active'        => 1,
                            ],
                            [
                                'label' => 'ចំណេញខាត',
                                'permission' => 'report-financial.close',
                                'url' => 'report.accounting.netincome.index',
                                'active_url' => 'report/accounting/netincome/*',
                                'url_id'        => 'URL076',
                                'active'        => 1,
                            ],
                            [
                                'label' => 'លំហូរសាច់ប្រាក់',
                                'permission' => 'report.principal',
                                'url' => 'report.accounting.cashflow.index',
                                'active_url' => 'report/accounting/cashflow/*',
                                'url_id'        => 'URL075',
                                'active'        => 1,
                            ],                          
                        ],
                    ],  
                    [
                        'label' => 'ប្រតិបត្តិការ',
                        'permission' => '',
                        'url' => '',
                        'active_url' => 'report/operation/*',
                        'icon' => 'library_books',
                        'active'        => 1,
                        'childs' => [
                            [
                                'label' => 'លក់តាមថ្ងៃ',
                                'permission' => '#',
                                'url' => 'report.operation.sale.index',
                                'active_url' => 'report/operation/sale/*',
                                'url_id'        => 'URL078',
                                'active'        => 1,
                            ],
                            [
                                'label' => 'លក់ប្រចាំថ្ងៃ',
                                'permission' => '#',
                                'url' => 'report.operation.sale-daily.index',
                                'active_url' => 'report/operation/sale-daily/*',
                                'url_id'        => 'URL078',
                                'active'        => 1,
                            ],
                            [
                                'label' => 'ទិញ',
                                'permission' => '#',
                                'url' => 'report.operation.purchase.index',
                                'active_url' => 'report/operation/purchase/*',
                                'url_id'        => 'URL077',
                                'active'        => 0,
                            ],                                                   
                        ],
                    ],                                     
                ]
            ],
            [
                'group' => 'ប្រតិបត្តិការ',
                'is_admin' => 0,
                'active'        => 1,
                'data'  => [
                    [
                        'label'         => 'លក់',
                        'permission'    => '',
                        'url'           => '',
                        'active_url'    => 'operation/sale/*',
                        'icon'          => 'point_of_sale',
                        'active'        => 1,
                        'childs'        => [
                            [
                                'label' => 'បញ្ចូលថ្មី',
                                'permission' => '#',
                                'url' => 'operation.sale.create',
                                'active_url' => 'operation/sale/create/*',
                                'url_id'        => 'URL012',
                                'active'        => 1,
                            ],
                            [
                                'label' => 'តារាង',
                                'permission' => 'sale-list',
                                'url' => 'operation.sale.index',
                                'active_url' => 'operation/sale/list/*',
                                'url_id'        => 'URL021',
                                'active'        => 1,
                            ],
                        ],
                    ],   
                    [
                        'label'         => 'ទិញ',
                        'permission'    => '',
                        'url'           => '',
                        'active_url'    => 'operation/purchase/*',
                        'icon'          => 'shopping_cart',
                        'active'        => 1,
                        'childs'        => [
                            [
                                'label' => 'បញ្ចូលថ្មី',
                                'permission' => '#',
                                'url' => 'operation.purchase.create',
                                'active_url' => 'operation/purchase/create/*',
                                'url_id'        => 'URL012',
                                'active'        => 1,
                            ],
                            [
                                'label' => 'តារាង',
                                'permission' => 'purchase-list',
                                'url' => 'operation.purchase.index',
                                'active_url' => 'operation/purchase/list/*',
                                'url_id'        => 'URL021',
                                'active'        => 1,
                            ],
                        ],
                    ],
                      
                    [
                        'label' => 'ចំណាយ',
                        'permission' => '',
                        'url' => '',
                        'active_url' => 'operation/expense/*',
                        'icon' => 'payments',
                        'active'        => 1,
                        'childs' => [                                                        
                            [
                                'label' => 'បញ្ចូលថ្មី',
                                'permission' => 'expense.interest.index',
                                'url' => 'operation.expense.create',
                                'active_url' => 'operation/expense/create/*',
                                'url_id'        => 'URL071',
                                'active'        => 1,
                            ],
                            [
                                'label' => 'តារាង',
                                'permission' => 'operation.expense.store',
                                'url' => 'operation.expense.index',
                                'active_url' => 'operation/expense/list/*',
                                'url_id'        => 'URL074',
                                'active'        => 1,
                            ],
                        ],
                    ],  
                    [
                        'label'         => 'A/R',
                        'permission'    => '',
                        'url'           => '',
                        'active_url'    => 'operation/account-receivable/*',
                        'icon'          => 'paid',
                        'active'        => 0,
                        'childs'        => [
                            [
                                'label' => 'បញ្ចូលថ្មី',
                                'permission' => '#',
                                'url' => 'operation.account-receivable.create',
                                'active_url' => 'operation/account-receivable/create/*',
                                'url_id'        => 'URL012',
                                'active'        => 1,
                            ],
                            [
                                'label' => 'តារាង',
                                'permission' => 'purchase-list',
                                'url' => 'operation.account-receivable.index',
                                'active_url' => 'operation/account-receivable/list/*',
                                'url_id' => 'URL021',
                                'active' => 1,
                            ],
                        ],
                    ],
                    [
                        'label'         => 'A/P',
                        'permission'    => '',
                        'url'           => '',
                        'active_url'    => 'operation/account-payable/*',
                        'icon'          => 'money_off',
                        'active'        => 0,
                        'childs'        => [
                            [
                                'label' => 'បញ្ចូលថ្មី',
                                'permission' => '#',
                                'url' => 'operation.account-payable.create',
                                'active_url' => 'operation/account-payable/create/*',
                                'url_id' => 'URL012',
                                'active' => 1,
                            ],
                            [
                                'label' => 'តារាង',
                                'permission' => 'purchase-list',
                                'url' => 'operation.account-payable.index',
                                'active_url' => 'operation/account-payable/list/*',
                                'url_id'        => 'URL021',
                                'active'        => 1,
                            ],
                        ],
                    ],                       
                                 
                ],
            ],                                
            [
                'group' => 'គ្រប់គ្រងប្រព័ន្ធ',
                'is_admin' => 1,
                'active'  => 1,
                'data' => [           
                    [
                        'label' => 'ទិន្នន័យមេ',
                        'permission' => '',
                        'url' => '',
                        'active_url' => 'setting/master-data/*',
                        'icon' => 'settings',
                        'active'        => 1,
                        'childs' => [                                                   
                            [
                                'label' => 'ប្រេង',
                                'permission' => 'branches-index',
                                'url' => 'setting.master-data.oil-type.index',
                                'active_url' => 'setting/master-data/oil-type/*',
                                'url_id'        => 'URL035',
                                'active'        => 1,
                            ],
                            [
                                'label' => 'ចំណាយ',
                                'permission' => 'staff.index',
                                'url' => 'setting.master-data.expense-type.index',
                                'active_url' => 'setting/master-data/expense-type/*',
                                'url_id'        => 'URL049',
                                'active'        => 1,
                            ],
                            [
                                'label' => 'បុគ្គលិក',
                                'permission' => 'staff.index',
                                'url' => 'setting.master-data.staff.index',
                                'active_url' => 'setting/master-data/staff/*',
                                'url_id'        => 'URL055',
                                'active'        => 1,
                            ],
                            [
                                'label' => 'អ្នកផ្គត់ផ្គង់',
                                'permission' => 'staff.index',
                                'url' => 'setting.master-data.vendor.index',
                                'active_url' => 'setting/master-data/vendor/*',
                                'url_id'        => 'URL055',
                                'active'        => 1,
                            ],
                            [
                                'label' => 'អតិថិជន',
                                'permission' => 'staff.index',
                                'url' => 'setting.master-data.client.index',
                                'active_url' => 'setting/master-data/client/*',
                                'url_id'        => 'URL055',
                                'active'        => 1,
                            ],
                           
                            // [
                            //     'label' => 'ចំនូល',
                            //     'permission' => 'staff.index',
                            //     'url' => 'setting.master-data.revenue-type.index',
                            //     'active_url' => 'setting/master-data/revenue-type/*',
                            //     'url_id'        => 'URL049',
                            //     'active'        => 1,
                            // ],
                        ],
                    ],
                    [
                        'label' => 'អ្នកបើប្រាស់',
                        'permission' => '',
                        'url' => '',
                        'active_url' => 'setting/user/*',
                        'icon' => 'group',
                        'active'        => 0,
                        'childs' => [
                            [
                                'label' => 'បញ្ជូលថ្មី',
                                'permission' => 'users-create',
                                'url' => 'setting.user.create',
                                'active_url' => 'setting/user/create/*',
                                'url_id'        => 'URL088',
                                'active'        => 1,
                            ],
                            [
                                'label' => 'តារាង',
                                'permission' => 'users-index',
                                'url' => 'setting.user.index',
                                'active_url' => 'setting/user/index/*',
                                'url_id'        => 'URL086',
                                'active'        => 1,
                            ]
                        ],
                    ],
                    [
                        'label' => 'ក្រុមសិទ្ធិ',
                        'permission' => '',
                        'url' => '',
                        'active_url' => 'user/*',
                        'icon' => 'manage_accounts',
                        'active'        => 0,
                        'childs' => [
                            [
                                'label' => 'បញ្ជូលថ្មី',
                                'permission' => 'role-create',
                                'url' => 'setting.role.create',
                                'active_url' => 'setting/role/create/*',
                                'url_id'        => 'URL088',
                                'active'        => 1,
                            ],
                            [
                                'label' => 'តារាង',
                                'permission' => 'role-index',
                                'url' => 'setting.role.index',
                                'active_url' => 'setting/role/index/*',
                                'url_id'        => 'URL086',
                                'active'        => 1,
                            ]
                        ],
                    ],
                ]
            ],                                 
        ];
        
        foreach ( $menus as $menu ){
            // create new group and get group_id
            $group = new GroupMenus();
            $group->name_kh = $menu['group'] ?? '';
            $group->is_admin = $menu['is_admin'] ?? 0;
            $group->active = $menu['active'] ?? 0;
            $group->save();
            
            // create data
            foreach ( $menu['data'] as $data ){
                // insert menu // parent
                $parent = new Menu();
                $parent->label = $data['label'] ?? '';
                $parent->permission = $data['permission'] ?? '';
                $parent->url = $data['url'] ?? '';
                $parent->active_url = $data['active_url'] ?? '';
                $parent->icon = $data['icon'] ?? '';
                $parent->active = $data['active'] ?? 0;
                $parent->group_id = $group->id ?? '';
                $parent->url_id = $data['url_id'] ?? null;
                $parent->save();
                // if has child
                if( count($data['childs'] ) > 0 ){
                    foreach ( $data['childs'] as $child ){
                        $children = new \App\Models\Menu();
                        $children->label = $child['label'] ?? '';
                        $children->permission = $child['permission'] ?? '';
                        $children->url = $child['url'] ?? '';
                        $children->active_url = $child['active_url'] ?? '';
                        $children->icon = $child['icon'] ?? '';
                        $children->active = $child['active'] ?? 0;
                        $children->parent_id = $parent->id ?? '';
                        $children->url_id = $child['url_id'] ?? null;
                        $children->save();
                    }
                }
            }
        }
    }
}
