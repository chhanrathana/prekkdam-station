<?php
namespace Database\Seeders;

use App\Models\Settings\GroupMenu;
use App\Models\Settings\Menu;
use Illuminate\Database\Seeder;

class MenuTableSeeder extends Seeder
{
    public function run()
    {
        $menus = [
            [
                "group" => 'ព័ត៌មានទូទៅ',
                'visible' => 1,
                "data"  => [
                    [
                        "label"         => "ចំនូល",
                        "permission"    => "dashboard",
                        "url"           => 'dashboard',
                        "active_url"    => "dashboard/revenue*",
                        "icon"          => "money",
                        'visible' => 1,
                        "childs"        => [],
                    ],                                        
                ],
            ],
            [
                "group" => "របាយការណ៍",
                'visible' => 1,
                "data"  => [
                    [
                        "label" => "គណេនេយ្យ",
                        "permission" => "",
                        "url" => "",
                        "active_url" => "special-plate/*",
                        "icon" => "book",
                        'visible' => 1,
                        "childs" => [
                            [
                                "label" => "ចំនូល",
                                "permission" => "report-daily",
                                "url" => '',
                                "active_url" => "report/monthly/*",
                                'visible' => 1,
                            ],
                            [
                                "label" => "ចំណេញ",
                                "permission" => "report-daily",
                                "url" => '',
                                "active_url" => "report/monthly/*",
                                'visible' => 0,
                            ],                              
                            [
                                "label" => "ចំណេញខាត",
                                "permission" => "report-daily",
                                "url" => '',
                                "active_url" => "report/monthly/*",
                                'visible' => 0,
                            ],
                            [
                                "label" => "លំហូរសាច់ប្រាក់",
                                "permission" => "report-daily",
                                "url" => '',
                                "active_url" => "report/monthly/*",
                                'visible' => 0,
                            ],
                            [
                                "label" => "តារាងសមតុល្យ",
                                "permission" => "report-daily",
                                "url" => '',
                                "active_url" => "report/monthly/*",
                                'visible' => 0,
                            ],                                                   
                        ],
                    ],
                    [
                        "label" => "ការលក់",
                        "permission" => "",
                        "url" => "",
                        "active_url" => "vehicle-registration/*",
                        "icon" => "cart-plus",
                        'visible' => 1,
                        "childs" => [                                                     
                            [
                                "label" => "ស្ថានីយ៍",
                                "permission" => "report-monthly",
                                "url" => '',
                                "active_url" => "report/monthly/*",
                                'visible' => 1,
                            ],
                            [
                                "label" => "ការលក់ដុំ",
                                "permission" => "report-monthly",
                                "url" => '',
                                "active_url" => "report/monthly/*",
                                'visible' => 0,
                            ],
                            [
                                "label" => "ការលក់រាយ",
                                "permission" => "report-monthly",
                                "url" => '',
                                "active_url" => "report/monthly/*",
                                'visible' => 0,
                            ],
                        ],
                    ],    
                    [
                        "label" => "ប្រាក់ជំពាក់",
                        "permission" => "",
                        "url" => "",
                        "active_url" => "vehicle-registration/*",
                        "icon" => "money",
                        'visible' => 1,
                        "childs" => [                            
                            [
                                "label" => "អតិថិជនជំពាក់",
                                "permission" => "report-monthly",
                                "url" => '',
                                "active_url" => "report/monthly/*",
                                'visible' => 1,
                            ],
                            [
                                "label" => "ជំពាក់អ្នកផ្តត់ផ្គង់",
                                "permission" => "report-monthly",
                                "url" => '',
                                "active_url" => "report/monthly/*",
                                'visible' => 1,
                            ],                                                                              
                        ],
                    ],
                ]
            ],
            [
                "group" => "ការលក់ទំនិញ",
                'visible' => 1,
                "data"  => [
                    [
                     
                        "label" => "ស្ថានីយ៍",
                        "permission" => "",
                        "url" => "",
                        "active_url" => "sale-mgts/station/*",
                        "icon" => "road",
                        'visible' => 1,
                        "childs" => [
                            [
                                "label" => "លក់ប្រចាំថ្ងៃ",
                                "permission" => "report-daily",
                                "url" => 'sale-mgts.station.order.index',
                                "active_url" => "sale-mgts/station/order/*",
                                'visible' => 1,
                            ],
                        ],
                    ],
                    [
                        "label" => "លក់ដុំ",
                        "permission" => "",
                        "url" => "",
                        "active_url" => "sale-mgts/wholesale/*",
                        "icon" => "truck",
                        'visible' => 0,
                        "childs" => [
                            [
                                "label" => "បញ្ជាទិញ",
                                "permission" => "report-daily",
                                "url" => 'sale-mgts.wholesale.order.index',
                                "active_url" => "sale-mgts/wholesale/order/*",
                                'visible' => 1,
                            ],
                            [
                                "label" => "ទូទាត់ប្រាក់",
                                "permission" => "report-monthly",
                                "url" => 'sale-mgts.wholesale.payment.index',
                                "active_url" => "sale-mgts/wholesale/payment/*",
                                'visible' => 1,
                            ],
                        ],
                    ],
                    [
                        "label" => "លក់រាយ",
                        "permission" => "",
                        "url" => "",
                        "active_url" => "sale-mgts/retail/*",
                        "icon" => "shopping-cart",                        
                        'visible' => 0,
                        "childs" => [
                            [
                                "label" => "បញ្ជាទិញ",
                                "permission" => "report-daily",
                                "url" => 'sale-mgts.retail.order.index',
                                "active_url" => "sale-mgts/retail/order/*",
                                'visible' => 1,
                            ],
                            [
                                "label" => "ទូទាត់ប្រាក់",
                                "permission" => "report-monthly",
                                "url" => 'sale-mgts.retail.payment.index',
                                "active_url" => "sale-mgts/retail/payment/*",
                                'visible' => 1,
                            ],
                        ],
                    ],
                ]
            ],

            [
                "group" => "ឃ្លាំង RN3",
                "data"  => [                   
                    [
                        "label" => "ទំនិញចូល",
                        "permission" => "",
                        "url" => "",
                        "active_url" => "dividend/*",
                        "icon" => "forward",
                        'visible' => 0,
                        "childs" => [
                            [
                                "label" => "បញ្ចូលថ្មី",
                                "permission" => "report-daily",
                                "url" => '',
                                "active_url" => "dividend/indicator/*",
                                'visible' => 1,
                            ],    
                            [
                                "label" => "តារាង",
                                "permission" => "report-daily",
                                "url" => '',
                                "active_url" => "dividend/indicator/*",
                                'visible' => 1,
                            ],                          
                        ],
                    ],
                    [
                        "label" => "ទំនិញចេញ",
                        "permission" => "",
                        "url" => "",
                        "active_url" => "dividend/*",
                        "icon" => "backward",
                        'visible' => 0,
                        "childs" => [                            
                            [
                                "label" => "តារាង",
                                "permission" => "report-daily",
                                "url" => '',
                                "active_url" => "dividend/indicator/*",
                                'visible' => 1,
                            ],                          
                        ],
                    ],
                ]
            ],
            [
                "group" => "ការទិញទំនិញ",
                'visible' => 1,
                "data"  => [                   
                    [
                        "label" => "ឃ្លាំង",
                        "permission" => "",
                        "url" => "",
                        "active_url" => "purchase-mgts/*",
                        "icon" => "product-hunt",
                        'visible' => 1,
                        "childs" => [
                            [
                                "label" => "ទំនិញចូល",
                                "permission" => "report-daily",
                                "url" => 'purchase-mgts.product-order.index',
                                "active_url" => "purchase-mgts/product-order/*"
                            ],
                        ],
                    ],
                ]
            ],
            [
                "group" => "សុវត្ថិភាពប្រព័ន្ធ",
                'visible' => 1,
                "data" => [                    
                    [
                        "label"         => "ការប្រើប្រាស់",
                        "permission"    => "",
                        "url"           => "",
                        "active_url"    => "user/*",
                        "icon"          => "user",
                        'visible' => 0,
                        "childs"        => [
                            [
                                "label"         => "អ្នកប្រើប្រាស់",
                                "permission"    => "manage_accounts",
                                "url"           => 'user.index',
                                "active_url"    => "user/*",
                                'visible' => 0,
                            ],
                            [
                                "label"         => "ក្រុមសិទ្ធិ",
                                "permission"    => "admin_panel_settings",
                                "url"           => 'role.index',
                                "active_url"    => "role/*",
                                'visible' => 0,
                            ],
                        ],
                    ],                    
                    [
                        "label"         => "កំណត់",
                        "permission"    => "",
                        "url"           => "",
                        "active_url"    => "setting/*",
                        "icon"          => "cogs",
                        'visible' => 1,
                        "childs"        => [                               
                            [
                                "label"  => "បុគ្គលិក",
                                "permission" => "setting-scanner",
                                "url" => 'setting.staff.index',
                                "active_url" => "setting/staff/*",
                                'visible' => 0,
                            ],
                            [
                                "label"  => "អតិថិជន",
                                "permission" => "setting-scanner",
                                "url" => 'setting.client.index',
                                "active_url" => "setting/client/*",
                                'visible' => 1,
                            ],
                            [
                                "label"  => "អ្នកផ្តត់ផ្តង់",
                                "permission" => "setting-scanner",
                                "url" => 'setting.vendor.index',
                                "active_url" => "setting/vendor/*",
                                'visible' => 1,
                            ],                            
                            [
                                "label" => "រថយន្ត",
                                "permission" => "setting-push-data",
                                "url" => 'setting.vehicle.index',
                                "active_url" => "setting/vehicle/*",
                                'visible' => 1,
                            ],
                            [
                                "label" => "អ្នកបើកបរ",
                                "permission" => "setting-push-data",
                                "url" => 'setting.driver.index',
                                "active_url" => "setting/driver/*",
                                'visible' => 1,
                            ],
                            [
                                "label"  => "ប្រភេទទំនិញ",
                                "permission" => "setting-scanner",
                                "url" => 'setting.product-type.index',
                                "active_url" => "setting/product-type/*",
                                'visible' => 1,
                            ],
                            [
                                "label"  => "ទំនិញ",
                                "permission" => "setting-scanner",
                                "url" => 'setting.product.index',
                                "active_url" => "setting/product/*",
                                'visible' => 1,
                            ],
                        ],
                    ],
                ],
            ]
        ];
        $a = 1;
        foreach ( $menus as $menu ){
            // create new group and get group_id
            $group = new GroupMenu();
            $group->name = $menu['group'] ?? '';
            $group -> sort = $a;
            $group -> visible = isset($menu['visible'])?$menu['visible']:0 ;
            $group->save();
            $a++;
            $i = 1;
            // create data
            foreach ( $menu['data'] as $data ){
                // insert menu // parent
                $parent = new Menu();
                $parent -> label = $data['label'] ?? '';
                $parent -> permission = $data['permission'] ?? '';
                $parent -> url = $data['url'] ?? '';
                $parent -> active_url = $data['active_url'] ?? '';
                $parent -> icon = $data['icon'] ?? '';
                $parent -> group_id = $group -> id ?? '';
                $parent -> sort = $i;
                $parent -> visible = isset($data['visible'])?$data['visible']:0 ;
                $parent -> save();
                $i++;
                $j = 1;
                // if has child
                if( count($data['childs'] ) > 0 ){
                    foreach ( $data['childs'] as $child ){
                        $children = new Menu();
                        $children -> label = $child['label'] ?? '';
                        $children -> permission = $child['permission'] ?? '';
                        $children -> url = $child['url'] ?? '';
                        $children -> active_url = $child['active_url'] ?? '';
                        $children -> icon = $child['icon'] ?? '';
                        $children -> parent_id = $parent -> id ?? '';
                        $children -> sort = $j;
                        $children -> visible = isset($child['visible'])?$child['visible']:0;                        
                        $children -> save();
                        $j++;
                    }
                }
            }
        }
    }
}