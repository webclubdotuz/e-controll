<?php

namespace App\Filament\Resources\DocumentResource\Pages;

use App\Filament\Resources\DocumentResource;
use App\Models\Document;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListDocuments extends ListRecords
{
    protected static string $resource = DocumentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Hujjat qo`shish'),
        ];
    }

    public function getTabs(): array
    {

        $muddatiYaqin = Document::where('deadline', '>=', now()->subDays(7))
            ->where('status_id', '1')
            ->count();
        $muddatiOtgan = Document::where('deadline', '<', now())
            ->where('status_id', '1')
            ->count();

        return [
            "Barchasi" => Tab::make(),
            "Muddati yaqin" => Tab::make()
                ->modifyQueryUsing(function (Builder $query) {
                    $query->where('deadline', '>=', now()->subDays(7))
                        ->where('status_id', '1');
                })
                ->badge($muddatiYaqin),
            "Muddati otgan" => Tab::make()
                ->modifyQueryUsing(function (Builder $query) {
                    $query->where('deadline', '<', now())
                        ->where('status_id', '1');
                })
                ->badge($muddatiOtgan),
        ];
    }
}
