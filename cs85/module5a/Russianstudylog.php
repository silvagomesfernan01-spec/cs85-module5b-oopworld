<?php
/**
 * Assignment 5A: Design a class based on your life
 * Topic: Russian language study log
 *
 * I picked this topic because I've taken Russian class at SMC.
 * This class models a daily study log: how many words I've learned,
 * how many hours I've put in, my current level,
 * and whether I'm hitting my own goals.
 */

 class RussianStudyLog
 {
    // ---- Properties ----
    public $studentName;
    public $wordsLearned;
    public $studyHoursTotal;
    public $currentLevel;   // A1, A2, B1, B2, C1, C2
    public $dayStreak;
    public $weeklyWordGoal;
    
     /**
     * Constructor — initializes a study log with real starting data.
     */
    public function __construct($studentName, $wordsLearned, $studyHoursTotal, $currentLevel, $dayStreak, $weeklyWordGoal)
    {
        $this->studentName     = $studentName;
        $this->wordsLearned    = $wordsLearned;
        $this->studyHoursTotal = $studyHoursTotal;
        $this->currentLevel    = $currentLevel;
        $this->dayStreak       = $dayStreak;
        $this->weeklyWordGoal  = $weeklyWordGoal;
    }

   /**
     * SUMMARY DISPLAY METHOD
     *
     * PREDICTION: For Nanda (180 words, 42.5 hrs, A2, 15-day streak)
     * I expect something like:
     * "=== Nanda's Russian Study Log ===
     *  Level: A2 | Words learned: 180 | Hours studied: 42.5
     *  Current streak: 15 day(s)"
     */
    public function displaySummary()
    {
        return "=== {$this->studentName}'s Russian Study Log ===\n"
             . "Level: {$this->currentLevel} | Words learned: {$this->wordsLearned} | "
             . "Hours studied: {$this->studyHoursTotal}\n"
             . "Current streak: {$this->dayStreak} day(s)";
    }

     /**
     * METHOD RETURNING A CALCULATED VALUE
     * Calculates average new words learned per study hour.
     *
     * PREDICTION: 180 words / 42.5 hours = ~4.24 words/hour for Nanda.
     */
    public function wordsPerHour()
    {
        if ($this->studyHoursTotal <= 0) {
            return 0;
        }
        return round($this->wordsLearned / $this->studyHoursTotal, 2);
    }

    /**
     * METHOD TO CHANGE A PROPERTY VALUE
     * Logs a new study session: adds hours and new words, and bumps
     * the streak by one day.
     *
     * PREDICTION: Calling logSession(1.5, 12) on Nanda should push
     * wordsLearned to 192, studyHoursTotal to 44.0, and dayStreak to 16.
     */
    public function logSession($hours, $newWords)
    {
        $this->studyHoursTotal = $this->studyHoursTotal + $hours;
        $this->wordsLearned    = $this->wordsLearned + $newWords;
        $this->dayStreak       = $this->dayStreak + 1;
    }

     /**
     * METHOD WITH DECISION LOGIC
     * Checks whether this week's word goal has been met, based on
     * words learned so far vs. the weekly goal.
     *
     * PREDICTION: With wordsLearned=180 and weeklyWordGoal=40, this
     * is well past the goal, so I expect "Goal crushed! 180/40 words."
     * A newer student with fewer words than their goal should instead
     * get an "on track" or "behind" message.
     */
    public function checkGoalStatus()
    {
        if ($this->wordsLearned >= $this->weeklyWordGoal * 2) {
            return "Goal crushed! {$this->wordsLearned}/{$this->weeklyWordGoal} words.";
        } elseif ($this->wordsLearned >= $this->weeklyWordGoal) {
            return "Goal met: {$this->wordsLearned}/{$this->weeklyWordGoal} words.";
        } elseif ($this->wordsLearned >= $this->weeklyWordGoal * 0.5) {
            return "On track: {$this->wordsLearned}/{$this->weeklyWordGoal} words so far.";
        } else {
            return "Behind pace: only {$this->wordsLearned}/{$this->weeklyWordGoal} words.";
        }
    }

     /**
     * AI-GENERATED METHOD (see critique.md for prompt + critique)
     * Recommends the next CEFR level to move toward, based on words
     * learned and hours studied. This is MY cleaned-up version after
     * critiquing the raw AI output.
     *
     * PREDICTION: Nanda (180 words, 42.5 hrs, currently A2) should be
     * told she's ready to start B1, since she clears both thresholds.
     */
    public function recommendNextLevel()
    {
        $levels = array("A1", "A2", "B1", "B2", "C1", "C2");
 
        // Find where the current level sits in the list
        $currentIndex = -1;
        for ($i = 0; $i < count($levels); $i++) {
            if ($levels[$i] === $this->currentLevel) {
                $currentIndex = $i;
                break;
            }
        }
 
        if ($currentIndex === -1 || $currentIndex === count($levels) - 1) {
            return "You're already at the top tracked level ({$this->currentLevel}) — keep it up!";
        }
 
        $wordThreshold = ($currentIndex + 1) * 80;
        $hourThreshold = ($currentIndex + 1) * 20;
 
        if ($this->wordsLearned >= $wordThreshold && $this->studyHoursTotal >= $hourThreshold) {
            $next = $levels[$currentIndex + 1];
            return "Ready to start {$next}! You've cleared the {$this->currentLevel} benchmarks "
                 . "({$wordThreshold}+ words, {$hourThreshold}+ hours).";
        }
 
        return "Keep building {$this->currentLevel}: aiming for {$wordThreshold} words "
             . "and {$hourThreshold} hours before moving on.";
    }
}

// ---------------------------------------------------------------
// Creating and using objects
// ---------------------------------------------------------------
 
// Object 1: my own real(ish) data
$nanda = new RussianStudyLog("Nanda", 180, 42.5, "A2", 15, 40);
 
// Object 2: a classmate who's just starting out, for contrast
$alex = new RussianStudyLog("Alex", 25, 8.0, "A1", 4, 20);
 
echo $nanda->displaySummary() . "\n\n";
echo "Words per hour (Nanda): " . $nanda->wordsPerHour() . "\n";
echo $nanda->checkGoalStatus() . "\n";
echo $nanda->recommendNextLevel() . "\n";
 
echo "\n--- Logging a new study session for Nanda (1.5 hrs, 12 words) ---\n";
$nanda->logSession(1.5, 12);
echo $nanda->displaySummary() . "\n\n";
 
echo $alex->displaySummary() . "\n\n";
echo "Words per hour (Alex): " . $alex->wordsPerHour() . "\n";
echo $alex->checkGoalStatus() . "\n";
echo $alex->recommendNextLevel() . "\n";