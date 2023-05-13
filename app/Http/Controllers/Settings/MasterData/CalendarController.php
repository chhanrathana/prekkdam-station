<?php
namespace App\Http\Controllers\Settings\MasterData;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\PDFService;
use App\Models\Calendar;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CalendarController extends Controller
{
    
    public function index(Request $request)
    {        
        $year = $request->year??Carbon::now()->format('Y');
        $calendars = Calendar::whereYear('date',$year)
        ->where('is_holiday',1)     
        ->orderByDesc('date')        
        ->paginate(env('PAGINATION'));
        return view('settings.master-data.calendars.index',['calendars'=> $calendars]);
    }
    
    public function create()
    {            
        return view('settings.master-data.calendars.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'date_format:d/m/Y',
            'description' => 'required|string|max:500',
        ]);

        DB::beginTransaction();
        try {
             
            $date = $request->date ? Carbon::createFromFormat('d/m/Y', $request->date)->format('Y-m-d') : null;

            $calendar = Calendar::whereDate('date', $date)->first();
            if(!$calendar){
                $calendar = new Calendar();
                $calendar->date = $request->date;
            }
            
            $calendar->is_holiday = 1;
            $calendar->description = $request->description;
            $calendar->save();
            DB::commit();
            return redirect()->back()->with('success', __('message.success'));
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->back()->withInput()->with('error', 'មិនអាចបញ្ចូលថ្មីបាន'.$ex->getMessage());
        }
    }

    public function edit($id)
    {        
        $calendar = Calendar::where('id', $id)->first();
        
        return view('settings.master-data.calendars.edit', [
            'calendar' => $calendar,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'date' => 'date_format:d/m/Y',
            'description' => 'required|string|max:500',
        ]);

        DB::beginTransaction();
        try {
            $calendar = Calendar::find($id);            
            $calendar->date = $request->date; 
            $calendar->is_holiday = 1;
            $calendar->description = $request->description;
            $calendar->save();        
            DB::commit();
            return redirect()->back()->with('success', __('message.success'));
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->back()->withInput()->with('error', 'កែប្រែបានមិនបានជោគជ័យ!'.$ex->getMessage());
        }
    }

    public function destroy($id)
    {        
        Calendar::find($id)->delete();
        return redirect()->route('setting.master-data.calendar.index');
    }   

    public function download(Request $request){
        $year = $request->year??Carbon::now()->format('Y');
        $calendars = Calendar::whereYear('date',$year)
        ->where('is_holiday',1)     
        ->orderBy('date')        
        ->get();

        $html = view('settings.master-data.calendars.print',['calendars' => $calendars, 'year' => $year]);
        return PDFService::reportPDF($html, $title = 'របាការណ៍', $orientation = 'P', $font = 12, $printCard = false, $mt = 10, $ml = 10, $mr = 10);
    }
}