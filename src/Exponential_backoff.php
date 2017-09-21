<?php
namespace exponential_backoff_retries;

class Exponential_backoff {
	
   /**
     * This function will return maxExpoBackoffInMircroSecs everytime if computed $wait exceeds it
     * @param int maxExpoBackoffInMircroSecs
     * @param int attempt This is current retry count
     * @param int maxAttempts This is max number of retries allowed
     *   
     * @return int wait This is time to sleep 
     */
	public static function($attempt, $maxAttempts, $maxExpoBackoffInMircroSecs) {

		if(!is_int($attempt) || !is_int($maxAttempts) || !is_int($maxExpoBackoffInMircroSecs)) {
            return false;
        }
        if ($maxAttempts >= 1 && $attempt > $maxAttempts) {
             return -1;
        }

        $wait = (1 << ($attempt - 1)) * 1000;
        return ($maxExpoBackoffInMircroSecs < $wait) ? $maxExpoBackoffInMircroSecs : $wait;	
	}
}