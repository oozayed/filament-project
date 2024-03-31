<?php

namespace App\Filament\Resources\EmployeeResource\Pages;

use App\Filament\Resources\EmployeeResource;
use App\Models\Employee;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;

class ListEmployees extends ListRecords
{
    protected static string $resource = EmployeeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'All' => Tab::make()
                ->badge(Employee::query()->count()),
            'This Day' => Tab::make()
            ->modifyQueryUsing(function ($query) {
                $query->whereDate('created_at', now());
            })
            ->badge(Employee::query()->whereDate('created_at', now())->count()),
            'This Month' => Tab::make()
            ->modifyQueryUsing(function ($query) {
                $query->whereMonth('created_at', now()->month);
            })
                ->badge(Employee::query()->whereMonth('created_at', now()->month)->count()),
            'This Year' => Tab::make()
            ->modifyQueryUsing(function ($query) {
                $query->whereYear('created_at', now()->year);
            })
                ->badge(Employee::query()->whereYear('created_at', now()->year)->count()),
        ];
    }
}
