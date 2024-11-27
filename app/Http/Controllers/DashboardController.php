<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Soporte;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // **Gráfico de Pastel: Soportes por Sucursal**
        $soportesBySucursal = Soporte::with('sucursal')
            ->selectRaw('sucursal_id, COUNT(*) as total')
            ->groupBy('sucursal_id')
            ->get();

        $chartData = [
            'labels' => $soportesBySucursal->map(fn($soporte) => $soporte->sucursal->nombre)->toArray(),
            'data' => $soportesBySucursal->pluck('total')->toArray(),
        ];

        // **Gráfico de Barras Apiladas: Soportes Urgentes vs No Urgentes por Sucursal**
        $soportesUrgencia = Soporte::with('sucursal')
            ->selectRaw('sucursal_id, urgente, COUNT(*) as total')
            ->groupBy('sucursal_id', 'urgente')
            ->get();

        $barChartLabels = $soportesBySucursal->map(fn($soporte) => $soporte->sucursal->nombre)->toArray();
        $urgentData = [];
        $nonUrgentData = [];

        foreach ($soportesBySucursal as $soporte) {
            $sucursalId = $soporte->sucursal_id;
            $urgentCount = $soportesUrgencia->where('sucursal_id', $sucursalId)->where('urgente', true)->first();
            $nonUrgentCount = $soportesUrgencia->where('sucursal_id', $sucursalId)->where('urgente', false)->first();

            $urgentData[] = $urgentCount ? $urgentCount->total : 0;
            $nonUrgentData[] = $nonUrgentCount ? $nonUrgentCount->total : 0;
        }

        $barChartData = [
            'labels' => $barChartLabels,
            'datasets' => [
                [
                    'label' => 'Urgente',
                    'data' => $urgentData,
                    'backgroundColor' => '#FF6384',
                ],
                [
                    'label' => 'No Urgente',
                    'data' => $nonUrgentData,
                    'backgroundColor' => '#36A2EB',
                ],
            ],
        ];

        // **Gráfico de Línea: Soportes por Mes**
        $soportesPorMes = Soporte::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, COUNT(*) as total')
            ->where('created_at', '>=', Carbon::now()->subYear()) // Últimos 12 meses
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        // Formatear etiquetas de mes
        $lineLabels = $soportesPorMes->map(function($item) {
            return Carbon::create($item->year, $item->month, 1)->format('M Y');
        })->toArray();

        $lineData = $soportesPorMes->pluck('total')->toArray();

        $lineChartData = [
            'labels' => $lineLabels,
            'datasets' => [
                [
                    'label' => 'Soportes Creados',
                    'data' => $lineData,
                    'fill' => false,
                    'borderColor' => '#4BC0C0',
                    'backgroundColor' => '#4BC0C0',
                    'tension' => 0.1
                ],
            ],
        ];

        return view('dashboard', compact('chartData', 'barChartData', 'lineChartData'));
    }
}
