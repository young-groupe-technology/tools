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
