<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class UsersExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    protected $filters;

    public function __construct($filters = [])
    {
        $this->filters = $filters;
    }

    public function collection()
    {
        $query = User::with(['department', 'location', 'roles']);

        // Apply filters
        if (!empty($this->filters['status'])) {
            $query->where('status', $this->filters['status']);
        }
        if (!empty($this->filters['department_id'])) {
            $query->where('department_id', $this->filters['department_id']);
        }
        if (!empty($this->filters['location_id'])) {
            $query->where('location_id', $this->filters['location_id']);
        }

        return $query->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Email',
            'Phone',
            'Department',
            'Location',
            'Roles',
            'Status',
            'Email Verified At',
            'Created At',
            'Updated At'
        ];
    }

    public function map($user): array
    {
        return [
            $user->id,
            $user->name,
            $user->email,
            $user->phone,
            $user->department ? $user->department->name : 'N/A',
            $user->location ? $user->location->name : 'N/A',
            $user->roles->pluck('name')->implode(', '),
            $user->status,
            $user->email_verified_at ? $user->email_verified_at->format('Y-m-d H:i:s') : 'Not Verified',
            $user->created_at->format('Y-m-d H:i:s'),
            $user->updated_at->format('Y-m-d H:i:s')
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true], 'fill' => ['fillType' => 'solid', 'color' => ['rgb' => 'E2E8F0']]],
        ];
    }
}