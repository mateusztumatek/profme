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
}
