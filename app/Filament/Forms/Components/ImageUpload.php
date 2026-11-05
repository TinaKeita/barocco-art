<?php

namespace App\Filament\Forms\Components;

use Filament\Forms\Components\FileUpload;

// FileUpload with a simpler image editor: only zoom and rotate buttons
class ImageUpload extends FileUpload
{
    public function getImageEditorActions(): array
    {
        $keep = ['editor.zoom(0.1)', 'editor.zoom(-0.1)', 'editor.rotate(-90)', 'editor.rotate(90)'];

        $actions = collect(parent::getImageEditorActions())
            ->flatten(1)
            ->filter(fn (array $action) => in_array($action['alpineClickHandler'], $keep))
            ->values()
            ->all();

        return [$actions];
    }
}
