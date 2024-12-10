<?php

namespace App\Filament\Resources;

use App\Filament\Exports\DocumentExporter;
use App\Filament\Resources\DocumentResource\Pages;
use App\Filament\Resources\DocumentResource\RelationManagers;
use App\Filament\Resources\DocumentSectionResource\RelationManagers\DocumentRelationManager;
use App\Models\Document;
use App\Models\DocumentType;
use Filament\Actions\Action;
use Filament\Actions\Exports\Enums\ExportFormat;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DocumentResource extends Resource
{
    protected static ?string $model = Document::class;

    protected static ?string $label = 'Hujjatlar';

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Forms\Components\TextInput::make('document_type_id')
                //     ->required()
                //     ->numeric(),
                Forms\Components\Select::make('document_type_id')
                    ->label('Hujjat turi')
                    ->options(DocumentType::pluck('name', 'id'))
                    ->required(),

                Forms\Components\TextInput::make('reg_number')
                    ->label('Qayd raqami')
                    ->required()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('reg_date')
                    ->label('Qayd sanasi')
                    ->required(),
                Forms\Components\Select::make('organization_id')
                    ->label('Tashkilot')
                    ->options(\App\Models\Organization::pluck('name', 'id'))
                    ->required(),
                Forms\Components\DatePicker::make('deadline')
                    ->label('Muddat')
                    ->required(),
                Forms\Components\FileUpload::make('file')
                    ->label('Fayl')
                    ->rules('file', 'mimes:pdf,doc,docx,zip,rar')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('description')
                    ->label('Izoh')
                    ->columnSpanFull(),
                Forms\Components\Select::make('status_id')
                    ->label('Holati')
                    ->options(\App\Models\Status::pluck('name', 'id'))
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->headerActions([
                Tables\Actions\ExportAction::make()
                ->icon('heroicon-o-arrow-down-on-square-stack')
                ->label('Экспорт')
                ->exporter(DocumentExporter::class)
                ->formats([
                    ExportFormat::Xlsx,
                ])
            ])
            ->columns([
                Tables\Columns\TextColumn::make('   ')
                    ->label('Hujjat turi')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('reg_number')
                    ->label('Qayd raqami')
                    ->searchable(),
                Tables\Columns\TextColumn::make('reg_date')
                    ->label('Qayd sanasi')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('organization.name')
                    ->label('Tashkilot')
                    ->sortable(),
                Tables\Columns\TextColumn::make('deadline')
                    ->label('Muddat')
                    ->date()
                    ->sortable(),
                // Tables\Columns\TextColumn::make('status.name')
                //     ->badge()
                //     ->label('Ҳолати')
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('status.name')
                //     ->label('Ҳолати')
                //     ->badge()
                //     ->sortable(),
                Tables\Columns\ColorColumn::make('status.color')
                    ->tooltip(fn($record) => $record->status->name),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                // Filters\SelectFilter::make('document_type_id')
                //     ->label('Ҳужжат тури')
                //     ->options(DocumentType::pluck('name', 'id'))
                //     ->default(''),
                Tables\Filters\SelectFilter::make('document_type_id')
                    ->label('Ҳужжат тури')
                    ->options(DocumentType::pluck('name', 'id'))
                    ->default(''),
                Tables\Filters\Filter::make('deadline')
                    ->form([
                        Forms\Components\DatePicker::make('start_deadline'),
                        Forms\Components\DatePicker::make('end_deadline'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['start_deadline'],
                                fn (Builder $query, $date): Builder => $query->whereDate('deadline', '>=', $date)
                            )
                            ->when(
                                $data['end_deadline'],
                                fn (Builder $query, $date): Builder => $query->whereDate('deadline', '<=', $date),
                            );
                    })
            ])
            ->actions([
                Tables\Actions\Action::make('download')
                    ->name('-')
                    ->tooltip('Юклаб олиш')
                    ->icon('heroicon-o-document-arrow-down')
                    ->action(function ($record) {

                        if (!$record->file) {
                            return Notification::make()
                                ->title('Файл мавжуд эмас')
                                ->danger()
                                ->send();
                        }

                        return response()->download(public_path('storage/' . $record->file));
                    }),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            DocumentRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDocuments::route('/'),
            'create' => Pages\CreateDocument::route('/create'),
            'edit' => Pages\EditDocument::route('/{record}/edit'),
        ];
    }
}
