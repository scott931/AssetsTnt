<?php

namespace App\Exports;

use App\Models\Asset;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AssetsExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    protected $filters;

    public function __construct($filters = [])
    {
        $this->filters = $filters;
    }

    public function collection()
    {
        $query = Asset::with(['category', 'department', 'location', 'supplier', 'assignedUser']);

        // Apply filters
        if (!empty($this->filters['category_id'])) {
            $query->where('category_id', $this->filters['category_id']);
        }
        if (!empty($this->filters['department_id'])) {
            $query->where('department_id', $this->filters['department_id']);
        }
        if (!empty($this->filters['location_id'])) {
            $query->where('location_id', $this->filters['location_id']);
        }
        if (!empty($this->filters['status'])) {
            $query->where('status', $this->filters['status']);
        }
        if (!empty($this->filters['condition'])) {
            $query->where('condition', $this->filters['condition']);
        }
        if (!empty($this->filters['supplier_id'])) {
            $query->where('supplier_id', $this->filters['supplier_id']);
        }

        return $query->get();
    }

    public function headings(): array
    {
        return [
            'Asset ID',
            'Asset Tag',
            'Name',
            'Description',
            'Serial Number',
            'Category',
            'Department',
            'Location',
            'Supplier',
            'Status',
            'Condition',
            'Purchase Date',
            'Purchase Cost',
            'Warranty Expiry',
            'Assigned To',
            'Notes',
            'Created At',
            'Updated At'
        ];
    }

    public function map($asset): array
    {
        return [
            $asset->id,
            $asset->asset_tag,
            $asset->name,
            $asset->description,
            $asset->serial_number,
            $asset->category ? $asset->category->name : 'N/A',
            $asset->department ? $asset->department->name : 'N/A',
            $asset->location ? $asset->location->name : 'N/A',
            $asset->supplier ? $asset->supplier->name : 'N/A',
            $asset->status,
            $asset->condition,
            $asset->purchase_date ? $asset->purchase_date->format('Y-m-d') : 'N/A',
            $asset->purchase_cost,
            $asset->warranty_expiry ? $asset->warranty_expiry->format('Y-m-d') : 'N/A',
            $asset->assignedUser ? $asset->assignedUser->name : 'N/A',
            $asset->notes,
            $asset->created_at->format('Y-m-d H:i:s'),
            $asset->updated_at->format('Y-m-d H:i:s')
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true], 'fill' => ['fillType' => 'solid', 'color' => ['rgb' => 'E2E8F0']]],
        ];
    }
}