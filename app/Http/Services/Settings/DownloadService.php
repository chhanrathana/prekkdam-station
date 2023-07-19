<?php

namespace App\Http\Services\Settings;

use Mpdf\Mpdf;

class DownloadService{

    static function PDF($htmlReport, $title = 'របាការណ៍', $orientation = 'P', $font = 12, $printCard = false, $mt = 6, $ml = 5, $mr = 5, $format = 'A4')
    {
        $defaultConfig = (new \Mpdf\Config\ConfigVariables())->getDefaults();
        $fontDirs = $defaultConfig['fontDir'];

        $defaultFontConfig = (new \Mpdf\Config\FontVariables())->getDefaults();
        $fontData = $defaultFontConfig['fontdata'];
      
        $mpdf = new Mpdf([
            'tempDir' => storage_path() .'/tmp',
            'mode' => 'utf-8',
            'default_font_size' => $font,
            'fontDir' => array_merge($fontDirs, [ storage_path() . '/fonts/khmer']),
            'fontdata' => $fontData + [
                'moul' => [
                    'R' => 'KhmerOSMoulLight.ttf',
                    'useOTL' => 0x80,
                ],
                'siemreap' => [
                    'R' => 'KhmerOS_siemreap.ttf',
                    'useOTL' => 0x80,
                ],
                'semibold' => [
                    'R' => 'OpenSans-Semibold.ttf',
                    'useOTL' => 0x80,
                ],
                'content' => [
                    'R' => 'Content Bold.ttf',
                    'useOTL' => 0x80,
                ],
                'khmer-mul' => [
                    'R' => 'KhmerOSmuollight.ttf',
                    'useOTL' => 0x80,
                ],
                'khmer-os' => [
                    'R' => 'KhmerOSmuollight.ttf',
                    'useOTL' => 0x80,
                ]
            ],
            'default_font' => 'siemreap',
            'format' =>  $format,
            'margin_top' => $mt,
            'margin_left'=> $ml,
            'margin_right'=> $mr,
            'orientation' => $orientation,
            'defaultPageNumStyle' => 'cambodian' 
        ]);        
        $mpdf->SetTitle($title);
        $mpdf->shrink_tables_to_fit = 1;
        $mpdf->showWatermarkImage = true;
          if(!$printCard){
            $mpdf->defaultfooterline = false;
            $mpdf->setFooter(' ទំព័រ {PAGENO} នៃ {nbpg}');
        }
        $mpdf->WriteHTML($htmlReport);               
        return $mpdf->Output($title, 'I');
    }
}
