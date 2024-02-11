<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Style\Protection;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Border;

use App\Models\Bodega;
use Illuminate\Support\Facades\Http;
use DB, Carbon\Carbon,  Auth;

class InformeMensualExport implements FromView, WithEvents, WithDrawings, WithTitle
{
    /**
    * @return \Illuminate\Support\Collection
    */


    function __construct(){

    }



    public function view(): View{
        

        $data = [
            
        ];

        return view('admin.reportes.vistas.informe_mensual', $data);
    }

    public function title(): string
    {   
        //return 'Día '.Carbon::now()->format('d');
        return 'Informe mensual - '.Carbon::now()->year;
    }

    public function registerEvents(): array{
        return [
            AfterSheet::class    => function(AfterSheet $event){
                

                $event->sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
                $event->sheet->getPageSetup()->setPaperSize(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_LEGAL);
                $event->sheet->getPageSetup()->setFitToPage(true);
                //$event->sheet->setShowGridlines(False);

                $event->sheet->getParent()->getActiveSheet()->getProtection()->setSheet(true);
        
                // lock all cells then unlock the cell
                $event->sheet->getParent()->getActiveSheet()
                    ->getStyle('J3:P6')
                    ->getProtection()
                    ->setLocked(Protection::PROTECTION_UNPROTECTED);

                $event->sheet->getStyle('A1:T47')->getFont()->setName('Corbel')->setSize(10);
                $event->sheet->getColumnDimension('A')->setWidth(2.57);
                $event->sheet->getColumnDimension('B')->setWidth(2.57);
                $event->sheet->getColumnDimension('C')->setWidth(2.57);
                $event->sheet->getColumnDimension('D')->setWidth(12.00);
                $event->sheet->getColumnDimension('E')->setWidth(12.00);
                $event->sheet->getColumnDimension('F')->setWidth(12.29);
                $event->sheet->getColumnDimension('R')->setWidth(13.86);
                $event->sheet->getColumnDimension('S')->setWidth(13.86);
                $event->sheet->getColumnDimension('T')->setWidth(12.14);
                $event->sheet->getRowDimension('6')->setRowHeight(23.25);
        
                $event->sheet->mergeCells('J3:P3');        
                $event->sheet->getStyle('J3:P3')->getAlignment()->setHorizontal('center');
                $event->sheet->setCellValue('J3', 'PASTORAL SOCIAL CARITAS QUETZALTENANGO TOTONICAPAN');
                $event->sheet->getStyle('J3')->getFont()->setBold(true);
                $event->sheet->mergeCells('J4:P4');        
                $event->sheet->getStyle('J4:P4')->getAlignment()->setHorizontal('center');
                $event->sheet->setCellValue('J4', 'PROGRAMA APRENDIZAJE PARA LA VIDA');
                $event->sheet->getStyle('J4')->getFont()->setBold(true);
                $event->sheet->mergeCells('J5:P5');  
                $event->sheet->getStyle('J5:P5')->getAlignment()->setHorizontal('center');      
                $event->sheet->setCellValue('J5', 'INFORME MENSUAL DE ALIMENTOS');
                $event->sheet->getStyle('J5')->getFont()->setBold(true);
                $event->sheet->mergeCells('J6:P6'); 
                $event->sheet->getStyle('J6:P6')->getAlignment()->setHorizontal('center');       
                $event->sheet->setCellValue('J6', Auth::user()->institucion->nombre);

                $event->sheet->getStyle('J6')->getFont()->setBold(true);

                $event->sheet->mergeCells('A7:B7');   
                $event->sheet->setCellValue('A7', 'Mes:');
                $event->sheet->mergeCells('C7:E7');  
                $event->sheet->getStyle('C7:E7')->getAlignment()->setHorizontal('center');       
                $event->sheet->getStyle('C7:E7')->getBorders()->getBottom()->setBorderStyle(Border::BORDER_THIN);        
                $event->sheet->getStyle('A7:E7')->getFont()->setBold(true); 
                
                $event->sheet->getStyle('S3:T3')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
                $event->sheet->setCellValue('S3', 'No.');        
                $event->sheet->getStyle('S3:T3')->getFont()->setBold(true); 
        
                $event->sheet->setCellValue('S7', 'Año:');
                $event->sheet->getStyle('T7')->getBorders()->getBottom()->setBorderStyle(Border::BORDER_THIN);
                $event->sheet->getStyle('S7:T7')->getFont()->setBold(true); 
        
                $event->sheet->getStyle('A9:F12')->getBorders()->getOutline()->setBorderStyle(Border::BORDER_MEDIUM);
        
                $event->sheet->mergeCells('A13:F13');
                $event->sheet->getStyle('A13:F13')->getBorders()->getOutline()->setBorderStyle(Border::BORDER_MEDIUM);
                $event->sheet->getStyle('A13:F13')->getAlignment()->setHorizontal('center');       
                $event->sheet->setCellValue('A13', 'P/L:');
                $event->sheet->getStyle('A13')->getFont()->setBold(true);
        
                $event->sheet->getStyle('A14:F14')->getBorders()->getOutline()->setBorderStyle(Border::BORDER_MEDIUM);
                $event->sheet->setCellValue('A14', 'A.');
                $event->sheet->mergeCells('B14:F14');
                $event->sheet->setCellValue('B14', 'BALANCE INICIAL:');
        
                $event->sheet->getStyle('A15:F17')->getBorders()->getOutline()->setBorderStyle(Border::BORDER_MEDIUM);
                $event->sheet->mergeCells('A15:A17');
                $event->sheet->setCellValue('A15', 'INGRESOS:');
                $event->sheet->getStyle('A15:A17')->getAlignment()->setVertical('center');
                $event->sheet->getStyle('A15')->getFont()->setSize(8);
                $event->sheet->getStyle('A15')->getAlignment()->setTextRotation(90);
                $event->sheet->getStyle('C15:F16')->getBorders()->getInside()->setBorderStyle(Border::BORDER_THIN);
                $event->sheet->setCellValue('C15', 'B.');
                $event->sheet->mergeCells('D15:F15');
                $event->sheet->setCellValue('D15', 'De CRS');
                $event->sheet->setCellValue('C16', 'C.');
                $event->sheet->mergeCells('D16:F16');
                $event->sheet->setCellValue('D16', 'Traslados');
                $event->sheet->setCellValue('B17', 'D.');
                $event->sheet->mergeCells('C17:F17');
                $event->sheet->setCellValue('C17', 'Total de Ingresos ( = B.+C. )');
                
                $event->sheet->getStyle('A18:F19')->getBorders()->getInside()->setBorderStyle(Border::BORDER_THIN);
                $event->sheet->getStyle('A18:F19')->getBorders()->getOutline()->setBorderStyle(Border::BORDER_MEDIUM);
                $event->sheet->setCellValue('A18', 'E.');
                $event->sheet->mergeCells('B18:F18');
                $event->sheet->setCellValue('B18', 'TOTAL DISPONIBLE ( = A.+D. )');
                $event->sheet->mergeCells('D19:F19');
                $event->sheet->setCellValue('D19', 'TONELADAS METRICAS RACION ESCOLAR');
        
                $event->sheet->getStyle('A20:F26')->getBorders()->getInside()->setBorderStyle(Border::BORDER_THIN);
                $event->sheet->mergeCells('A21:A26');
                $event->sheet->setCellValue('A21', 'EGRESOS:');
                $event->sheet->getStyle('A21')->getFont()->setSize(8);
                $event->sheet->getStyle('A21')->getAlignment()->setTextRotation(90);
                $event->sheet->getStyle('A21:A26')->getAlignment()->setVertical('center');
                $event->sheet->setCellValue('C20', 'F1.');
                $event->sheet->getStyle('C20')->getFont()->setBold(true); 
                $event->sheet->mergeCells('D20:F20');
                $event->sheet->setCellValue('D20', 'Distribuido RACION ESCOLAR');
                $event->sheet->setCellValue('C21', 'F2.');
                $event->sheet->getStyle('C21')->getFont()->setBold(true); 
                $event->sheet->mergeCells('D21:F21');
                $event->sheet->setCellValue('D21', 'Distribuido RACION P. LLEVAR A CASA');
                $event->sheet->setCellValue('C22', 'G.');
                $event->sheet->getStyle('C22')->getFont()->setBold(true); 
                $event->sheet->mergeCells('D22:F22');
                $event->sheet->setCellValue('D22', 'Distribuido RACION LIDERES (AS)');
                $event->sheet->setCellValue('C23', 'H.');
                $event->sheet->getStyle('C23')->getFont()->setBold(true); 
                $event->sheet->mergeCells('D23:F23');
                $event->sheet->setCellValue('D23', 'Distribuido donacion de saldos de inventario');
                $event->sheet->setCellValue('C24', 'I.');
                $event->sheet->getStyle('C24')->getFont()->setBold(true); 
                $event->sheet->mergeCells('D24:F24');
                $event->sheet->setCellValue('D24', 'Demostraciones');
                $event->sheet->setCellValue('C25', 'J.');
                $event->sheet->getStyle('C25')->getFont()->setBold(true); 
                $event->sheet->mergeCells('D25:F25');
                $event->sheet->setCellValue('D25', 'Traslados');
                $event->sheet->setCellValue('B26', 'K.');
                $event->sheet->mergeCells('C26:F26');
                $event->sheet->setCellValue('C26', 'Total de egresos ( = F.+G.+H.+I.+J. )');
                $event->sheet->getStyle('B26:Q26')->getBorders()->getOutline()->setBorderStyle(Border::BORDER_MEDIUM);
                $event->sheet->getStyle('B26:Q26')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('f2f2f2');
        
                $event->sheet->getStyle('A27:F27')->getBorders()->getOutline()->setBorderStyle(Border::BORDER_MEDIUM);
                $event->sheet->setCellValue('A27', 'L.');
                $event->sheet->mergeCells('B27:F27');
                $event->sheet->setCellValue('B27', 'BALANCE A LA FECHA ( = E.- K.)');
        
                $event->sheet->getStyle('A28:F28')->getBorders()->getOutline()->setBorderStyle(Border::BORDER_MEDIUM);
                $event->sheet->setCellValue('A28', 'M.');
                $event->sheet->mergeCells('B28:F28');
                $event->sheet->setCellValue('B28', 'INVENTARIO FÍSICO');
                $event->sheet->getStyle('A28:B28')->getFont()->setBold(true); 
                $event->sheet->getStyle('A28:Q28')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('c0c0c0');
        
                $event->sheet->getStyle('A29:F29')->getBorders()->getOutline()->setBorderStyle(Border::BORDER_MEDIUM);
                $event->sheet->setCellValue('A29', 'N.');
                $event->sheet->mergeCells('B29:F29');
                $event->sheet->setCellValue('B29', 'DIFERENCIA ( = L.-M.)');
        
                $event->sheet->getStyle('A30:F33')->getBorders()->getOutline()->setBorderStyle(Border::BORDER_MEDIUM);
                $event->sheet->mergeCells('A30:A33');
                $event->sheet->setCellValue('A30', 'PERDIDAS:');
                $event->sheet->getStyle('A30')->getFont()->setSize(8);
                $event->sheet->getStyle('A30')->getAlignment()->setTextRotation(90);
                $event->sheet->getStyle('A30:A33')->getAlignment()->setVertical('center');
                $event->sheet->getStyle('C30:F30')->getBorders()->getOutline()->setBorderStyle(Border::BORDER_THIN);
                $event->sheet->setCellValue('C30', 'O.');
                $event->sheet->mergeCells('D30:F30');
                $event->sheet->setCellValue('D30', 'Cuestionable');
                $event->sheet->getStyle('C31:F31')->getBorders()->getOutline()->setBorderStyle(Border::BORDER_THIN);
                $event->sheet->setCellValue('C31', 'P.');
                $event->sheet->mergeCells('D31:F31');
                $event->sheet->setCellValue('D31', 'Mal Estado');
                $event->sheet->getStyle('C32:F32')->getBorders()->getOutline()->setBorderStyle(Border::BORDER_THIN);
                $event->sheet->setCellValue('C32', 'Q.');
                $event->sheet->mergeCells('D32:F32');
                $event->sheet->setCellValue('D32', 'Faltantes / Sobrante');
                $event->sheet->getStyle('B33:F33')->getBorders()->getOutline()->setBorderStyle(Border::BORDER_MEDIUM);
                $event->sheet->setCellValue('B33', 'R.');
                $event->sheet->mergeCells('C33:F33');
                $event->sheet->setCellValue('C33', 'Total de Pérdidas ( = O.+P.+Q.)');
        
                $event->sheet->getStyle('A34:F34')->getBorders()->getOutline()->setBorderStyle(Border::BORDER_MEDIUM);
                $event->sheet->setCellValue('A34', 'S.');
                $event->sheet->mergeCells('B34:F34');
                $event->sheet->setCellValue('B34', 'Diferencias en Peso ( = N.+ - R.)');
        
                $event->sheet->getStyle('A35:F35')->getBorders()->getOutline()->setBorderStyle(Border::BORDER_MEDIUM);
                $event->sheet->setCellValue('A35', 'T.');
                $event->sheet->getRowDimension('35')->setRowHeight(26.25);
                $event->sheet->mergeCells('B35:F35');
                $event->sheet->setCellValue('B35', 'BALANCE FINAL ( = L.+N. )');
        
                $event->sheet->getStyle('C36:T37')->getBorders()->getOutline()->setBorderStyle(Border::BORDER_MEDIUM);
                $event->sheet->mergeCells('C36:E36');
                $event->sheet->setCellValue('C36', 'OBSERVACIONES:');
                $event->sheet->getStyle('C36')->getFont()->setSize(8);
                $event->sheet->getStyle('C36')->getFont()->setBold(true);        
                $event->sheet->getStyle('C36:E36')->getAlignment()->setHorizontal('right');   
                $event->sheet->getStyle('C36:E36')->getBorders()->getBottom()->setBorderStyle(Border::BORDER_THIN);  
        
                
                $columnas = ['G','I','J','K','L','M','N','O','P','Q'];
                $filas = ['18','19','20','21','22','23','24','25','26','27','28','29','30','31','32','33','34','35'];
                
                for($i=0; $i<count($columnas); $i++){
                    for($j=1; $j<=count($columnas); $j+=2){
                        $event->sheet->getStyle($columnas[$i].'9:'.$columnas[$j].'10')->getBorders()->getOutline()->setBorderStyle(Border::BORDER_MEDIUM);
                        $event->sheet->mergeCells($columnas[$i].'9:'.$columnas[$j].'10');
                        $event->sheet->getStyle($columnas[$i].'9:'.$columnas[$j].'10')->getAlignment()->setHorizontal('center');   
                        $event->sheet->getStyle($columnas[$i].'9:'.$columnas[$j].'10')->getAlignment()->setVertical('center');  
                        
                            
        
        
                        $event->sheet->getStyle($columnas[$i].'11:'.$columnas[$j].'12')->getBorders()->getOutline()->setBorderStyle(Border::BORDER_MEDIUM);
                        $event->sheet->mergeCells($columnas[$i].'11:'.$columnas[$j].'11');
                        $event->sheet->mergeCells($columnas[$i].'12:'.$columnas[$j].'12');      
                        
                        $event->sheet->getStyle($columnas[$i].'14:'.$columnas[$j].'17')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
                        
                    }
                    $event->sheet->getStyle($columnas[$i].'13:'.$columnas[$i].'13')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_MEDIUM);
                    $event->sheet->getStyle($columnas[$i].'18:'.$columnas[$i].'18')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('f2f2f2');

                }
        
                $event->sheet->getStyle('R9:T12')->getAlignment()->setHorizontal('center');  
                $event->sheet->getStyle('R9:R12')->getBorders()->getOutline()->setBorderStyle(Border::BORDER_MEDIUM);
                $event->sheet->getStyle('R9:T12')->getFont()->setSize(7);
                $event->sheet->setCellValue('R9', 'SOCIO');
                $event->sheet->setCellValue('R10', 'PARTICIPANTES');
                $event->sheet->setCellValue('R11', 'RECIBIDOS');
                $event->sheet->setCellValue('R12', 'SOLICITUD');
                $event->sheet->getStyle('S9:T12')->getBorders()->getOutline()->setBorderStyle(Border::BORDER_MEDIUM);
                $event->sheet->mergeCells('S9:T9');
                $event->sheet->setCellValue('S9', 'BODEGA');
                $event->sheet->setCellValue('S10', 'PARTICIPANTES');
                $event->sheet->setCellValue('T10', 'RACIONES');
                $event->sheet->setCellValue('S11', 'DISTRIBUIDOS');
                $event->sheet->setCellValue('T11', 'DISTRIBUIDAS');
        
                $event->sheet->getStyle('R13:T18')->getBorders()->getOutline()->setBorderStyle(Border::BORDER_MEDIUM);
                $event->sheet->getStyle('R13:R18')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('f2f2f2');
                $event->sheet->getStyle('S13:T18')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('c0c0c0');
        
        
                for($k=0; $k<count($filas); $k++){
                    for($i=0; $i<count($columnas); $i++){
                        for($j=1; $j<=count($columnas); $j+=2){
                        
                            $event->sheet->mergeCells($columnas[$i].$filas[$k].':'.$columnas[$j].$filas[$k]);
                            $event->sheet->getStyle($columnas[$i].$filas[$k].':'.$columnas[$j].$filas[$k])->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
                        }
                    }
                }
        
                $event->sheet->getStyle('R19:T25')->getBorders()->getOutline()->setBorderStyle(Border::BORDER_MEDIUM);
                $event->sheet->getStyle('R19:T25')->getBorders()->getInside()->setBorderStyle(Border::BORDER_THIN);
        
                $event->sheet->getStyle('R26:T35')->getBorders()->getOutline()->setBorderStyle(Border::BORDER_MEDIUM);
                $event->sheet->getStyle('R26:T35')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('c0c0c0');







                
                $cantidad_alimentos = Bodega::where('categoria', 0)->where('tipo_bodega',1)->where('id_institucion', Auth::user()->id_institucion)->count();
                $alimentos = Bodega::where('categoria', 0)->where('tipo_bodega',1)->where('id_institucion', Auth::user()->id_institucion)->get();
                for($i=0; $i<count($columnas); $i++){
                    for($d = 0; $d < $cantidad_alimentos; $d++){
                        //xc $event->sheet->setCellValue($columnas[$i].'9', $alimentos[$d]->nombre);
                        $event->sheet->getStyle($columnas[$i].'9')->getFont()->setSize(12);
                        $event->sheet->getStyle($columnas[$i].'9')->getFont()->setBold(true);
                    }
                }

                $prueba = ['G','J','L','N','P'];
                $row = 1;
                $d = 0;
                for($i =0; $i < count($prueba); $i++){
                    for($f = 0; $f < $cantidad_alimentos; $f++){
                        $event->sheet->setCellValue($prueba[$i].'9', $alimentos[$d]->nombre);
                    }
                    $d++;
                }

                $event->sheet->setCellValue('B40', 'F.');
                $event->sheet->getStyle('B40')->getFont()->setBold(true);
                $event->sheet->getStyle('B40')->getAlignment()->setHorizontal('right');  
                $event->sheet->mergeCells('C40:F40');  
                $event->sheet->getStyle('C40:F40')->getAlignment()->setHorizontal('center');       
                $event->sheet->getStyle('C40:F40')->getBorders()->getBottom()->setBorderStyle(Border::BORDER_THIN);                        
                $event->sheet->getStyle('C41:F41')->getAlignment()->setHorizontal('center');       
                $event->sheet->getStyle('C41:F41')->getBorders()->getBottom()->setBorderStyle(Border::BORDER_THIN);   
                $event->sheet->mergeCells('C41:F41');  
                $event->sheet->getStyle('C41:F41')->getAlignment()->setHorizontal('center');  
                $event->sheet->mergeCells('C42:F42');  
                $event->sheet->getStyle('C42:F42')->getAlignment()->setHorizontal('center');  

                $event->sheet->setCellValue('J40', 'F.');
                $event->sheet->getStyle('J40')->getFont()->setBold(true); 
                $event->sheet->getStyle('J40')->getAlignment()->setHorizontal('right');  
                $event->sheet->mergeCells('K40:N40');  
                $event->sheet->getStyle('K40:N40')->getAlignment()->setHorizontal('center');       
                $event->sheet->getStyle('K40:N40')->getBorders()->getBottom()->setBorderStyle(Border::BORDER_THIN);             
                $event->sheet->getStyle('K41:N41')->getAlignment()->setHorizontal('center');       
                $event->sheet->getStyle('K41:N41')->getBorders()->getBottom()->setBorderStyle(Border::BORDER_THIN);    
                $event->sheet->mergeCells('K41:N41');  
                $event->sheet->getStyle('K41:N41')->getAlignment()->setHorizontal('center');
                $event->sheet->mergeCells('K42:N42');  
                $event->sheet->getStyle('K42:N42')->getAlignment()->setHorizontal('center');
                

                $event->sheet->setCellValue('D44', 'Fecha');
                $event->sheet->getStyle('D44')->getFont()->setBold(true);
                $event->sheet->getStyle('D44')->getAlignment()->setHorizontal('right');  
                $event->sheet->mergeCells('E44:F44');  
                $event->sheet->getStyle('E44:F44')->getAlignment()->setHorizontal('center');       
                $event->sheet->getStyle('E44:F44')->getBorders()->getBottom()->setBorderStyle(Border::BORDER_THIN);      
                $event->sheet->setCellValue('E44', Carbon::now()->format('d/m/Y'));  
                 

                $event->sheet->setCellValue('J44', 'Fecha');
                $event->sheet->getStyle('J44')->getFont()->setBold(true); 
                $event->sheet->getStyle('J44')->getAlignment()->setHorizontal('right');  
                $event->sheet->mergeCells('K44:L44');  
                $event->sheet->getStyle('K44:L44')->getAlignment()->setHorizontal('center');       
                $event->sheet->getStyle('K44:L44')->getBorders()->getBottom()->setBorderStyle(Border::BORDER_THIN);  
                $event->sheet->setCellValue('K44', Carbon::now()->format('d/m/Y'));       
                

              
                

                

                
            },
        ];
    }

    public function drawings()
    {
        $drawing = new Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('This is my logo');
        $drawing->setPath(public_path('/static/imagenes/crs_1.png'));
        $drawing->setHeight(100);
        $drawing->setOffsetX(30);
        $drawing->setOffsetY(2);
        $drawing->setCoordinates('A1');

        return $drawing;
    }
}
