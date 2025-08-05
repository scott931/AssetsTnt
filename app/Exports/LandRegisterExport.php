<?php

namespace App\Exports;

use App\Models\LandRegister;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class LandRegisterExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    protected $filters;

    public function __construct($filters = [])
    {
        $this->filters = $filters;
    }

    public function collection()
    {
        $query = LandRegister::query();

        // Apply filters
        if (!empty($this->filters['search'])) {
            $search = $this->filters['search'];
            $query->where(function($q) use ($search) {
                $q->where('description_of_land', 'like', "%{$search}%")
                  ->orWhere('county', 'like', "%{$search}%")
                  ->orWhere('nearest_town_location', 'like', "%{$search}%");
            });
        }
        if (!empty($this->filters['category'])) {
            $query->where('category', $this->filters['category']);
        }
        if (!empty($this->filters['mode_of_acquisition'])) {
            $query->where('mode_of_acquisition', $this->filters['mode_of_acquisition']);
        }

        return $query->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Description of Land',
            'Mode of Acquisition',
            'Category',
            'County',
            'Nearest Town/Location',
            'GPS Coordinates',
            'Size (hectares)',
            'Ownership Status',
            'Source of Funds',
            'Date of Purchase',
            'Purchase Cost',
            'Current Value',
            'Documents',
            'Remarks',
            'Created At',
            'Updated At'
        ];
    }

    public function map($land): array
    {
        return [
            $land->id,
            $land->description_of_land,
            $land->mode_of_acquisition,
            $land->category,
            $land->county,
            $land->nearest_town_location,
            $land->gps_coordinates,
            $land->size_of_land_hectares,
            $land->ownership_status,
            $land->source_of_funds,
            $land->date_of_purchase ? $land->date_of_purchase->format('Y-m-d') : 'N/A',
            $land->purchase_cost,
            $land->current_value,
            $land->hasDocuments() ? 'Yes' : 'No',
            $land->remarks,
            $land->created_at->format('Y-m-d H:i:s'),
            $land->updated_at->format('Y-m-d H:i:s')
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true], 'fill' => ['fillType' => 'solid', 'color' => ['rgb' => 'E2E8F0']]],
        ];
    }
}