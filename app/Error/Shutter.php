<?php

namespace App\Error;

class Shutter {
  
  public function shutdown()
  {
    if ($this->hasTimeoutOccurred()) {
      return response('The operation took too long. Please try again.', 422);
    }
  }
  
  private function hasTimeoutOccurred(): bool
  {
    $lastError = error_get_last();
    
    if (!$lastError) {
      return false;
    }
    
    if (str_contains($lastError['message'], 'Maximum execution time')){
      return true;
    }
    
    return false;
  }
}

?>