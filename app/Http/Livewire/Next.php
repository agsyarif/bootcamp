<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\akses_course;
use App\Models\course;
use App\Models\CourseLesson;
use App\Models\CourseMaterial;
use App\Models\detailAksesCourse;
use App\Models\exam;
use Illuminate\Support\Facades\Auth;

class Next extends Component
{

    public $course_material_id;
    public $nextMateri;
    public $disabled;

    public $akses_course;
    public $detailAkses;
    public $chapter;

    public $tombol;
    public $exam;

    public function mount($chapter, $id, $aksesCourse)
    {
        // materi active
        $this->course_material_id = $id;

        // course materi terakhir => yang course lesson id nya 11 idnya 7
        $materiTerakhir = CourseMaterial::where('course_lesson_id', $chapter)->orderBy('id', 'desc')->limit(1)->pluck('id');

        // ambil exam dari chapter yang sedang dibuka
        $exam = exam::where('course_lesson_id', $chapter)->get();

        // jika exam ada maka isi this->exam
        if ($exam != 0) {
            $this->exam = $exam[0]->id;
        }
        $this->chapter;

        if ($exam != 0) {
            foreach ($exam as $key => $value) {
                if ($value->course_lesson_id == $chapter) {
                    if ($id == $materiTerakhir[0]) {
                        if (request()->segment(3) == 'result') {
                            $this->tombol = 'next';
                        } else {
                            $this->tombol = 'uji';
                        }
                    } else {
                        $this->tombol = 'next';
                    }
                } else {
                    if ($id == $materiTerakhir[0]) {
                        $this->tombol = 'selesai';
                    } else {
                        $this->tombol = 'next';
                    }
                }
            }
        } else {
            if ($id == $materiTerakhir[0]) {
                $this->tombol = 'selesai';
            } else {
                $this->tombol = 'next';
            }
        }



        // check jika chapter ini memiliki soal maka taruh link untuk menuju ke soal tersebut. jika tidak maka link berubah menjadi link selesai atau comment.
        // tetapi jika tidak ada soal dan tidak pada chaper terakhir maka tombol tetap next.

        // if ($id == $materiTerakhir[0]) {
        //     $this->tombol = 'uji';
        // } else {
        //     $this->tombol = 'next';
        // }
        $this->chapter = $chapter;
        $this->akses_course = $aksesCourse;
        $detail_akses = detailAksesCourse::where('akses_course_id', $aksesCourse)->where('course_material_id', $this->course_material_id)->get()->pluck('course_material_id');
        if (count($detail_akses) > 0) {
            $this->detailAkses = $detail_akses;
        } else {
            $this->detailAkses = [0];
        }
    }

    // next materi
    public function nextMateri()
    {
        if ($this->detailAkses[0] != $this->course_material_id) {
            $checklist = new detailAksesCourse;
            $checklist->akses_course_id = $this->akses_course;
            $checklist->course_material_id = $this->course_material_id;
            $checklist->save();
        }

        $nextMateri = CourseMaterial::where('id', '>', $this->course_material_id)->first();

        // cek chapter, jika materi pada chhpater ini sudah materi terakhir maka tombol next berubah menjadi tes / soal.

        // current_materi $this->course_material_id
        // current_chapter $this->chapter
        // jumplah materi pada chapter sekarang / jika materi id == id materi terakhir poada current chapter

        // if($this->course_material_id == )




        if ($nextMateri) {
            return redirect()->route('member.course.materi', [$nextMateri->id]);
            $this->disabled = false;
        } else {
            $this->disabled = true;
        }
    }

    public function selesai()
    {
        // if ($this->detailAkses[0] != $this->course_material_id) {
        //     $checklist = new detailAksesCourse;
        //     $checklist->akses_course_id = $this->akses_course[0]->id;
        //     $checklist->course_material_id = $this->course_material_id;
        //     $checklist->save();
        // }

        return redirect()->route('member.dashboard.index');
    }

    public function kuis()
    {
        if ($this->detailAkses[0] != $this->course_material_id) {
            $checklist = new detailAksesCourse;
            $checklist->akses_course_id = $this->akses_course;
            $checklist->course_material_id = $this->course_material_id;
            $checklist->save();
        }

        return redirect()->route('member.course.quiz', [$this->chapter]);
        // return redirect()->route('')
    }

    public function render()
    {
        return view('livewire.next');
    }
}
