<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\Calendar;

class CalendarsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $inserts = [];
        $start = '2017-01-01';
        $end = '2030-12-01';

        while (strtotime($start) <= strtotime($end)) {
            $start = date("Y-m-d", strtotime("+1 day", strtotime($start)));
            $dayOfWeek = date("w", strtotime($start));

            $inserts[] = [
                'id' => Str::uuid(),
                'date' => $start,
                'is_weekend' => ($dayOfWeek == 0 || $dayOfWeek == 6) ? 1 : 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }
        $chunks = array_chunk($inserts, 5000);
        foreach ($chunks as $chunk) {
            Calendar::insert($chunk);
        }

        $file = file_get_contents(base_path('database/seeders/Data/calendars.json'));
        $calendars = json_decode($file, true);
        $data = [];
        foreach ($calendars['RECORDS'] as $calendar) {
            if ($calendar['is_holiday'] == 1) {
               Calendar::where('date', $calendar['date'])->update([
                  'is_holiday' => 1,
                  'description' => $calendar['description']
               ]);
            }

        }
    }
}
