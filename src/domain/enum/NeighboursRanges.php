<?php

namespace GameofLife\domain\enum;

final class NeighboursRanges
{
    const RANGES = [[-1, -1], [-1, 0], [-1, 1], [0, -1], [0, 1], [1, -1], [1, 0], [1, 1]];
}