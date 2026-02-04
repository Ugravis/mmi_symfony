<?php

namespace App\Service;

use App\Repository\EditorRepository;

  class EditorService
  {
    public function __construct(private EditorRepository $editorRepository) {}

    public function countEditor(): int
    {
        return $this->editorRepository->count([]);
    }
  }