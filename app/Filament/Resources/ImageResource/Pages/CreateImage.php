<?php

namespace App\Filament\Resources\ImageResource\Pages;

use App\Filament\Resources\ImageResource;
use App\Services\UrlShortener;
use Filament\Actions;
use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use GuzzleHttp\Client;
use Illuminate\Support\Str;


;

class CreateImage extends CreateRecord
{
    protected static string $resource = ImageResource::class;



    protected function mutateFormDataBeforeCreate(array $data): array
    {
//        dd($data);
//        $imageUrl = url('/images/' . $data['id']);
//        $urlShortener = new UrlShortener();
//        $shortUrl = $urlShortener->shortenUrl($imageUrl);
//
//        if ($shortUrl['status'] === 'error' ) {
//            Notification::make()
//                ->danger()
//                ->color('danger')
//                ->iconColor('danger')
//                ->warning()
//                ->title('Error')
//                ->body(Str::markdown('Ocurrió un error al guardar la imagen:  ') . $shortUrl['message'])
//                ->persistent()
//                ->actions([
//                    Action::make('regresar')
//                        ->button()
//                        ->url('', shouldOpenInNewTab: false)
//                        ->close(),
//                ])
//                ->send();
//
//            $this->halt();
//        } else {
//            $data['url'] = $imageUrl;
//            $data['shorturl'] = $shortUrl['shortUrl'];
//        }






        return $data;
    }

    protected function afterCreate(): void
    {
        $this->record->url= url('image/' . $this->record->id);

        $urlShortener = new UrlShortener();
        $shortUrl = $urlShortener->shortenUrl($this->record->url);

        if ($shortUrl['status'] === 'error' ) {
            Notification::make()
                ->danger()
                ->color('danger')
                ->iconColor('danger')
                ->warning()
                ->title('Error')
                ->body(Str::markdown('Ocurrió un error al guardar la imagen:  ') . $shortUrl['message'])
                ->persistent()
                ->actions([
                    Action::make('regresar')
                        ->button()
                        ->url('', shouldOpenInNewTab: false)
                        ->close(),
                ])
                ->send();

            $this->halt();
        } else {
            $this->record->shorturl = $shortUrl['shortUrl'];
        }


        $this->record->save();
    }





}
