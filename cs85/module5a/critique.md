AI Use Write-Up — recommendNextLevel() method

Prompt used

"Write a PHP method for a language-learning class with properties
wordsLearned, studyHoursTotal, and currentLevel that recommends the
next CEFR level (A1 through C2) to move toward, based on simple word/hour
thresholds."

Raw AI-generated code

phpfunction recommendNextLevel() {
  if ($this->currentLevel == "A1" && $this->wordsLearned > 100)
    return "Move to A2";
  if ($this->currentLevel == "A2" && $this->wordsLearned > 300)
    return "Move to B1";
  if ($this->currentLevel == "B1" && $this->wordsLearned > 600)
    return "Move to B2";
  return "Keep studying " . $this->currentLevel;
}

Critique

Correctness: Only checks word count, ignoring studyHoursTotal even though the prompt asked for both. Also stops at B1 — no case for B2, C1, or C2.

Security: Low risk here (no user input or data base calls), but if currentLevel ever came from a form, it would need validation before being compared or displayed.

Efficiency: Fine at this scale, but the repeated if chain doesn't scale — every new level means another hardcoded, copy-pasted block.


Style

Uses loose == instead of strict === for string comparison.
No return type declared on the method.
No docblock/comment explaining intent.
Level names ("A1", "A2", "B1"...) are magic strings repeated across
several conditions instead of living in one ordered list.


Changes I made

• Replaced the hardcoded if chain with an ordered $levels array and a
simple loop to find the student's position, so the same logic works
for every level (A1 through C2) without duplicating cases.
• Added an hour threshold alongside the word threshold, since the
original prompt asked for both and the raw version silently dropped
hours.
• Switched == to === for strict, safer string comparison.
• Added a fallback branch for an already-maxed-out or unrecognized level
instead of letting it fall through to a generic, possibly misleading
message.