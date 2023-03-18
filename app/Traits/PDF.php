<?php

namespace App\Traits;
use Mpdf\Mpdf;

class PDF{

    public static $var = [

    ];

    public static function output(
        $htmlReport, 
        $title = 'របាការណ៍', 
        $orientation = 'P', 
        $font = 12, 
        $printCard = false, 
        $mTop = 6, 
        $mLeft = 5, 
        $mRight = 5, 
        $mBottom = 13, 
        $format = 'A5',
        $dest = 'I')
    {
        $defaultConfig = (new \Mpdf\Config\ConfigVariables())->getDefaults();
        $fontDirs = $defaultConfig['fontDir'];

        $defaultFontConfig = (new \Mpdf\Config\FontVariables())->getDefaults();
        $fontData = $defaultFontConfig['fontdata'];
        
        $mpdf = new Mpdf([
            'tempDir' => storage_path() .'/tmp',
            'mode' => 'utf-8',
            'default_font_size' => $font,
            'fontDir' => array_merge($fontDirs, [ public_path() . '/fonts/khmer']),
            'fontdata' => $fontData + [
                'moul' => [
                    'R' => 'KhmerOS_muollight.ttf',
                    'useOTL' => 0x80,
                ],
                'siemreap' => [
                    'R' => 'KhmerOS_siemreap.ttf',
                    'useOTL' => 0x80,
                ],                                
            ],
            'default_font' => 'siemreap',
            'format' => $format,
            'margin_top' => $mTop,
            'margin_left'=> $mLeft,
            'margin_right'=> $mRight,
            'margin_bottom'=> $mBottom,
            'orientation' => $orientation,
            'defaultPageNumStyle' => 'cambodian' 
        ]);
        $mpdf->imageVars['logoLeft'] = file_get_contents(public_path() . '/' .'images/invoice_gas_left.png');
        $mpdf->SetTitle($title);
        $mpdf->shrink_tables_to_fit = 1;
        $mpdf->showWatermarkImage = true;
        $mpdf->use_kwt = true;        
        $mpdf->defaultfooterline = false;
        // $mpdf->setFooter('ទំព័រ {PAGENO} នៃ {nbpg}');         
        
        $stylesheet = file_get_contents(public_path() . '/' .'css/mpdf.css');
        $mpdf->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);
        $mpdf->WriteHTML($htmlReport??'', \Mpdf\HTMLParserMode::HTML_BODY);
        $mpdf->Output($title, $dest);
    }
}