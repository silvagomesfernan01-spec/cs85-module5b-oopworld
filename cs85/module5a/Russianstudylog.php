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
     * 1. SUMMARY DISPLAY METHOD
     *
     * PREDICTION: For Nanda (180 words, 42.5 hrs, A2, 15-day streak)
     * I expect something like:
     * "=== Nanda's Russian Study Log ===
     *  Level: A2 | Words learned: 180 | Hours studied: 42.5
     *  Current streak: 15 day(s)"
     */
    