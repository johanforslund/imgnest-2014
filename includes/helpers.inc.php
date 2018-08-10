<?php
function html($text)
{
	return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
}

function htmlout($text)
{
	echo html($text);
}

function markdown2html($text)
{
  $text = html($text);

  // strong emphasis
  $text = preg_replace('/__(.+?)__/s', '<strong>$1</strong>', $text);
  $text = preg_replace('/\*\*(.+?)\*\*/s', '<strong>$1</strong>', $text);

  // emphasis
  $text = preg_replace('/_([^_]+)_/', '<em>$1</em>', $text);
  $text = preg_replace('/\*([^\*]+)\*/', '<em>$1</em>', $text);

  // Convert Windows (\r\n) to Unix (\n)
  $text = str_replace("\r\n", "\n", $text);
  // Convert Macintosh (\r) to Unix (\n)
  $text = str_replace("\r", "\n", $text);

  // Paragraphs
  $text = '<p>' . str_replace('\n\n', '</p><p>', $text) . '</p>';
  // Line breaks
  $text = str_replace('\n', '<br>', $text);
  
  // Paragraphs
  $text = '<p>' . str_replace("\n\n", '</p><p>', $text) . '</p>';
  // Line breaks
  $text = str_replace("\n", '<br>', $text);

  // [linked text](link URL)
  $text = preg_replace(
      '/\[([^\]]+)]\(([-a-z0-9._~:\/?#@!$&\'()*+,;=%]+)\)/i',
      '<a href="$2">$1</a>', $text);

  return $text;
}

function markdownout($text)
{
  echo markdown2html($text);
}

function markdown2blank($text)
{
  $text = html($text);

  // strong emphasis
  $text = preg_replace('/__(.+?)__/s', '$1', $text);
  $text = preg_replace('/\*\*(.+?)\*\*/s', '$1', $text);

  // emphasis
  $text = preg_replace('/_([^_]+)_/', '$1', $text);
  $text = preg_replace('/\*([^\*]+)\*/', '$1', $text);

  // Convert Windows (\r\n) to Unix (\n)
  $text = str_replace("\r\n", "\n", $text);
  // Convert Macintosh (\r) to Unix (\n)
  $text = str_replace("\r", "\n", $text);

  // Paragraphs
  $text = str_replace('\n\n', '', $text);
  // Line breaks
  $text = str_replace('\n', '', $text);

  // [linked text](link URL)
  $text = preg_replace(
      '/\[([^\]]+)]\(([-a-z0-9._~:\/?#@!$&\'()*+,;=%]+)\)/i',
      '$1', $text);

  return $text;
}

function markdownblankout($text)
{
  echo markdown2blank($text);
}

function markdownmessage2html($text)
{
  $text = html($text);

  // strong emphasis
  $text = preg_replace('/__(.+?)__/s', '<strong>$1</strong>', $text);
  $text = preg_replace('/\*\*(.+?)\*\*/s', '<strong>$1</strong>', $text);

  // emphasis
  $text = preg_replace('/_([^_]+)_/', '<em>$1</em>', $text);
  $text = preg_replace('/\*([^\*]+)\*/', '<em>$1</em>', $text);

  // Convert Windows (\r\n) to Unix (\n)
  $text = str_replace("\r\n", "\n", $text);
  // Convert Macintosh (\r) to Unix (\n)
  $text = str_replace("\r", "\n", $text);
  
  // Paragraphs
  $text = '<p>' . str_replace("\n\n", '</p><br/><p>', $text) . '</p>';
  // Line breaks
  $text = str_replace("\n", '<br>', $text);

  // [linked text](link URL)
  $text = preg_replace(
      '/\[([^\]]+)]\(([-a-z0-9._~:\/?#@!$&\'()*+,;=%]+)\)/i',
      '<a href="$2">$1</a>', $text);

  return $text;
}

function markdownmessageout($text)
{
  echo markdownmessage2html($text);
}

function ago($time)
{
   $periods = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
   $lengths = array("60","60","24","7","4.35","12","10");

   $now = time();

       $difference     = $now - $time;
       $tense         = "ago";

   for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
       $difference /= $lengths[$j];
   }

   $difference = round($difference);

   if($difference != 1) {
       $periods[$j].= "s";
   }

   return "$difference $periods[$j] ago ";
}