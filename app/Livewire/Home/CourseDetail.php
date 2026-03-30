<?php

namespace App\Livewire\Home;

use App\Models\Course;
use App\Models\CourseFaq;
use App\Models\CourseLecturer;
use App\Models\CourseStructure;
use App\Models\LecturerPerson;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class CourseDetail extends Component
{
    public $course_id;
    public $slug;
    public $detail = 'asdasdasdsadasds';

    public $course;
    public $description, $investment;
    public $faqs = [], $structures = [], $course_lecturers = [];

    public function mount($course_id)
    {

        $session_ref = session('referral_id');


        if (strlen($session_ref) > 0) {
            Log::debug('ref ' . $session_ref);
            // $this->referral_id = $session_ref;
        }

        $this->course_id = $course_id;
        $this->slug = $course_id;
        $course = Course::with('category')->where('slug', $course_id)->first();
        // $course = Course::where('id', $course_id)->first();

        $this->course = $course;
        if (!isset($course))
            return redirect()->route('index');
        $this->description = $course->description;
        $this->investment = $course->investments;

        $structures  = CourseStructure::where('course_id', $course->id)->get();

        if (isset($structures)) {
            foreach ($structures as $structure) {
                array_push($this->structures, [
                    'module' => $structure->module,
                    'title' =>  $structure->title,
                    'duration' =>  $structure->duration,
                ]);
            }
        }

        $faqs  = CourseFaq::where('course_id', $course->id)->get();
        if (isset($faqs)) {
            foreach ($faqs as $faq) {
                array_push($this->faqs, [
                    'title' => $faq->title,
                    'description' =>  $faq->description,
                ]);
            }
        }

        $lecs  = CourseLecturer::where('course_id', $course->id)->get();
        if (isset($lecs)) {
            foreach ($lecs as $crs) {
                $lec = LecturerPerson::find($crs->lecturer_id);
                if (isset($lec)) {
                    array_push($this->course_lecturers, $lec);
                }
            }
        }
    }

    public function render()
    {
        return view('livewire.home.course-detail');
    }

    public function selectCourse($course_id)
    {
        // if (strlen($this->referral_id) > 1) {
        //     if (isset($this->referral_id)) {
        //         $referrel = User::find($this->referral_id);
        //         if (!isset($referrel)) {
        //             return $this->dispatch('failed_alert', ['title' => 'Invalid Referrel User']);
        //         }
        //     }
        // } else {
        $course = Course::where('id', $course_id)->first();

        return redirect()->route('regWithcourse', [$course->slug]);
        // }

        // return redirect()->route('home.registerWithRef', [$this->referral_id, $course_id]);
    }
}
