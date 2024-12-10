<?php

namespace App\Filament\Resources\DocumentSectionResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DocumentRelationManager extends RelationManager
{
    protected static string $relationship = 'documentSections';

    protected static ?string $label = 'bo\'lim';
    protected static ?string $pluralLabel = 'document';
    protected static ?string $title = 'Yuborilgan bo\'limlar';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('section_id')
                    ->live()
                    ->label('Бўлим')
                    ->options(\App\Models\Section::pluck('name', 'id'))
                    ->required(),
                Forms\Components\Select::make('employee_id')
                    ->label('Ишчи')
                    ->options(function(Forms\Get $get) {
                        return \App\Models\Employee::where('section_id', $get('section_id'))->pluck('fullname', 'id');
                    }),
                Forms\Components\DatePicker::make('deadline')
                    ->label('Муддат')
                    ->required(),
                Forms\Components\Select::make('status_id')
                    ->label('Ҳолати')
                    ->options(\App\Models\Status::pluck('name', 'id'))
                    ->required(),
                Forms\Components\Textarea::make('description')
                    ->label('Изоҳ')
                    ->maxLength(255),
                Forms\Components\FileUpload::make('file')
                    ->label('Файл')
                    ->rules('file', 'mimes:pdf,doc,docx,zip,rar')
                    ->columnSpanFull(),
                Forms\Components\DatePicker::make('completed_at')
                    ->label('Тугатилган сана'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('DocumentSection')
            ->columns([
                // Tables\Columns\TextColumn::make('DocumentSection'),
                Tables\Columns\TextColumn::make('section.name')
                    ->label('Бўлим'),
                Tables\Columns\TextColumn::make('employee.fullname')
                    ->label('Ишчи'),
                Tables\Columns\TextColumn::make('description')
                    ->label('Изоҳ'),
                Tables\Columns\TextColumn::make('deadline')
                    ->label('Муддат'),
                Tables\Columns\TextColumn::make('status.name')
                    ->label('Ҳолати'),
                Tables\Columns\TextColumn::make('file')
                    ->label('Файл'),
                Tables\Columns\TextColumn::make('completed_at')
                    ->label('Тугатилган сана'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
