<?php

 $this->callMethod('statusUpdated');
 $this->callMethod('logicAction');

 $ot=$this->object_title;

 $value=(float)$this->getProperty('value');
 $minValue=(float)$this->getProperty('minValue');
 $maxValue=(float)$this->getProperty('maxValue');
 $is_normal=(int)$this->getProperty('normalValue');

 @include_once(ROOT.'languages/devices_'.SETTINGS_SITE_LANGUAGE.'.php');
 @include_once(ROOT.'languages/devices_default'.'.php');

 if ($maxValue==0 && $minValue==0 && !$is_normal) {
  $this->setProperty('normalValue', 1);
 } elseif (($value>$maxValue || $value<$minValue) && $is_normal) {
  $this->setProperty('normalValue', 0);
  if ($this->getProperty('notify')) {
   //out of range notify
   say(LANG_DEVICES_NOTIFY_OUTOFRANGE. ' ('.$ot.': '.$value.')', 2);
  }
 } elseif (($value<=$maxValue && $value>=$minValue) && !$is_normal) {
  $this->setProperty('normalValue', 1);
  if ($this->getProperty('notify')) {
   //back to normal notify
   say(LANG_DEVICES_NOTIFY_BACKTONORMAL. ' ('.$ot.': '.$value.')', 2);
  }
 }

