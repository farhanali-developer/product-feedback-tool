<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FeedbacksResource\Pages;
use App\Filament\Resources\FeedbacksResource\RelationManagers;
use App\Models\Feedbacks;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FeedbacksResource extends Resource
{
    protected static ?string $model = Feedbacks::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected function resolve($record)
    {
        $value = parent::resolve($record);

        // Capitalize first characters and replace hyphens with spaces
        return ucwords(str_replace('-', ' ', $value));
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('user.name')
                    ->maxLength(255)
                    ->required(),
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
                    ->required()
                    ->maxLength(65535)
                    ->columnSpanFull(),
                Forms\Components\Select::make('category')
                    ->options([
                        'bug' => 'Bug',
                        'feature-request' => 'Feature Request',
                        'Improvement' => 'Improvement',
                    ])
                    ->default('category')
                    ->required(),
                    // ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    // ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('title')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('category')
                    ->formatStateUsing(fn (string $state): string => __(ucwords(str_replace('-', ' ', $state))))
                    ->sortable()
                    ->searchable(),
                Tables\Columns\ToggleColumn::make('visibility')
                    ->onColor('success')
                    ->offColor('danger'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label("Published At")
                    // ->dateTime()
                    ->since()
                    ->sortable()
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }
    
    public static function getRelations(): array
    {
        return [
            //
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFeedbacks::route('/'),
            'create' => Pages\CreateFeedbacks::route('/create'),
            'edit' => Pages\EditFeedbacks::route('/{record}/edit'),
        ];
    }    
}
