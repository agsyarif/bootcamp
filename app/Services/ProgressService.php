<?php

namespace App\Services;


class ProgressService
{
    private $aksesCourse;

    public function __construct($aksesCourse)
    {
        $this->aksesCourse = $aksesCourse;
    }

    private function countAksesCourses($detailAksesCourse)
    {
        $countAksesMaterial = count($detailAksesCourse);
        return $countAksesMaterial;
    }

    public function progress()
    {
        foreach ($this->aksesCourse as $aksesCourse) {

            $aksesMaterial = $this->countAksesCourses($aksesCourse->detail_akses_course);
            $totalMaterial = $aksesCourse->course->getAllMaterial();
            $persentase = $aksesMaterial / $totalMaterial * 100;

            $progress[] = [$aksesCourse->id => [
                'progress' => number_format($persentase, 0, '.', ''),
                'aksesMaterial' => $aksesMaterial,
                'totalMaterial' => $totalMaterial,
                'sumScore' => $this->sumExamScore($aksesCourse),
                'examScore' => $this->examScore($aksesCourse)
            ]];
        }
        return $progress;
    }

    public function sumExamScore($aksesCourse)
    {
        $sumScore = $aksesCourse->getSumScore();
        return $sumScore;
    }

    public function examScore($aksesCourse)
    {
        $examScore = $aksesCourse->score;
        return $examScore;
    }
}
