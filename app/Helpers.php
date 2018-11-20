<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Helpers extends Model
{
    /*
    Parametry:

    Post użytkownika oraz ocena || Funkcja oblicza procent podanej oceny z wszystkich ocen tego postu.
    Zwraca wartosc procentowa
    */
    static function getPercentRate(Post $post, $rate){
        $allRates = Rate::where('elem_type', 'post')->where('elem_id', $post->id)->get();
        $percentRate = Rate::where('elem_type', 'post')->where('elem_id', $post->id)->where('rate', $rate)->get();
        return (count($percentRate)/count($allRates))*100;
    }

    /*
    Funkcja oblicza ile razy uzytkownicy ocenili dany post tą oceną
    */
    static function getPercentCount(Post $post, $rate){
        $percentRate = Rate::where('elem_type', 'post')->where('elem_id', $post->id)->where('rate', $rate)->get();
        return count($percentRate);
    }

    static function randomDate($start_date, $end_date)
    {
        // Convert to timetamps
        $min = strtotime($start_date);
        $max = strtotime($end_date);

        // Generate random number using above bounds
        $val = rand($min, $max);

        // Convert back to desired date format
        return date('Y-m-d H:i:s', $val);
    }
}
