<?php

namespace MustafaRefaey\LaravelHybridSpa;

class SharedStateHandler implements RetrievesSharedState
{
    public function getSharedState(): array
    {
        return [
            'base_url' => url(''),
            'base_locale' => app()->getLocale(),
            'authenticated' => auth()->check(),
            'auth_user' => auth()->user(),
        ];
    }
}
