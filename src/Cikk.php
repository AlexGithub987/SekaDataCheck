<?php

namespace AlexGithub987\sekadatacheck;

use AlexGithub987\sekadatacheck\Models\Cikk as ModelsCikk;
use AlexGithub987\sekadatacheck\Models\KereskedelemBeallitas;

class Cikk
{

    public function index($cikk_azonosito, $partner_id)
    {

        $kereskedelem_beallitas = KereskedelemBeallitas::get_beallitas($partner_id, 'KERESKEDELEM_RENDELES');

        if (isset($kereskedelem_beallitas->noitem)) {
            $noitem = $kereskedelem_beallitas->noitem;
        } else {
            $noitem = 0;
        }


        if (isset($kereskedelem_beallitas->cikkparositas)) {

            if ($kereskedelem_beallitas->cikkparositas == 'cikk_azonosito') {
                $cikkszam = ModelsCikk::select("*")
                    ->where("cikk_azonosito", "=", $cikk_azonosito)
                    ->get();

                if ($cikkszam->count() == 0) {
                    $cikkszam = ModelsCikk::select("cikktorzs.*")
                        ->join('cikk_tcso', 'cikktorzs.id', '=', 'cikk_tcso.cikktorzs_id')
                        ->where("cikk_tcso.partner_id", "=", $partner_id)
                        ->where("cikktorzs.cikk_azonosito", "=", $cikk_azonosito)
                        ->get();
                }

                if ($cikkszam->count() == 0) {
                    $cikkszam = self::get_noitem($partner_id, $noitem);
                }

                return $cikkszam;
            }

            if ($kereskedelem_beallitas->cikkparositas == 'forgalmazoi_kod') {
                $cikkszam = ModelsCikk::select("*")
                    ->where("forgalmazoi_kod", "=", $cikk_azonosito)
                    ->get();

                if ($cikkszam->count() == 0) {
                    $cikkszam = ModelsCikk::select("cikktorzs.*")
                        ->join('cikk_tcso', 'cikktorzs.id', '=', 'cikk_tcso.cikktorzs_id')
                        ->where("cikk_tcso.partner_id", "=", $partner_id)
                        ->where("forgalmazoi_kod", "=", $cikk_azonosito)
                        ->get();
                }

                if ($cikkszam->count() == 0) {
                    $cikkszam = self::get_noitem($partner_id, $noitem);
                }

                return $cikkszam;
            }
        }

        $cikkszam = ModelsCikk::select("cikktorzs.*")
            ->where("cikk_azonosito", "=", $cikk_azonosito)
            ->get();

        if ($cikkszam->count() == 0) {
            $cikkszam = ModelsCikk::select("*")
                ->where("forgalmazoi_kod", "=", $cikk_azonosito)
                ->get();
        }

        if ($cikkszam->count() == 0) {
            $cikkszam = ModelsCikk::select("cikktorzs.*")
                ->join('cikk_tcso', 'cikktorzs.id', '=', 'cikk_tcso.cikktorzs_id')
                ->where("cikk_tcso.partner_id", "=", $partner_id)
                ->where("cikktorzs.cikk_azonosito", "=", $cikk_azonosito)
                ->get();
        }

        if ($cikkszam->count() == 0) {
            $cikkszam = ModelsCikk::select("cikktorzs.*")
                ->join('cikk_tcso', 'cikktorzs.id', '=', 'cikk_tcso.cikktorzs_id')
                ->where("cikk_tcso.partner_id", "=", $partner_id)
                ->where("forgalmazoi_kod", "=", $cikk_azonosito)
                ->get();
        }

        if ($cikkszam->count() == 0) {
            $cikkszam = self::get_noitem($partner_id, $noitem);
        }

        return $cikkszam;
    }

    // private static function get_noitem($noitem)
    // {

    //     return ModelsCikk::select("*")
    //         ->where("id", "=", $noitem)
    //         ->get();

    // }


    private static function get_noitem($partner_id, $tcso)
    {

        $cikkszam = ModelsCikk::select("cikktorzs.*")
            ->join('cikk_tcso', 'cikktorzs.id', '=', 'cikk_tcso.cikktorzs_id')
            ->join('kereskedelem_tcso', 'cikk_tcso.kereskedelem_tcso_id', '=', 'kereskedelem_tcso.id')
            ->where("cikk_tcso.partner_id", "=", $partner_id)
            ->where("kereskedelem_tcso.tcso_azonosito", "=", $tcso)
            ->get();

        return $cikkszam;
    }
}
