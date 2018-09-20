<?php

namespace Drupal\events\Services;

use Drupal\Core\Language\LanguageManager;
use Drupal\search\SearchPluginManager;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class NodesListServices.
 */
class WeekendDay
{
//    const ENGWEEK = ['Friday', 'Saturday'];
//    const OTHERWEEK = ['Saturday', 'Sunday'];

    public function isDayOff(){
        $config = \Drupal::config('events.settings');
        $engweek = $config->get('ENGWEEK');
        $otherweek = $config->get('OTHERWEEK');
        $today = date('l');;
        $language =  \Drupal::languageManager()->getCurrentLanguage()->getName();
        if ($language == 'English'){
            if (in_array($today, $engweek)){
                $message = "Today is Weekend";
            } else {
                $message = "Today is Working day";
            }
        } else {
            if(in_array($today, $otherweek)){
                $message = t("Today is Weekend");
            } else {
                $message = t("Today is Working day");
            }
        }
        // Validate correct data format
       $timestamp = strtotime($today);
        if (!$timestamp) {
            $message = 'Not correct date fomat';
            return $message = \Drupal::logger('my_module')->error($message);
        } else {
        return $message;
        }
    }
}

