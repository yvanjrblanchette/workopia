<?php

// Function to change the font size based on the length of the string
if (!function_exists('dynamicFontSize')) {
  function dynamicFontSize(string $str): string
  {
    return strlen($str) <= 10 ? 'text-2xl' : (strlen($str) <= 15 ? 'text-xl' : (strlen($str) <= 20 ? 'text-lg' : 'text-lg'));
  }
};
