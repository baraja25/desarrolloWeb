<?php

class HighSchoolSweetheart
{
    public function firstLetter(string $name): string
    {
        $trimmed = trim($name);
        
        return $trimmed[0];
    }

    public function initial(string $name): string
    {
        $firstLetter = $this -> firstLetter($name);
        $toUpper = strtoupper($firstLetter);
        return $toUpper.".";
        
    }

    public function initials(string $name): string
    {
        $splitWords = explode(" ", $name);
        foreach ($splitWords as $word) {
            $initials[] = $this -> initial($word);
        }
        
        return $initials = implode(" ", $initials);
    }

    public function pair(string $sweetheart_a, string $sweetheart_b): string
    {
        $initials_a = $this->initials($sweetheart_a);
        $initials_b = $this->initials($sweetheart_b);
        
        
        return "     ******       ******\n" .
               "   **      **   **      **\n" .
               " **         ** **         **\n" .
               "**            *            **\n" .
               "**                         **\n" .
               "**     $initials_a  +  $initials_b     **\n" .
               " **                       **\n" .
               "   **                   **\n" .
               "     **               **\n" .
               "       **           **\n" .
               "         **       **\n" .
               "           **   **\n" .
               "             ***\n" .
               "              *";
    }
}

$sweetheart = new HighSchoolSweetheart();
echo $sweetheart -> pair("John Doe", "Jane Doe");