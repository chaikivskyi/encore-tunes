<?php

namespace App\Spotify\DTO;

class PaginationData extends AbstractDto
{
    public string $href;
    public int $limit;
    public int $offset;
    public int $total;
    public ?string $next;
    public ?string $previous;
}
