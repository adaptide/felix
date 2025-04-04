<?php

namespace App\Filament\Resources;

use App\Enums\Order\Delivery;
use App\Enums\Order\Status;
use App\Filament\Resources\OrderResource\Pages;
use App\Models\Order;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Form;
use Filament\Infolists\Components as InfolistComponents;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Support\Enums\FontWeight;
use Filament\Support\Enums\VerticalAlignment;
use Filament\Tables;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->with(['items:id', 'user:id']);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->alignCenter()
                    ->sortable()
                    ->label('Number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('shipping_name')
                    ->sortable()
                    ->alignCenter()
                    ->label('Client')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->alignCenter()
                    ->label('status')
                    ->badge(),
                Tables\Columns\TextColumn::make('payment_method')
                    ->sortable()
                    ->alignCenter()
                    ->label('Payment Method')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->alignCenter()
                    ->dateTime()
                    ->label('Time ordered')
                    ->sortable()
                    ->searchable()
            ])
            ->poll('10s')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('status')
                    ->default('pending'),
                Tables\Filters\SelectFilter::make('payment_method')
                    ->label('Payment Method')
                    ->options([
                        'cash' => 'Cash',
                        'credit_card' => 'Credit Card',
                        'paypal' => 'PayPal',
                    ])
                    ->default('cash'),
                Filter::make('created_at')
                    ->form([
                        Forms\Components\Split::make([
                            Forms\Components\DatePicker::make('ordered_from')->label('from'),
                            Forms\Components\DatePicker::make('ordered_until')->label('to'),
                        ])
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['ordered_from'],
                                fn(Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['ordered_until'],
                                fn(Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    })
            ])
            ->persistFiltersInSession()
            ->recordAction(Tables\Actions\ViewAction::class)
            ->recordUrl(null)
            ->defaultSort('created_at', 'desc')
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\Action::make('Confirm')
                        ->color('success')
                        ->label('Confirm')
                        ->hidden(fn(Order $order) => $order->status != 'pending')
                        ->icon('heroicon-o-check')
                        ->action(fn(Order $order) => $order->update(['status' => 'confirmed', 'updated_at' => now()])),
                    Tables\Actions\Action::make('decline')
                        ->color('danger')
                        ->label('Decline')
                        ->hidden(fn(Order $order) => $order->status != 'pending')
                        ->icon('heroicon-o-x-mark')
                        ->action(fn(Order $order) => $order->update(['status' => 'declined', 'updated_at' => now()])),
                ])
            ])
            ->bulkActions([]);
    }

    public
    static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                InfolistComponents\TextEntry::make('id')
                    ->size('xxl')
                    ->weight(FontWeight::Bold)
                    ->alignStart()
                    ->hiddenLabel()
                    ->prefix('№'),
                InfolistComponents\Section::make('Client Information')->schema([
                    InfolistComponents\Split::make([
                        InfolistComponents\TextEntry::make('shipping_name')
                            ->icon('heroicon-s-user')
                            ->label('Client'),
                        InfolistComponents\TextEntry::make('shipping_email')
                            ->icon('heroicon-m-phone')
                            ->label('Email'),
                    ]),
                    InfolistComponents\Split::make([
                        InfolistComponents\TextEntry::make('payment_method')
                            ->hidden(fn(Order $order) => $order->payment_method == null)
                            ->label('Type Payment'),
                    ]),

                    InfolistComponents\TextEntry::make('status')
                        ->badge()
                        ->label('Status')
                        ->suffixActions([
                            InfolistComponents\Actions\Action::make('confirm')
                                ->color('success')
                                ->label('Confirm')
                                ->iconSize('lg')
                                ->hidden(fn(Order $order) => $order->status != 'pending' && $order->status != 'declined')
                                ->icon('heroicon-o-check')
                                ->action(fn(Order $order) => $order->update(['status' => 'confirmed', 'updated_at' => now()])),
                            InfolistComponents\Actions\Action::make('complete')
                                ->color('success')
                                ->label('complete')
                                ->iconSize('lg')
                                ->hidden(fn(Order $order) => $order->status != 'delivered')
                                ->icon('heroicon-o-check-badge')
                                ->action(fn(Order $order) => $order->update(['status' => 'completed', 'updated_at' => now()])),
                            InfolistComponents\Actions\Action::make('Decline')
                                ->color('danger')
                                ->label('Decline')
                                ->iconSize('lg')
                                ->hidden(fn(Order $order) => $order->status != 'pending' && $order->status != 'confirmed')
                                ->icon('heroicon-o-x-circle')
                                ->action(fn(Order $order) => $order->update(['status' => 'declined', 'updated_at' => now()])),
                        ]),
                ]),
                InfolistComponents\Section::make([
                    InfolistComponents\TextEntry::make('total_amount')
                        ->hiddenLabel()
                        ->maxWidth('lg')
                        ->weight(FontWeight::Bold)
                        ->prefix('Total: ')
                        ->label('Total Price'),
                ]),
                InfolistComponents\Actions::make([
                    InfolistComponents\Actions\Action::make('Confirm')
                        ->label('Confirm')
                        ->color('success')
                        ->hidden(fn(Order $order) => $order->status != 'pending')
                        ->action(fn(Order $order) => $order->update(['status' => 'confirmed', 'updated_at' => now()])),
                    InfolistComponents\Actions\Action::make('Decline')
                        ->label('Decline')
                        ->color('danger')
                        ->hidden(fn(Order $order) => $order->status != 'pending')
                        ->action(fn(Order $order) => $order->update(['status' => 'declined', 'updated_at' => now()])),
                ])->verticalAlignment(VerticalAlignment::End),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function canCreate(): bool
    {
        return false; // TODO: Change the autogenerated stub
    }

    public
    static function getNavigationBadge(): ?string
    {
        return Cache::remember('orders_ordered_count', 300, function () {
            return self::getModel()::where('status', 'pending')->count();
        });
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
