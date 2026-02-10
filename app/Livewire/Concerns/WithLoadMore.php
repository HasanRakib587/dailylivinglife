<?php

namespace App\Livewire\Concerns;

trait WithLoadMore
{
    public int $perPage = 6;
    public int $page = 1;

    public function loadMore(): void
    {
        $this->page++;
    }

    protected function getLimit(): int
    {
        return $this->perPage * $this->page;
    }
}
