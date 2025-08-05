<?php

namespace App\Exports;

use App\Models\BuildingRegister;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class BuildingRegisterExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    protected $filters;

    public function __construct($filters = [])
    {
        $this->filters = $filters;
    }

    public function collection()
    {
        $query = BuildingRegister::with('region');

        // Apply filters
        if (!empty($this->filters['search'])) {
            $search = $this->filters['search'];
            $query->where(function($q) use ($search) {
                $q->where('description_name_of_building', 'like', "%{$search}%")
                  ->orWhere('county', 'like', "%{$search}%")
                  ->orWhere('nearest_town_shopping_centre', 'like', "%{$search}%");
            });
        }
        if (!empty($this->filters['category'])) {
            $query->where('category', $this->filters['category']);
        }
        if (!empty($this->filters['type_of_building'])) {
            $query->where('type_of_building', $this->filters['type_of_building']);
        }
        if (!empty($this->filters['designated_use'])) {
            $query->where('designated_use', $this->filters['designated_use']);
        }
        if (!empty($this->filters['region_id'])) {
            $query->where('region_id', $this->filters['region_id']);
        }

        return $query->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Region',
            'Description/Name of Building',
            'Building Ownership',
            'Category',
            'Building Number',
            'Institution Number',
            'Nearest Town/Shopping Centre',
            'Street',
            'County',
            'L.R Number',
            'Size of Land (hectares)',
            'Ownership Status',
            'Source of Funds',
            'Mode of Acquisition',
            'Date of Purchase/Commissioning',
            'Type of Building',
            'Designated Use',
            'Estimated Useful Life (Years)',
            'Number of Floors',
            'Plinth Area (sqm)',
            'Cost of Construction/Valuation',
            'Annual Depreciation',
            'Accumulated Depreciation to Date',
            'Net Book Value',
            'Annual Rental Income',
            'Documents',
            'Remarks',
            'Created At',
            'Updated At'
        ];
    }

    public function map($building): array
    {
        return [
            $building->id,
            $building->region ? $building->region->name : 'N/A',
            $building->description_name_of_building,
            $building->building_ownership,
            $building->category,
            $building->building_number,
            $building->institution_number,
            $building->nearest_town_shopping_centre,
            $building->street,
            $building->county,
            $building->lr_number,
            $building->size_of_land_hectares,
            $building->ownership_status,
            $building->source_of_funds,
            $building->mode_of_acquisition,
            $building->date_of_purchase_commissioning ? $building->date_of_purchase_commissioning->format('Y-m-d') : 'N/A',
            $building->type_of_building,
            $building->designated_use,
            $building->estimated_useful_life_years,
            $building->number_of_floors,
            $building->plinth_area_sqm,
            $building->cost_of_construction_valuation,
            $building->annual_depreciation,
            $building->accumulated_depreciation_to_date,
            $building->net_book_value,
            $building->annual_rental_income,
            $building->hasDocuments() ? 'Yes' : 'No',
            $building->remarks,
            $building->created_at->format('Y-m-d H:i:s'),
            $building->updated_at->format('Y-m-d H:i:s')
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true], 'fill' => ['fillType' => 'solid', 'color' => ['rgb' => 'E2E8F0']]],
        ];
    }
}