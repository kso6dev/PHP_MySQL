<?php

interface iMovable
{
    const DEFAULT_SPEED = 1;

    public function move($dest);
}