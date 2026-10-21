<?php

class AnnalynsInfiltration
{
    public function canFastAttack($is_knight_awake)
    {
        return !$is_knight_awake;
    }

    public function canSpy(
        $is_knight_awake,
        $is_archer_awake,
        $is_prisoner_awake
    ) {
        $can_spy = false;
        if ($is_knight_awake || $is_archer_awake || $is_prisoner_awake ) {
            $can_spy = true;
        }
        return $can_spy;
    }

    public function canSignal(
        $is_archer_awake,
        $is_prisoner_awake
    ) {
        $can_signal = false;
        if ($is_prisoner_awake && !$is_archer_awake ) {
            $can_signal = true;
        }
        return $can_signal;
    }

    public function canLiberate(
        $is_knight_awake,
        $is_archer_awake,
        $is_prisoner_awake,
        $is_dog_present
    ) {
        $can_liberate = false;
        if ($is_dog_present) {
            if (!$is_archer_awake) {
                $can_liberate = true;
            }
        }else {
            if($is_prisoner_awake && !$is_knight_awake && !$is_archer_awake){
                $can_liberate = true;
            }
        }
        return $can_liberate;
    }
}
