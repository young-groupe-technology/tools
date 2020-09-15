<?php
/**
 * Affichage d'une date en francais
 * @param str $date - date a manipuler
 * @param boolean $long_date:false - true => date format long
 * @param str $sep - Separateur
 * @return str formating date
 */
function display_date($date, $long_date=false, $sep='-')
{
    $timestamp        = strtotime($date);
    $day              = date('d', $timestamp);// Jour
    $day_o              = date('j', $timestamp);// Jour 
    $mounth           = date('m', $timestamp);// Mois
    $year             = date('Y', $timestamp);// Annee
    $number_of_day    = date('w',$timestamp);// Numero du jour de la semaine
                                          // 0=>Dimanche .... 6=>Samedi
    $number_of_mounth = date('n', $timestamp);  
    // Array correspondant aux jours de la semaine
    $days_arr = ['dimanche', 'lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi'];
    // Array correspondant aux mois de l annee
    $mounth_arr = ['', 'janvier', 'février', 'mars', 'avril', 'mai', 'juin', 
                   'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre']; 
    $str_day = $days_arr[$number_of_day];// Nom du jour (Ex: lundi)
    $str_mounth = $mounth_arr[$number_of_mounth];// Nom du mois (Ex: janvier)

    $short_day = $day.$sep.$mounth.$sep.$year;
    $long_day = ucfirst($str_day).', '.$day_o.' '.ucfirst($str_mounth).' '.$year;
    if ($long_date) {
        return $long_day;
    }
    return $short_day;
}

/**
 * Fonction qui retourne en lettres un nombre entré en paramètres de 0 à 999999999
 */
function asLetters($number,$separateur=",") {
    $convert = explode($separateur, $number);
    $num[17] = array('zero', 'un', 'deux', 'trois', 'quatre', 'cinq', 'six', 'sept', 'huit',
                     'neuf', 'dix', 'onze', 'douze', 'treize', 'quatorze', 'quinze', 'seize');
                      
    $num[100] = array(20 => 'vingt', 30 => 'trente', 40 => 'quarante', 50 => 'cinquante',
                      60 => 'soixante', 70 => 'soixante-dix', 80 => 'quatre-vingt', 90 => 'quatre-vingt-dix');
                                      
    if (isset($convert[1]) && $convert[1] != '') {
      return asLetters($convert[0]).' et '.asLetters($convert[1]);
    }
    if ($number < 0) return 'moins '.asLetters(-$number);
    if ($number < 17) {
      return $num[17][$number];
    }
    elseif ($number < 20) {
      return 'dix-'.asLetters($number-10);
    }
    elseif ($number < 100) {
      if ($number%10 == 0) {
        return $num[100][$number];
      }
      elseif (substr($number, -1) == 1) {
        if( ((int)($number/10)*10)<70 ){
          return asLetters((int)($number/10)*10).'-et-un';
        }
        elseif ($number == 71) {
          return 'soixante-et-onze';
        }
        elseif ($number == 81) {
          return 'quatre-vingt-un';
        }
        elseif ($number == 91) {
          return 'quatre-vingt-onze';
        }
      }
      elseif ($number < 70) {
        return asLetters($number-$number%10).'-'.asLetters($number%10);
      }
      elseif ($number < 80) {
        return asLetters(60).'-'.asLetters($number%20);
      }
      else {
        return asLetters(80).'-'.asLetters($number%20);
      }
    }
    elseif ($number == 100) {
      return 'cent';
    }
    elseif ($number < 200) {
      return asLetters(100).' '.asLetters($number%100);
    }
    elseif ($number < 1000) {
      return asLetters((int)($number/100)).' '.asLetters(100).($number%100 > 0 ? ' '.asLetters($number%100): '');
    }
    elseif ($number == 1000){
      return 'mille';
    }
    elseif ($number < 2000) {
      return asLetters(1000).' '.asLetters($number%1000).' ';
    }
    elseif ($number < 1000000) {
      return asLetters((int)($number/1000)).' '.asLetters(1000).($number%1000 > 0 ? ' '.asLetters($number%1000): '');
    }
    elseif ($number == 1000000) {
      return 'millions';
    }
    elseif ($number < 2000000) {
      return asLetters(1000000).' '.asLetters($number%1000000);
    }
    elseif ($number < 1000000000) {
      return asLetters((int)($number/1000000)).' '.asLetters(1000000).($number%1000000 > 0 ? ' '.asLetters($number%1000000): '');
    }
  }