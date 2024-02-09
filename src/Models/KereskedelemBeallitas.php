<?php

namespace AlexGithub987\sekadatacheck\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use stdClass;

class KereskedelemBeallitas extends Model
{
    use HasFactory, SoftDeletes;

    protected $connection = 'mysql';
    protected $table = 'kereskedelem_beallitas';

    protected $guarded = ['id'];

    public static function get_beallitas($partner_id, $beallitas_azonosito, $beallitas_ertek = '0')
    {
        $return = new stdClass;

        if ($beallitas_ertek != '0') {
            $res = self::where("partner_id", "=", $partner_id)
                ->where("beallitas_tipus", "=", $beallitas_azonosito)
                ->where("beallitas_ertek", "=", $beallitas_ertek)
                ->get();
        } else {
            $res = self::where("partner_id", "=", $partner_id)
                ->where("beallitas_tipus", "=", $beallitas_azonosito)
                ->get();
        }

        foreach ($res as $key => $value) {
            if ($value['beallitas_azonosito'] == '1') {
                $return->noitem = $value['beallitas_ertek'];
            }
            if ($value['beallitas_azonosito'] == '2') {
                $return->shipitem = $value['beallitas_ertek'];
            }
            if ($value['beallitas_azonosito'] == '3') {
                $return->fee = $value['beallitas_ertek'];
            }
            if ($value['beallitas_azonosito'] == '4') {
                $return->status = $value['beallitas_ertek'];
            }
            if ($value['beallitas_azonosito'] == '5') {
                $return->cikkparositas = $value['beallitas_ertek'];
            }
        }

        return $return;
    }


}
