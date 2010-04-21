<?php

class spJsonloadPluginConfiguration extends sfPluginConfiguration
{
  public function initialize()
  {
    $this->dispatcher->connect('response.filter_content', array($this, 'listenResponseFilterContent'));
  }

  public function listenResponseFilterContent($event, $value)
  {
    $jsCode = sfConfig::get('javascript.events.onload', '');

    if (strlen($jsCode) > 0)
    {
      $jqueryEnabled = sfConfig::get('app_spJsonloadPlugin_use_jquery', false);
      $onloadCode[] = '<script type="text/javascript" charset="utf-8">';
      $onloadCode[] = '//<![CDATA[';
      if ($jqueryEnabled)
        $onloadCode[] = '$(document).ready(function()';
      else
        $onloadCode[] = 'window.onload = function()';
      $onloadCode[] = '{';
      $onloadCode[] = $jsCode;
      if ($jqueryEnabled)
        $onloadCode[] = '});';
      else
        $onloadCode[] = '};';
      $onloadCode[] = '//]]>';
      $onloadCode[] = '</script>';

      $onloadCodeStr = join("\r\n", $onloadCode) . "\r\n";

      $value = str_ireplace('</head>', $onloadCodeStr .'</head>', $value);
    }

    return $value;
  }
}
