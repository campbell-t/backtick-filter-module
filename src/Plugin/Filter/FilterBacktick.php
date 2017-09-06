<?php

/**
 * @file
 * Contains Drupal\lilengine_backtick_filter\Plugin\Filter.
 */

namespace Drupal\lilengine_backtick_filter\Plugin\Filter;
use Drupal\filter\FilterProcessResult;
use Drupal\filter\Plugin\FilterBase;

/**
 * Provides a filter to replace ` with code wrappers.
 *
 * @Filter(
 *  id = "filter_backtick",
 *  module = "lilengine_backtick_filter",
 *  title = @Translation("Lil Engine Backtick Filter"),
 *  type = Drupal\filter\Plugin\FilterInterface::TYPE_TRANSFORM_REVERSIBLE,
 *  cache = FALSE,
 *  weight = 0
 * )
 */
class FilterBacktick extends FilterBase {

  /**
   * {@inheritdoc}
   */
  public function process($text, $langcode) {
    $new_text = $text;
    $matches = [];
    preg_match_all ("|`([^`]*)`|" , $text , $matches);
    foreach ($matches[0] as $key => $matched) {
      $new_text = str_replace($matched, '<code>' . $matches[1][$key] . '</code>', $new_text, $count = 1);

    }
    return new FilterProcessResult($new_text);
  }
}
