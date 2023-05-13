<?php

namespace App\Providers;

use App\Models\ClientType;
use App\Models\DepositType;
use App\Models\GroupMenus;
use App\Models\LoanType;
use App\Models\Menu;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\Province;
use App\Models\Sex;
use App\Models\UserTypeURL;
use Carbon\Carbon;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        # COMPOSE MENU
        View::composer(['layouts.sidebar', 'layouts.breadcrumb', 'users.edit'],function ($view) {

            $userType = auth()->user()->user_type_id;
            $urls = UserTypeURL::where('user_type_id', $userType)->get(['url_id']);
            // dd($urls->toArray());
            
            $urlArr = [];
            foreach($urls as $url){
                $urlArr[] = $url->url_id;
            }

            $groups = GroupMenus::where('active',1)
            ->with([
                'menus' => function ($query) use($urlArr) {
                    $query->whereIn('url_id',$urlArr);
                    return $query->orWhereIn('id', function($query) use( $urlArr){
                    $query->select('parent_id')
                    ->from(with(new Menu())->getTable())
                    ->whereIn('url_id',  $urlArr);})
                    ->where('active',1);
                },
                'menus.childs' => function ($query) use($urlArr) {
                    $query->whereIn('url_id',$urlArr)
                    ->where('active',1);
                },
            ])->get();

            $view->with(['groups' => $groups]);
        });

        View::composer(['operations.clients.form', 'settings.master-data.staffs.create'],function ($view) {
            $view->with([
                'provinces' => Province::whereActive(true)->get(),
                'sexes' => Sex::all(),
                'types' => ClientType::all()
            ]);
        });

        View::composer(['operations.loans.requests.form'],function ($view) {
            $registrationDate = Carbon::now()->format(env('CLOSING_DATE','10/m/Y'));
            if($registrationDate > Carbon::now()->format('d/m/Y')){
                $registrationDate = Carbon::now()->addMonth()->format(env('CLOSING_DATE','10/m/Y'));
            }
            $startInterestDate = Carbon::createFromFormat('d/m/Y', $registrationDate)->addMonth(1)->format(env('CLOSING_DATE','10/m/Y'));

            $view->with([                
                'types' => LoanType::all(),
                'registrationDate' => $registrationDate,
                'startInterestDate' => $startInterestDate,
            ]);
        });

        View::composer(['operations.deposits.requests.form'],function ($view) {
            $registrationDate = Carbon::now()->format(env('CLOSING_DATE','10/m/Y'));
            if($registrationDate > Carbon::now()->format('d/m/Y')){
                $registrationDate = Carbon::now()->addMonth()->format(env('CLOSING_DATE','10/m/Y'));
            }
            $startInterestDate = Carbon::createFromFormat('d/m/Y', $registrationDate)->addMonth(1)->format(env('CLOSING_DATE','10/m/Y'));

            $view->with([                
                'types' => DepositType::all(),
                'registrationDate' => $registrationDate,
                'startInterestDate' => $startInterestDate,
            ]);
        });
       
    }
}
