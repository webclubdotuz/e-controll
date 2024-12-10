<?php

namespace App\Filament\Exports;

use App\Models\Document;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class DocumentExporter extends Exporter
{
    protected static ?string $model = Document::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')->label('ID'),
            ExportColumn::make('documentType.name')->label('Hujjat turi'),
            ExportColumn::make('reg_number')->label('Qayd raqami'),
            ExportColumn::make('reg_date')->label('Qayd sanasi'),
            ExportColumn::make('organization.name')->label('Tashkilot'),
            ExportColumn::make('deadline')->label('Muddat'),
            ExportColumn::make('description')->label('Izoh'),
            ExportColumn::make('status.name')->label('Holati'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your document export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
