<?php

namespace MustafaRefaey\LaravelHybrid;

class SharedState implements RetrievesSharedState
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
