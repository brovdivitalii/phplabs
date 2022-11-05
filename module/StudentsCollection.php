<?php

class StudentsCollection
{
    public $students;

    public function __construct()
    {
    }
    public function defaultStud(){
        $this->students = [
            new Student(1,[
                'name' => 'Петров І. В.',
                'course' => 2,
                'specialization' => 'Кібернетика'
            ]),
            new Student(2,[
                'name' => 'Петров І. В.',
                'course' => 3,
                'specialization' => 'Кібернетика'
            ]),
            new Student(3,[
                'name' => 'Петров І. В.',
                'course' => 1,
                'specialization' => 'Кібернетика'
            ]),
            new Student(4,[
                'name' => 'Петров І. В.',
                'course' => 2,
                'specialization' => 'Кібернетика'
            ]),
        ];
        return $this;
    }
    public function getBySpecialization($specialization)
    {
        foreach ($this->students as $students) {
            if ($students->specialization == $specialization) {
                return $students;
            }
        }
        return null;
    }

    public function filter($array)
    {
        $array = $this-> getBySpecialization(specialization);
        $table = '<table border="1px">';
        $table .= '<tr> <th>ID</th> <th>П.І.Б.</th> <th>Курс</th> <th>Спеціальність</th> </tr>';

        foreach ($array as $item) {
            $table .= "<tr><td>$item->id</td><td>$item->name</td><td>$item->course</td>" .
                "<td>$item->specialization</td></tr>";
        }

        $table .= '</table>';
        return $table;
    }
}