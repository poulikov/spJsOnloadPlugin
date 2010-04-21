<?php

function add_js_onload($jsStr, $position = 'last')
{
  static $countRun = 0;

  $delimiter = '//' . str_repeat('*', 40);

  $context = sfContext::getInstance();
  $cacheManager = $context->getViewCacheManager();
  $cacher = null;

  if ($cacheManager)
  {
    $cacher = $cacheManager->getCache();
    $cacheKey = sprintf
    (
      'javascript.events.onload.%s.%s', 
      $context->getModuleName(), 
      $context->getActionName() 
    );
    if ($countRun > 0)
    {
      $oldStr = $cacher->get($cacheKey);
    }
    else
    {
      $oldStr = '';
    }
  }
  else
  {
    $oldStr = sfConfig::get('javascript.events.onload', '');
  }

  if ('last' == $position)
  {
    $newStr = $oldStr . "\r\n" . $delimiter . "\r\n" . $jsStr;
  }
  else if ('first' == $position)
  {
    $newStr = $jsStr . "\r\n" . $delimiter . "\r\n" . $oldStr;
  }

  if ($cacheManager)
  {
    $cacher->set($cacheKey, $newStr);
  }
  else
  {
    sfConfig::set('javascript.events.onload', $newStr);
  }
  $countRun++;
}

function start_js_onload($position = 'last')
{
  js_onload_position($position);
  ob_start();
  ob_implicit_flush(0);
}

function end_js_onload()
{
  $content = ob_get_clean();

  add_js_onload($content, js_onload_position());
}

function js_onload_position($pos = null)
{
  static $position = 'last';
  if (null !== $pos)
  {
    $position = $pos;
  }

  return $position;
}
