<?php


namespace Robust\Core\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * Class NepaliDateConverter
 * @package Robust\Core\Controllers\API
 */
class NepaliDateConverter extends Controller
{
    /**
     * @var mixed
     */
    private $nepali_length;
    /**
     * @var mixed
     */
    private $month_name;
    /**
     * @var mixed
     */
    private $day_name;

    /**
     * @var string
     */
    private $firstday_en ="1918-04-13";
    /**
     * @var string
     */
    private $start_ne = "1975";
    /**
     * @var string
     */
    private $start_en = "1918";
    /**
     * @var string
     */
    private $end_ne = "2095";
    /**
     * @var string
     */
    private $end_en = "2038";
    /**
     * NepaliDateConverter constructor.
     */
    public function __construct()
    {
        $config = config('core.date-converter');
        $this->nepali_length = $config['nepali_length'];
        $this->month_name = $config['month_name'];
        $this->day_name = $config['day_name'];
    }

    /**
     * @param $year
     * @param $month
     * @param $day
     * @return mixed
     */
    private function get_week_ne($year, $month, $day)
    {
        $jd = GregorianToJD($month, $day, $year);
        return $this->day_name[JDDayOfWeek($jd,0)];
    }
    /**
     * @param $year
     * @param $month
     * @param $day
     * @return bool|string
     */
    private function validate_ne($year, $month, $day)
    {
        if(!array_key_exists($year, $this->nepali_length))
        {
            return 'Invalid <b>Year</b> range';
        }
        if($month >12 || $month<1)
        {
            return 'Invalid <b>Month</b> range';
        }
        if($day>$this->nepali_length[$year][$month-1] || $day<1)
        {
            return 'Invalid <b>Day</b>';
        }
        return TRUE;
    }

    /**
     * @param $year
     * @param $month
     * @param $day
     * @return bool|string
     */
    private function validate_en($year, $month, $day)
    {
        if ($year < $this->start_en || $year>$this->end_en) { return 'Invalid Year Range';}
        if ($month < 1 || $month>12) { return 'Invalid Month Range';}
        if ($day < 1 || ($day>cal_days_in_month(CAL_GREGORIAN, $month, $year)))
        { return 'Invalid day Range';}
        return TRUE;
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function get_nepali_date(Request $request)
    {
        $data = $request->all();
        $year = $data['year'];
        $month = $data['month'];
        $day = $data['day'];
        $validate = $this->validate_en($year, $month, $day);
        if($validate !== TRUE)
        {
            die($validate);
        }

        $date = $year.'-'.$month.'-'.$day;
        $dayname = $this->get_week_ne($year, $month, $day);
        $date_start=date_create($this->firstday_en);
        $date_today=date_create($date);
        $diff=date_diff($date_start,$date_today, true);
        $days = $diff->format("%a");
        $arr='0';
        $mm='';
        for ($i=$this->start_ne; $i<$this->end_ne; $i++)
        {
            $arr+=array_sum($this->nepali_length[$i]);

            if ($arr>$days)
            {
                $year = $i;

                $count_previous=$arr-array_sum($this->nepali_length[$i]);
                $year_previous = $i-1;
                for ($j=0; $j < 12; $j++)
                {
                    $count_previous+= $this->nepali_length[$i][$j];
                    if($count_previous>$days)
                    {
                        $month = $j+1; //Even I don't Know Why should I add 1 :p
                        $daysss = $count_previous-$days;
                        $dayss = ($this->nepali_length[$i][$j]-$daysss)+1;
                        break;
                    } elseif ($count_previous==$days)
                    {
                        $year = $i;
                        $month = $j+1;
                        $day = 1;
                    }
                }
                break;
            } elseif($arr==$days)
            {
                $year = $i+1;
                $month = 1;
                $day = 1;
            }
        }
        $date = array();
        $date['y'] = $year;
        $date['m'] = $month;
        $date['M'] = $this->month_name[$month-1];
        $date['d'] = $dayss;
        $date['l'] = $dayname;
        return response()->json(['date' => $date]);
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function get_eng_date(Request $request)
    {
        $data = $request->all();
        $year = $data['year'];
        $month = $data['month'];
        $day = $data['day'];
        $validate = $this->validate_ne($year, $month, $day);
        if($validate !== TRUE)
        {
            die($validate);
        }

        $date_start = date_create($this->firstday_en);
        $daycount = '0';
        $months=$month-1;
        for($i=$this->start_ne;$i<$year; $i++)
        {
            $daycount+=array_sum($this->nepali_length[$i]);
        }
        for($j=0; $j<$months; $j++)
        {
            $daycount+=$this->nepali_length[$i][$j];
        }
        $daycount+=$day-1;

        $nep = date_add($date_start, date_interval_create_from_date_string($daycount." days"));
        $date = array();
        $date['y'] = date_format($nep, "Y");
        $date['m'] = date_format($nep, "m");
        $date['M'] = date_format($nep, "M");
        $date['d'] = date_format($nep, "d");
        $date['l'] = date_format($nep, "l");
        return response()->json(['date' => $date]);
    }
}
