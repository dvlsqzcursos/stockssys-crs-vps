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

use App\Models\RutaSolicitud, App\Models\Bodega, App\Models\Solicitud;
use Illuminate\Support\Facades\Http;
use DB, Carbon\Carbon,  Auth;

class GuiaTerrestreExport implements FromView, WithEvents, WithTitle
{
    /**
    * @return \Illuminate\Support\Collection
    */


    public $idSolicitud;
    public $services_siigss;
    public $datos;
    public $servicios;

    function __construct($data){
        
        $this->idSolicitud = $data['idSolicitud'];
        $this->idRuta = $data['idRuta'];
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
                

                $event->sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_PORTRAIT);
                $event->sheet->getPageSetup()->setPaperSize(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_A4);
                $event->sheet->getPageSetup()->setFitToPage(true);
                //$event->sheet->setShowGridlines(False);

                $event->sheet->getParent()->getActiveSheet()->getProtection()->setSheet(true);
        
                // lock all cells then unlock the cell
                $event->sheet->getParent()->getActiveSheet()
                    ->getStyle('J3:P6')
                    ->getProtection()
                    ->setLocked(Protection::PROTECTION_UNPROTECTED);

                
                $event->sheet->mergeCells('C1:P1');        
                $event->sheet->getStyle('C1:P1')->getAlignment()->setHorizontal('center');
                $event->sheet->setCellValue('C1', 'Programa "Aprendizaje para la vida" "Nojb\'al rech K\'aslemal" (K\'iche)');
                $event->sheet->getStyle('C1')->getFont()->setBold(true);
                $event->sheet->mergeCells('C2:P2');        
                $event->sheet->getStyle('C2:P2')->getAlignment()->setHorizontal('center');
                $event->sheet->setCellValue('C2', 'Pastoral Social Cáritas de los Altos ');
                $event->sheet->getStyle('C2')->getFont()->setBold(true);

                $event->sheet->mergeCells('A4:G4');        
                $event->sheet->setCellValue('A4', 'Arquidiocesis de los Altos Quetzaltenango Totonicapán');                
                $event->sheet->mergeCells('A5:G5');        
                $event->sheet->setCellValue('A5', 'Bodega PSC Salcajá #12');
                $event->sheet->mergeCells('A6:G6');        
                $event->sheet->setCellValue('A6', 'KM. 190 Autopista Los Altos, Salcajá Quetzaltenango');
                $event->sheet->mergeCells('A7:G7');        
                $event->sheet->setCellValue('A7', 'Teléfono: 77688109');
                $event->sheet->getStyle('A4:G7')->getFont()->setBold(true);
                
                
                $event->sheet->mergeCells('A10:B10');        
                $event->sheet->setCellValue('A10', 'Fecha de traslado:');
                $event->sheet->getStyle('A10')->getFont()->setBold(true);

                $event->sheet->mergeCells('M10:P10');        
                $event->sheet->setCellValue('M10', 'Periodo correspondiente:');
                $event->sheet->getStyle('M10')->getFont()->setBold(true);
                /*---------------------------------------------------------------------------------------------------------------------*/   
                $event->sheet->mergeCells('A12:T12');        
                $event->sheet->getStyle('A12:T12')->getAlignment()->setHorizontal('center');
                $event->sheet->setCellValue('A12', 'GUIA DE TRANSPORTE TERRESTRE');
                $event->sheet->getStyle('A12')->getFont()->setBold(true);
                $event->sheet->getStyle('A12:T12')->getBorders()->getOutline()->setBorderStyle(Border::BORDER_MEDIUM);
                /*---------------------------------------------------------------------------------------------------------------------*/
                $ruta = RutaSolicitud::with(['ruta_base', 'detalles'])->where('id',$this->idRuta)->first();
                $event->sheet->mergeCells('A14:C14');        
                $event->sheet->setCellValue('A14', 'Ruta:');        
                $event->sheet->mergeCells('D14:G14');        
                $event->sheet->setCellValue('D14', $ruta->nombre);        
                $event->sheet->mergeCells('A15:C15');        
                $event->sheet->setCellValue('A15', 'Empresa del Transporte:');
                $event->sheet->mergeCells('D15:G15');        
                $event->sheet->setCellValue('D15', $ruta->empresa_transporte);   
                $event->sheet->mergeCells('A16:C16');        
                $event->sheet->setCellValue('A16', 'Nombre del Piloto:');
                $event->sheet->mergeCells('D16:G16');        
                $event->sheet->setCellValue('D16', $ruta->nombre_piloto);   
                $event->sheet->mergeCells('A17:C17');        
                $event->sheet->setCellValue('A17', 'Número de licencia:');
                $event->sheet->mergeCells('D17:G17');        
                $event->sheet->setCellValue('D17', $ruta->no_licencia);   
                $event->sheet->getStyle('A14:C17')->getFont()->setBold(true);

                $event->sheet->mergeCells('M14:O14');        
                $event->sheet->setCellValue('M14', 'Dirección de Emisión:');    
                $event->sheet->mergeCells('P14:S14');        
                $event->sheet->setCellValue('P14', '');              
                $event->sheet->mergeCells('M15:O15');        
                $event->sheet->setCellValue('M15', 'Municipio de Destino:');
                $event->sheet->mergeCells('P15:S15');        
                $event->sheet->setCellValue('P15', $ruta->ruta_base->ubicacion->nombre);
                $event->sheet->mergeCells('M16:O16');        
                $event->sheet->setCellValue('M16', 'Placa del Vehículo:');
                $event->sheet->mergeCells('P16:S16');        
                $event->sheet->setCellValue('P16', $ruta->placa_vehiculo);
                $event->sheet->mergeCells('M17:O17');        
                $event->sheet->setCellValue('M17', 'Tipo de Vehículo:');
                $event->sheet->mergeCells('P17:S17');        
                $event->sheet->setCellValue('P17', $ruta->tipo_vehiculo);
                $event->sheet->getStyle('M14:O17')->getFont()->setBold(true);
                /*---------------------------------------------------------------------------------------------------------------------*/
                $event->sheet->mergeCells('A19:T20'); 
                $event->sheet->setCellValue('A19', 'NOTA: El encargado del transporte se responsabiliza por daños o diferencias en las unidades o cantidades que no sean entregadas en la bodega de destino, por diferencia de esta guía.');
                /*---------------------------------------------------------------------------------------------------------------------*/
                $event->sheet->mergeCells('A22');        
                $event->sheet->setCellValue('A22', 'CODIGO');
                $event->sheet->mergeCells('B22');        
                $event->sheet->setCellValue('B22', 'ESCUELA');        
                $event->sheet->setCellValue('C22', 'Part.');

                $columnas = ['G','I','J','K','L','M','N','O','P','Q'];
                $cantidad_alimentos = Bodega::where('categoria', 0)->where('tipo_bodega',1)->where('id_institucion', Auth::user()->id_institucion)->count();
                $alimentos = Bodega::where('categoria', 0)->where('tipo_bodega',1)->where('id_institucion', Auth::user()->id_institucion)->get();

                $prueba = ['D','F','H','J','L'];
                $row = 1;
                $d = 0;
                for($i =0; $i < count($prueba); $i++){
                    for($f = 0; $f < $cantidad_alimentos; $f++){
                        $event->sheet->setCellValue($prueba[$i].'22', $alimentos[$d]->id.'-'.$alimentos[$d]->nombre);
                    }
                    $d++;
                }

                $detalle_escuelas = DB::table('rutas_solicitudes_despachos as r')   
                    ->select(
                        'e.id as escuela_id',
                        'e.codigo as escuela_codigo',
                        'e.nombre as escuela_nombre',
                        'be.id as egreso',
                        'ra.id as idracion',
                        'ra.nombre as racion',

                    )         
                    ->join('rutas_solicitudes_despachos_detalles as rdet', 'rdet.id_ruta_despacho', 'r.id')
                    ->join('escuelas as e', 'e.id', 'rdet.id_escuela')
                    ->join('bodegas_egresos as be', 'be.id_escuela_despacho', 'rdet.id_escuela')
                    ->join('raciones as ra', 'ra.id', 'be.tipo_racion')
                    ->where('r.id', $this->idRuta)
                    ->where('r.id_solicitud_despacho', $this->idSolicitud)       
                    ->orderby('e.id', 'ASC')  
                    ->get();

                $detalles = $detalle_escuelas->map(function ($detalle_escuelas){
                    $detalles_alimentos = DB::table('bodegas_egresos_detalles as det')   
                    ->select(
                        'det.id_insumo',DB::raw('SUM(det.no_unidades) as no_unidades')
        
                    )      
                    ->where('det.id_egreso', $detalle_escuelas->egreso)
                    ->groupBy('det.id_insumo') 
                    ->get();
        
        
                    return collect([
                        'escuela_id' => $detalle_escuelas->escuela_id,
                        'idracion' => $detalle_escuelas->idracion,
                        'detalles_alimentos' => $detalles_alimentos->map(function ($detalles_alimentos){
                            return [
                                'id_insumo' => $detalles_alimentos->id_insumo,
                                'no_unidades' => $detalles_alimentos->no_unidades,
                            ];
                        }),
                    ]);
                });

                foreach (range('A','T') as $col) {
                    $event->sheet->getColumnDimension($col)->setAutoSize(true);
                 }

                $row = 23;
                $c = 0;
                for($f = 0; $f < count($detalle_escuelas); $f++){
                    $event->sheet->setCellValue('A'.$row, $detalle_escuelas[$c]->escuela_codigo);
                    $event->sheet->setCellValue('B'.$row, $detalle_escuelas[$c]->escuela_nombre);
                    
                                                      
                                       
                    $a = 0;
                    for($x = 0; $x < count($detalles); $x++){
                        if($detalle_escuelas[$c]->escuela_id == $detalles[$a]['escuela_id'] && $detalle_escuelas[$c]->idracion == $detalles[$a]['idracion']){
                            $l=0;
                            for($k = 0; $k < count($detalles[$a]['detalles_alimentos']); $k++){
                                $w=0;
                                for($n =0; $n < count($alimentos); $n++){
                                    if($detalles[$a]['detalles_alimentos'][$l]['id_insumo'] == $alimentos[$w]->id){
                                        $event->sheet->setCellValue($prueba[$w].$row, $detalles[$a]['detalles_alimentos'][$l]['no_unidades']);
                                    }
                                    
                                    $w++;
                                }  
                                $l++;
                            }
                        }
                        
                        $a++;
                    }

                    $c++;
                    $row++;
                    
                }

                $event->sheet->getStyle('A22:T'.$row-1)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

                
                



                

                
            },
        ];
    }

}
