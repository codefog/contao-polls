<?php

namespace Codefog\PollsBundle;

use Codefog\PollsBundle\Model\PollModel;
use Contao\Model\Collection;

class Poll
{
    private bool $active = false;
    private bool $protected = false;
    private bool $userVoted = false;

    public function __construct(
        private readonly PollModel $model,
        private readonly Collection $options,
    ) {
    }

    public function getModel(): PollModel
    {
        return $this->model;
    }

    public function getOptions(): Collection
    {
        return $this->options;
    }

    public function isActive(): bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    public function isProtected(): bool
    {
        return $this->protected;
    }

    public function setProtected(bool $protected): self
    {
        $this->protected = $protected;

        return $this;
    }

    public function hasUserVoted(): bool
    {
        return $this->userVoted;
    }

    public function setUserVoted(bool $userVoted): self
    {
        $this->userVoted = $userVoted;

        return $this;
    }

    public function canBeVoted(): bool
    {
        return $this->active && !$this->userVoted && !$this->protected;
    }
}
