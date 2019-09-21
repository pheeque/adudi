<?php

namespace App\Helpers;

use App\Mascot;

class MascotLife
{
    public function levelUp(Mascot $mascot): Mascot
    {
        if ($mascot->exp >= 25 && $mascot->level === 1) {
            $mascot->update(['level' => 2]);
        }
        if ($mascot->exp >= 30 && $mascot->level === 2) {
            $mascot->update(['level' => 3]);
        }
        if ($mascot->exp >= 35 && $mascot->level === 3) {
            $mascot->update(['level' => 4]);
        }
        if ($mascot->exp >= 40 && $mascot->level === 4) {
            $mascot->update(['level' => 5]);
        }
        if ($mascot->exp >= 45 && $mascot->level === 5) {
            $mascot->update(['level' => 6]);
        }
        return $mascot;
    }

    public function levelDown(Mascot $mascot): Mascot
    {
        if ($mascot->exp < 25 && $mascot->level > 1) {
            $mascot->update(['level' => 1]);
        }
        if ($mascot->exp < 30 && $mascot->level > 2) {
            $mascot->update(['level' => 2]);
        }
        if ($mascot->exp < 35 && $mascot->level > 3) {
            $mascot->update(['level' => 3]);
        }
        if ($mascot->exp < 40 && $mascot->level > 4) {
            $mascot->update(['level' => 4]);
        }
        if ($mascot->exp < 45 && $mascot->level > 5) {
            $mascot->update(['level' => 5]);
        }
        return $mascot;
    }
}